# Changelog

All notable changes to `particle-academy/fancy-starter-kit` are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

> **History before 1.1.14 is not yet recorded here.** This file starts at the
> release that introduced it; earlier versions are described by their git tags.
> Backfilling is tracked separately.

## [Unreleased]

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
