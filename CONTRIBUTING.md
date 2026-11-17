# Contributing to this Fancy Dev Kit application

Notes for anyone, human or agent, working ON this code: the Fancy Dev Kit
Laravel starter kit, and every application created from it. How to build with
the Fancy Dev Kit here is in [AGENTS.md](./AGENTS.md); what the kit is, is in
[README.md](./README.md). `CLAUDE.md` is a symlink to this file, so Claude Code
reads these notes when it works in this repo.

**Read [AGENTS.md](./AGENTS.md) before building UI here.** It holds the rules
for using Fancy components (prefer `react-fancy`, `Button` not `Action`, the
interactive component contract).

## Commands

```bash
composer run setup
composer run dev
composer test
npm run build
vendor/bin/pint --dirty
```

Tests are written with Pest. `tests/Pest.php` binds every test in
`tests/Feature` to `Tests\TestCase` with `RefreshDatabase`; write new tests as
`test()` / `it()` closures. `composer test` and `php artisan test` both run
Pest.

`npm run build` produces both client and SSR bundles. Keep SSR-safe code in
shared modules and isolate browser-only APIs behind client boundaries.

## Factories and fake data

`fakerphp/faker` is not installed, so Laravel's `fake()` helper does not exist
here (Laravel only defines it when Faker is present) — calling it fails with
"Call to undefined function fake()". Use the application's own generator:

```php
use Database\Factories\Support\FakeData;

FakeData::shared()->name();
FakeData::shared()->unique()->safeEmail();
FakeData::shared()->seed(1234); // repeatable sequence
```

It covers only the formatters this app uses. When a factory needs another kind
of value, add a public method to `database/factories/Support/FakeData.php` with
a test in `tests/Unit/FakeDataTest.php`, rather than installing Faker.

## Before finishing a change

- Run the focused tests for the changed behavior.
- Run `composer test` for backend or full-stack changes.
- Run `npm run build` for frontend, dependency, or configuration changes.
- Run `vendor/bin/pint --dirty` after editing PHP.
- Exercise changed interactive UI in dev mode and check the browser console.
