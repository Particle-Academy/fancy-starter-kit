<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class InertiaPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Inertia's default page path is `js/pages`, lowercase, and this app's
     * pages live in `js/Pages`. A case-insensitive disk (Windows, default
     * macOS) treats those as the same directory and Linux does not, so the
     * check has to compare names exactly rather than ask the filesystem.
     */
    public function test_every_configured_page_path_exists_with_its_exact_case(): void
    {
        $paths = config('inertia.pages.paths');

        $this->assertNotEmpty($paths);

        foreach ($paths as $path) {
            $this->assertDirectoryExists($path);
            $this->assertContains(
                basename($path),
                scandir(dirname($path)),
                "Inertia looks for pages in [{$path}], but the directory on disk is spelled differently.",
            );
        }
    }

    public function test_page_components_resolve_when_asserted(): void
    {
        $this->get('/')->assertInertia(fn (Assert $page) => $page->component('Welcome'));
        $this->get('/login')->assertInertia(fn (Assert $page) => $page->component('auth/Login'));

        $this->actingAs(User::factory()->create())
            ->get('/settings/profile')
            ->assertInertia(fn (Assert $page) => $page->component('settings/Profile'));
    }
}
