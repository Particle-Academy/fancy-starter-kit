<?php

/*
 * The client and SSR entries are TypeScript, which these PHP tests cannot run,
 * so this reads their sources. Both defects were found by the lab's full-kit
 * benchmark on 2026-11-10:
 *
 * - The kit installs fancy-echarts but mounts with `appRoot: false`, which skips
 *   the chart registration FancyAppRoot would do, so the first <EChart> in a
 *   fresh app crashed on an unregistered chart type (K12).
 * - The SSR entry passed no port, so the SSR server always took 13714 whatever
 *   INERTIA_SSR_URL said, and two apps could not run SSR on one machine (K14).
 */

function entrySource(string $path): string
{
    return file_get_contents(dirname(__DIR__, 2).'/resources/js/'.$path);
}

test('the chart registration module registers every chart and the built-in themes', function () {
    $source = entrySource('charts.ts');

    expect($source)->toContain("from '@particle-academy/fancy-echarts'")
        ->and($source)->toMatch('/^registerAll\(\);$/m')
        ->and($source)->toMatch('/^registerBuiltinThemes\(\);$/m');
});

test('both entries register charts before anything renders', function (string $entry) {
    $source = entrySource($entry);

    // A side-effect import at the top of the module, so registration has run
    // before the first page module (and its <EChart>) is evaluated.
    expect($source)->toMatch("/^import '\\.\\/charts';$/m")
        ->and(strpos($source, "import './charts';"))
        ->toBeLessThan(strpos($source, 'createInertiaApp(') ?: strpos($source, 'createFancyServer('));
})->with(['app.tsx', 'ssr.tsx']);

test('the SSR entry listens on the port in INERTIA_SSR_URL, the same URL Laravel calls', function () {
    $source = entrySource('ssr.tsx');

    expect($source)->toContain('process.env.INERTIA_SSR_URL')
        ->and($source)->toMatch('/createFancyServer\(\{[\s\S]*\bport\b[\s\S]*\}\);/');
});

test('config and .env.example name the same SSR URL', function () {
    $env = file_get_contents(dirname(__DIR__, 2).'/.env.example');
    $config = file_get_contents(dirname(__DIR__, 2).'/config/inertia.php');

    expect($env)->toContain('INERTIA_SSR_URL=http://127.0.0.1:13714')
        ->and($config)->toContain("env('INERTIA_SSR_URL', 'http://127.0.0.1:13714')");
});
