<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

/*
 * Inertia's default page path is `js/pages`, lowercase, and this app's pages
 * live in `js/Pages`. A case-insensitive disk (Windows, default macOS) treats
 * those as the same directory and Linux does not, so the check has to compare
 * names exactly rather than ask the filesystem.
 */
test('every configured page path exists with its exact case', function () {
    $paths = config('inertia.pages.paths');

    expect($paths)->not->toBeEmpty();

    foreach ($paths as $path) {
        expect($path)->toBeDirectory();
        expect(basename($path))->toBeIn(
            scandir(dirname($path)),
            "Inertia looks for pages in [{$path}], but the directory on disk is spelled differently.",
        );
    }
});

test('page components resolve when asserted', function () {
    $this->get('/')->assertInertia(fn (Assert $page) => $page->component('Welcome'));
    $this->get('/login')->assertInertia(fn (Assert $page) => $page->component('auth/Login'));

    $this->actingAs(User::factory()->create())
        ->get('/settings/profile')
        ->assertInertia(fn (Assert $page) => $page->component('settings/Profile'));
});
