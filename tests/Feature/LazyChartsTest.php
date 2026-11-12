<?php

use App\Models\User;
use Symfony\Component\Process\Process;

/*
 * Charts are loaded on demand (owner, 2026-11-11). 1.1.125 registered every
 * fancy-echarts chart type from both entries, which put all of echarts into the
 * main client bundle: 142 kB gzip became 481 kB, on every page, including the
 * ones with no chart. Now <Chart> (resources/js/components/Chart.tsx) imports
 * fancy-echarts and registers it behind a dynamic import() the first time a
 * chart mounts, and the server renders a sized placeholder in its place.
 *
 * The first two checks read sources. The rest read the BUILT bundles, because
 * what a consumer downloads is the build, not the source: they need
 * `npm run build` first, and say so rather than passing when it is missing.
 */

function lazyChartsPath(string $path): string
{
    return dirname(__DIR__, 2).'/'.$path;
}

function lazyChartsSource(string $path): string
{
    return file_get_contents(lazyChartsPath('resources/js/'.$path));
}

test('neither entry imports fancy-echarts or registers charts', function (string $entry) {
    $source = lazyChartsSource($entry);

    expect($source)->not->toContain('fancy-echarts')
        ->and($source)->not->toMatch("/import\s+'\.\/charts'/");
})->with(['app.tsx', 'ssr.tsx']);

test('the Chart component reaches fancy-echarts only through a dynamic import', function () {
    $chart = lazyChartsSource('components/Chart.tsx');
    $runtime = lazyChartsSource('components/chart-runtime.ts');

    // `import type` is erased at build time; a value import would bundle echarts.
    expect($chart)->not->toMatch("/^import\s+(?!type\b)[^;]*fancy-echarts/m")
        ->and($chart)->toContain("import('./chart-runtime')")
        ->and($runtime)->toContain("from '@particle-academy/fancy-echarts'")
        ->and($runtime)->toMatch('/^registerAll\(\);$/m')
        ->and($runtime)->toMatch('/^registerBuiltinThemes\(\);$/m');
});

/** Every chunk the client entry loads up front: its static import closure. */
function lazyChartsStaticClosure(array $manifest, string $key, array &$seen = []): array
{
    if (isset($seen[$key])) {
        return $seen;
    }
    $seen[$key] = $manifest[$key]['file'] ?? $key;
    foreach ($manifest[$key]['imports'] ?? [] as $import) {
        lazyChartsStaticClosure($manifest, $import, $seen);
    }

    return $seen;
}

test('the main client bundle does not contain echarts', function () {
    $manifestPath = lazyChartsPath('public/build/manifest.json');
    if (! is_file($manifestPath)) {
        $this->markTestSkipped('No client build: run `npm run build` first.');
    }
    $manifest = json_decode(file_get_contents($manifestPath), true);

    $upFront = lazyChartsStaticClosure($manifest, 'resources/js/app.tsx');
    foreach ($upFront as $file) {
        $code = file_get_contents(lazyChartsPath('public/build/'.$file));
        // echarts' own registration API, present in any bundle that holds it.
        expect(str_contains($code, 'registerPreprocessor'))
            ->toBeFalse("{$file} is loaded up front and contains echarts.");
    }

    $runtime = collect($manifest)->first(fn ($chunk, $key) => str_contains($key, 'chart-runtime'));
    expect($runtime)->not->toBeNull('The chart runtime is not a chunk of its own.')
        ->and($runtime['isDynamicEntry'] ?? false)->toBeTrue();
});

/**
 * Render a page through the BUILT SSR bundle: start it on a spare port, post
 * the page object Laravel produced for the request, return the body. The
 * server is started and shut down per call, so no run leaves a node process
 * behind (a shared server stopped from a shutdown function was left running).
 */
function lazyChartsSsrBody(array $page): string
{
    $port = 13790 + random_int(0, 150);
    $base = "http://127.0.0.1:{$port}";
    $server = new Process(['node', lazyChartsPath('bootstrap/ssr/ssr.js')], lazyChartsPath(''), [
        'INERTIA_SSR_URL' => $base,
    ]);
    $server->start();

    try {
        $deadline = microtime(true) + 15;
        while (! str_contains($server->getOutput(), (string) $port)) {
            if (! $server->isRunning()) {
                throw new RuntimeException('SSR server exited: '.$server->getErrorOutput());
            }
            if (microtime(true) > $deadline) {
                throw new RuntimeException('SSR server did not start within 15 s.');
            }
            usleep(100_000);
        }

        // The version is the build hash; fix it so a rebuild alone is not a diff.
        $page['version'] = 'fixture';

        $context = stream_context_create(['http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => json_encode($page),
            'timeout' => 15,
        ]]);
        $response = json_decode((string) file_get_contents("{$base}/render", false, $context), true);

        return (string) ($response['body'] ?? '');
    } finally {
        // Inertia's SSR server exits on /shutdown; stop() is the fallback.
        @file_get_contents("{$base}/shutdown", false, stream_context_create(['http' => ['timeout' => 2]]));
        $server->stop(2);
    }
}

function lazyChartsRequireSsrBuild(): void
{
    if (! is_file(lazyChartsPath('bootstrap/ssr/ssr.js'))) {
        test()->markTestSkipped('No SSR build: run `npm run build` first.');
    }
}

test('server-rendered pages without a chart are unchanged', function (string $url, string $fixture) {
    lazyChartsRequireSsrBuild();

    $page = $this->get($url)->viewData('page');
    $body = lazyChartsSsrBody($page);

    expect($body)->not->toBe('')
        ->and($body)->toBe(file_get_contents(lazyChartsPath("tests/Fixtures/ssr/{$fixture}.html")));
})->with([
    'welcome' => ['/', 'welcome'],
    'login' => ['/login', 'login'],
    'register' => ['/register', 'register'],
]);

test('a page with a chart server-renders a sized placeholder and no chart', function () {
    lazyChartsRequireSsrBuild();

    $page = $this->actingAs(User::factory()->create(['name' => 'Ada']))->get('/dashboard')->viewData('page');
    $body = lazyChartsSsrBody($page);

    expect($body)->toMatch('/<div[^>]*data-chart-placeholder[^>]*style="[^"]*height:\s*\d+px/')
        ->and($body)->not->toContain('<canvas');
});
