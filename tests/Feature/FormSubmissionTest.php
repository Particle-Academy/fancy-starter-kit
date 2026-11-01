<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

/*
|--------------------------------------------------------------------------
| Every kit form submits
|--------------------------------------------------------------------------
|
| react-fancy 6 changed `<Button>`'s default type from the HTML default
| (`submit`) to `button`. A Button inside a <form> with no `type` stops
| submitting it on click, and a form whose only submit control was such a
| Button stops submitting on Enter as well.
|
| Two halves, because a PHP test cannot run React:
|
|  1. The SOURCE guard: every <form> the kit renders carries an explicit
|     `type="submit"` control. This is what fails if one is dropped.
|  2. The ENDPOINT each form posts to accepts the payload the page sends and
|     redirects where the page expects.
|
| The click and the Enter key themselves are exercised in a real browser by
| the dev-mode smoke (see CHANGELOG): this file cannot see them.
|
*/

/**
 * Every `<form ...>...</form>` block in the kit's TSX, keyed "file#n".
 *
 * @return array<string, string>
 */
function kitFormBlocks(): array
{
    $root = resource_path('js');
    $blocks = [];

    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));

    foreach ($files as $file) {
        if (! in_array($file->getExtension(), ['tsx', 'jsx'], true)) {
            continue;
        }

        $source = file_get_contents($file->getPathname());
        $relative = str_replace('\\', '/', substr($file->getPathname(), strlen($root) + 1));

        preg_match_all('/<form\b.*?<\/form>/s', $source, $matches);

        foreach ($matches[0] as $i => $block) {
            $blocks["{$relative}#{$i}"] = $block;
        }
    }

    return $blocks;
}

test('the kit renders the six forms this guard knows about', function () {
    // If this count moves, a form was added or removed: audit the new one's
    // submit control rather than just updating the number.
    expect(array_keys(kitFormBlocks()))->toEqualCanonicalizing([
        'Pages/auth/ForgotPassword.tsx#0',
        'Pages/auth/Login.tsx#0',
        'Pages/auth/Register.tsx#0',
        'Pages/auth/ResetPassword.tsx#0',
        'Pages/settings/Password.tsx#0',
        'Pages/settings/Profile.tsx#0',
    ]);
});

test('every kit form has an explicit type="submit" control (react-fancy 6 Buttons default to type="button")', function () {
    $missing = [];

    foreach (kitFormBlocks() as $key => $block) {
        if (! preg_match('/<(Button|Action|button)\b[^>]*\btype="submit"/s', $block)) {
            $missing[] = $key;
        }
    }

    expect($missing)->toBe([], 'These forms have no type="submit" control, so on react-fancy 6 neither a click nor Enter submits them: '.implode(', ', $missing));
});

test('no Button submits a form from outside it via form="id" without type="submit"', function () {
    $offenders = [];

    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(resource_path('js'), FilesystemIterator::SKIP_DOTS)) as $file) {
        if (! in_array($file->getExtension(), ['tsx', 'jsx'], true)) {
            continue;
        }

        preg_match_all('/<(Button|Action)\b[^>]*\bform="[^"]+"[^>]*>/s', file_get_contents($file->getPathname()), $matches);

        foreach ($matches[0] as $tag) {
            if (! str_contains($tag, 'type="submit"')) {
                $offenders[] = $file->getFilename().': '.$tag;
            }
        }
    }

    expect($offenders)->toBe([]);
});

test('the installed react-fancy is a 6.x line', function () {
    $installed = json_decode(file_get_contents(base_path('node_modules/@particle-academy/react-fancy/package.json')), true);

    expect((int) explode('.', $installed['version'])[0])->toBeGreaterThanOrEqual(6);
})->skip(fn () => ! file_exists(base_path('node_modules/@particle-academy/react-fancy/package.json')), 'node_modules not installed');

test('login form: POST /login signs the user in and lands on the dashboard', function () {
    $user = User::factory()->create(['password' => Hash::make('password123')]);

    $this->post('/login', ['email' => $user->email, 'password' => 'password123', 'remember' => false])
        ->assertRedirect('/dashboard');

    $this->assertAuthenticatedAs($user);
});

test('register form: POST /register creates the user and lands on the dashboard', function () {
    $this->post('/register', [
        'name' => 'Grace Hopper',
        'email' => 'grace@example.test',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect('/dashboard');

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', ['email' => 'grace@example.test']);
});

test('forgot-password form: POST /forgot-password sends the reset link', function () {
    Notification::fake();
    $user = User::factory()->create();

    $this->from('/forgot-password')
        ->post('/forgot-password', ['email' => $user->email])
        ->assertRedirect('/forgot-password')
        ->assertSessionHas('status');

    Notification::assertSentTo($user, ResetPassword::class);
});

test('reset-password form: POST /reset-password sets the new password', function () {
    $user = User::factory()->create();
    $token = Password::createToken($user);

    $this->post('/reset-password', [
        'token' => $token,
        'email' => $user->email,
        'password' => 'brand-new-pass',
        'password_confirmation' => 'brand-new-pass',
    ])->assertRedirect('/login');

    expect(Hash::check('brand-new-pass', $user->fresh()->password))->toBeTrue();
});

test('profile form: PUT /user/profile-information saves name and email', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->from('/settings/profile')
        ->put('/user/profile-information', ['name' => 'Renamed', 'email' => 'renamed@example.test'])
        ->assertRedirect('/settings/profile')
        ->assertSessionHasNoErrors();

    expect($user->fresh()->only('name', 'email'))->toBe(['name' => 'Renamed', 'email' => 'renamed@example.test']);
});

test('password form: PUT /user/password changes the password', function () {
    $user = User::factory()->create(['password' => Hash::make('old-password')]);

    $this->actingAs($user)
        ->from('/settings/password')
        ->put('/user/password', [
            'current_password' => 'old-password',
            'password' => 'new-password-1',
            'password_confirmation' => 'new-password-1',
        ])
        ->assertRedirect('/settings/password')
        ->assertSessionHasNoErrors();

    expect(Hash::check('new-password-1', $user->fresh()->password))->toBeTrue();
});
