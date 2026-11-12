<?php

use Symfony\Component\Process\Process;

/*
 * One <title> on the first byte (lab finding K21, 2026-11-12). The root
 * template carried its own `<title inertia>` beside `@inertiaHead`, so every
 * server-rendered page had TWO title elements: the template's app name first
 * and the page's own title from the SSR head second. The document was invalid,
 * and a reader without JavaScript (a crawler, a link preview) took the first
 * one and saw "Fancy" on every page instead of the page's title.
 *
 * These render whole documents through Laravel with SSR switched on against
 * the BUILT SSR bundle, because the defect is in how the template and the SSR
 * head combine, which neither half shows on its own. They need `npm run build`
 * first and say so rather than passing when it is missing.
 */

function documentTitlePath(string $path): string
{
    return dirname(__DIR__, 2).'/'.$path;
}

/**
 * Start the built SSR bundle on a spare port, point Laravel's SSR config at
 * it, run $request, and shut the server down whatever happens.
 */
function withSsrServer(Closure $request): mixed
{
    if (! is_file(documentTitlePath('bootstrap/ssr/ssr.js'))) {
        test()->markTestSkipped('No SSR build: run `npm run build` first.');
    }

    $port = 13950 + random_int(0, 40);
    $base = "http://127.0.0.1:{$port}";
    $server = new Process(['node', documentTitlePath('bootstrap/ssr/ssr.js')], documentTitlePath(''), [
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

        config([
            'inertia.ssr.enabled' => true,
            'inertia.ssr.url' => $base,
            // A render that fails must fail the test, not fall back to the
            // client-only document and pass for the wrong reason.
            'inertia.ssr.throw_on_error' => true,
        ]);

        return $request();
    } finally {
        @file_get_contents("{$base}/shutdown", false, stream_context_create(['http' => ['timeout' => 2]]));
        $server->stop(2);
    }
}

/** @return list<string> the text of every <title> element in the document */
function documentTitles(string $html): array
{
    preg_match_all('/<title(?:\s[^>]*)?>(.*?)<\/title>/is', $html, $matches);

    return $matches[1];
}

test('a server-rendered page has exactly one title, and it is the page title', function (string $url, string $title) {
    $html = withSsrServer(fn () => $this->get($url)->assertOk()->getContent());

    // The SSR body is present, so this is the server-rendered document.
    expect($html)->toContain('data-server-rendered="true"')
        ->and(documentTitles($html))->toHaveCount(1)
        ->and(documentTitles($html)[0])->toContain($title);
})->with([
    'welcome' => ['/', 'Welcome'],
    'login' => ['/login', 'Log in'],
    'register' => ['/register', 'Create your account'],
]);

test('without SSR the document still has exactly one title: the app name', function () {
    config(['inertia.ssr.enabled' => false]);

    $html = $this->get('/')->assertOk()->getContent();

    expect($html)->not->toContain('data-server-rendered')
        ->and(documentTitles($html))->toBe([config('app.name')]);
});
