<?php

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\File;

/*
| vite.config.js declares bunny('Instrument Sans'), and laravel-vite-plugin
| downloads those files at build time and serves them as the app's own assets.
| They reach the page ONLY through the `@fonts` Blade directive
| (Vite::fonts()). Without it every page renders in the system font and
| nothing reports it.
|
| A fixture build directory keeps this independent of whether `npm run build`
| has run, and of a dev server's hot file.
*/

beforeEach(function () {
    $this->buildDir = 'build-fonts-test';
    $path = public_path($this->buildDir);
    File::ensureDirectoryExists($path);

    File::put("{$path}/manifest.json", json_encode([
        'resources/css/app.css' => ['file' => 'assets/app.css', 'src' => 'resources/css/app.css', 'isEntry' => true],
        'resources/js/app.tsx' => ['file' => 'assets/app.js', 'src' => 'resources/js/app.tsx', 'isEntry' => true],
        'resources/js/Pages/Welcome.tsx' => ['file' => 'assets/Welcome.js', 'src' => 'resources/js/Pages/Welcome.tsx', 'isDynamicEntry' => true],
    ]));

    File::put("{$path}/fonts-manifest.json", json_encode([
        'version' => 1,
        'style' => [
            'file' => 'assets/fonts.css',
            'familyStyles' => [
                'instrument-sans' => "@font-face {\n  font-family: \"Instrument Sans\";\n  font-weight: 400;\n  src: url(\"/{$this->buildDir}/assets/instrument-sans-400.woff2\") format(\"woff2\");\n}",
            ],
            'variables' => ['instrument-sans' => '--font-instrument-sans: "Instrument Sans";'],
        ],
        'preloads' => [[
            'alias' => 'instrument-sans',
            'family' => 'Instrument Sans',
            'weight' => 400,
            'style' => 'normal',
            'file' => 'assets/instrument-sans-400.woff2',
            'as' => 'font',
            'type' => 'font/woff2',
            'crossorigin' => 'anonymous',
        ]],
        // Shape copied from a real `npm run build` of this kit (laravel-vite-plugin 3.1).
        'families' => [
            'instrument-sans' => [
                'family' => 'Instrument Sans',
                'variable' => '--font-instrument-sans',
                'variants' => [
                    '400:normal' => ['files' => [['file' => 'assets/instrument-sans-400.woff2', 'format' => 'woff2']]],
                ],
            ],
        ],
    ]));

    // `@fonts` with no alias inlines this whole file into a <style> tag.
    File::ensureDirectoryExists("{$path}/assets");
    File::put("{$path}/assets/fonts.css", "@font-face {\n  font-family: \"Instrument Sans\";\n  font-weight: 400;\n  src: url(\"/{$this->buildDir}/assets/instrument-sans-400.woff2\") format(\"woff2\");\n}\n");

    $vite = app(Vite::class);
    $vite->useBuildDirectory($this->buildDir);
    $vite->useHotFile(storage_path('framework/testing/no-such-hot-file'));
});

afterEach(function () {
    File::deleteDirectory(public_path($this->buildDir));
});

test('the app layout emits the Instrument Sans @font-face and preload (the @fonts directive)', function () {
    $html = $this->get('/')->assertOk()->getContent();

    expect($html)
        ->toContain('font-family: "Instrument Sans"')
        ->toContain('rel="preload"')
        ->toContain('as="font"')
        ->toContain("/{$this->buildDir}/assets/instrument-sans-400.woff2");
});

test('the font output comes before the Vite entry tags, so the face is declared before the CSS that uses it', function () {
    $html = $this->get('/')->getContent();

    $font = strpos($html, 'Instrument Sans');
    $css = strpos($html, "/{$this->buildDir}/assets/app.css");

    // strpos() returns false when absent, and false < int is true in PHP, so
    // both positions must be proven to exist before the ordering means anything.
    expect($font)->toBeInt()->and($css)->toBeInt();
    expect($font)->toBeLessThan($css);
});
