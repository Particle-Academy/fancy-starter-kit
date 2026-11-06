<?php

/*
 * The kit's pages render in React, which these PHP tests cannot see, so this
 * reads the layout sources. axe flagged both: an auth page with no `main`
 * landmark (landmark-one-main, region) and the welcome cards jumping from h1
 * to h3 (heading-order). Reported by PS Mapper on 2026-11-06.
 */

function kitSource(string $path): string
{
    return file_get_contents(dirname(__DIR__, 2).'/resources/js/'.$path);
}

test('the auth layout puts the logo in a header and the card in a main landmark', function () {
    $source = kitSource('layouts/AuthLayout.tsx');

    expect($source)->toContain('<header')
        ->and($source)->toContain('<main')
        ->and(strpos($source, '<header'))->toBeLessThan(strpos($source, '<main'));
});

test('every layout and page with an h1 renders exactly one main landmark', function (string $path) {
    expect(substr_count(kitSource($path), '<main'))->toBe(1);
})->with([
    'layouts/AuthLayout.tsx',
    'layouts/AppLayout.tsx',
    'Pages/Welcome.tsx',
]);

test('no page skips a heading level after its h1', function (string $path) {
    $source = kitSource($path);
    preg_match_all('/<h([1-6])\b/', $source, $matches);
    $levels = array_map('intval', $matches[1]);

    $previous = 0;
    foreach ($levels as $level) {
        expect($level)->toBeLessThanOrEqual($previous + 1);
        $previous = $level;
    }
})->with([
    'Pages/Welcome.tsx',
    'layouts/AuthLayout.tsx',
    'layouts/SettingsLayout.tsx',
]);
