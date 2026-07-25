# Changelog

All notable changes to `particle-academy/fancy-starter-kit` are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

> **History before 1.1.14 is not yet recorded here.** This file starts at the
> release that introduced it; earlier versions are described by their git tags.
> Backfilling is tracked separately.

## [Unreleased]

## [1.1.16] - 2026-07-24

Dependency refresh. No application code, scaffolding, or configuration changed —
**upgrading requires no action.**

### Changed

- **PHP:** `laravel/framework` 13.17.0 → 13.22.0, `laravel/fortify` 1.36.2 →
  1.37.3, `inertiajs/inertia-laravel` 3.1.0 → 3.1.1, `nunomaduro/collision`
  8.9.4 → 8.9.5, `phpunit/phpunit` 12.5.30 → 12.5.31, plus ten transitive
  updates.
- **JS:** `@inertiajs/react` 3.5.0 → 3.6.1, `react` + `react-dom` 19.2.7 →
  19.2.8, `vite` 8.1.0 → 8.1.5, `tailwindcss` + `@tailwindcss/vite` 4.3.1 →
  4.3.3, `@tanstack/react-query` 5.101.2 → 5.101.4, `@vitejs/plugin-react`
  6.0.3 → 6.0.4, `laravel-vite-plugin` 3.1.0 → 3.1.3, `@types/node` 26.0.1 →
  26.1.1.
- **Fortify 1.37 adds passkey support, which grows the install.** It pulls
  `laravel/passkeys` plus a WebAuthn stack (`web-auth/webauthn-lib`,
  `web-auth/cose-lib`, `spomky-labs/cbor-php`, `spomky-labs/pki-framework`) and
  four `symfony/*` serializer packages — 15 new transitive packages in total.
  **Nothing is enabled by default** and no scaffolding changed, so there is
  nothing to do; a fresh scaffold simply installs more than it used to.

### Security

- Refreshes `composer.lock` so GitHub's dependency graph re-reads it. The four
  `guzzlehttp/guzzle` advisories fixed back in 1.1.15 were still being reported
  as open because the graph had not re-parsed the lock since that release — it
  was still reading guzzle as 7.12.3. The locked version was, and remains,
  7.15.1: **no released kit was vulnerable in the interim.**

## [1.1.15] - 2026-07-22

### Security

- `guzzlehttp/guzzle` **7.12.3 → 7.15.1**, clearing four Dependabot advisories:
  Proxy-Authorization headers leaking to origin servers on cross-host redirect,
  host-only cookie scope not being preserved, unbounded response cookies (DoS),
  and URI fragments disclosed in redirect `Referer` headers.

  **Nothing to do** — Guzzle is a transitive dependency; this is a lockfile
  bump. It matters here because `laravel new --using=…fancy-starter-kit`
  installs from this repo's lockfile, so a stale lock ships the vulnerable
  Guzzle to every new project.

## [1.1.14] - 2026-07-21

### Changed

- `@particle-academy/react-fancy` to **4.16.0** (from a lockfile pinned at
  4.15.0), which adds the `Drawer` component — a panel that slides in from any
  edge, viewport-level or attached inside a container.

  **Nothing to do.** This is a dependency bump in a fresh-scaffold template; a
  scaffold created before this release keeps working, and `npm update
  @particle-academy/react-fancy` picks up the same version in an existing
  project.

  The bump matters because `laravel new --using=particle-academy/fancy-starter-kit`
  installs from **this repository's lockfile** — so a stale lockfile ships a
  stale library to every new project regardless of the declared version range.

### Verified

- `npm run build` (client + SSR), `php artisan test` (7 passing), and a
  **dev-mode** smoke: `npm run dev` serves `@vite/client`, transforms
  `app.tsx` through the JSX dev runtime, and resolves the react-fancy
  pre-bundle. Dev mode is smoked separately on purpose — a previous release
  shipped an `app.blade.php` missing `@viteReactRefresh`, which a production
  build cannot catch.

[Unreleased]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.14...HEAD
[1.1.14]: https://github.com/particle-academy/fancy-starter-kit/releases/tag/v1.1.14
