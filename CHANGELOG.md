# Changelog

All notable changes to `particle-academy/fancy-starter-kit` are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

> **History before 1.1.14 is not yet recorded here.** This file starts at the
> release that introduced it; earlier versions are described by their git tags.
> Backfilling is tracked separately.

## [Unreleased]

## [1.1.40] — 2026-08-11

### Changed

- **`react-fancy` 5.17.0 → 5.17.1** (dep + lockfile). Fixes a `Modal` growing
  taller than the viewport and stranding its content — only `size="full"` had a
  max-height, so every other size, including the `md` default, was vertically
  unbounded.

  **What you must do:** nothing. Verified with `npm run build` and a dev-mode
  smoke: Vite ready with zero errors, `@react-refresh` and the TSX entry both 200.

## [1.1.39] — 2026-08-10

### Changed

- **`react-fancy` 5.16.0 → 5.17.0** (dep + lockfile). Upstream this release is
  BREAKING: `Field` no longer spaces itself via an adjacent-sibling margin,
  because that margin fired regardless of layout direction and pushed the
  right-hand cell of any grid row 16px down. Spacing is the container's job now.

  **What you must do:** nothing. This kit does not use `Field` anywhere, so
  there is no stacked form to migrate. If you add one, space it with
  `space-y-4` on the wrapper (or `gap-4` if it is already flex or grid) —
  that restores exactly the rhythm the old rule produced, measured at 72px.

  Verified with `npm run build` and a dev-mode smoke: Vite ready with zero
  errors, `@react-refresh` and the TSX entry both 200.

## [1.1.38] — 2026-08-10

### Changed

- **`react-fancy` 5.15.0 → 5.16.0** (dep + lockfile). Adds `JsonEditor`, a
  key/value editor that can impose declared types on untyped JSON; fixes
  `aria-sort` on sortable `Table.Column` headers, and `data-*`/`aria-*`
  forwarding on `Table`, `Table.Head`, `Table.Body`, `Table.Column` and
  `ColorPicker`.

  The caret range already admitted 5.16.0 — the **lockfile** is the part that
  matters here, because `laravel new` pulls it verbatim and a stale lock ships
  stale packages to every new project regardless of what the range permits.

  **What you must do:** nothing. Verified with `npm run build` and a real
  dev-mode smoke: Vite ready with zero errors, `@react-refresh` and the TSX
  entry both served 200, `react-fancy` resolving. Dev mode is checked because
  building is not enough — 1.1.2 shipped with dev mode broken the whole time,
  since ship-time checks ran `npm run build` and never `npm run dev`.

## [1.1.37] — 2026-08-09

### Changed

- `@particle-academy/react-fancy` to **5.15.0** (dep + lockfile), picking up
  `StatList` (5.14.0) and the `Container` / `Section` / `Grid` layout primitives
  (5.15.0).

## [1.1.36] — 2026-08-09

### Changed

- `@particle-academy/react-fancy` to **5.13.1** (dep + lockfile).

  5.13.x makes the kit tree-shakable: a consumer importing one component used to
  pull ~1.13 MB and now pulls ~33 kB. Per-component subpaths
  (`@particle-academy/react-fancy/badge`) are available, but the **barrel gets
  the same benefit**, so this scaffold's imports are left as they are.

## [1.1.35] — 2026-08-09

### Changed

- `@particle-academy/fancy-inertia` to **0.11.0** (dep + lockfile). Adds
  `appUpdate` on `setupFancyApp`, which mounts `AppUpdateAlert` inside Inertia's
  `<App>` — previously there was no working mount point for it at all.

  Not enabled in the scaffold by default; opt in with
  `setupFancyApp({ ..., appUpdate: true })`.

## [1.1.34] — 2026-08-09

### Changed

- `@particle-academy/react-fancy` to **5.12.0** (dep + lockfile). `Toast` now
  takes an `action`, so undo can be a real button rather than a countdown; a
  toast carrying one no longer auto-dismisses.

## [1.1.33] — 2026-08-09

### Changed

- `@particle-academy/react-fancy` to **5.11.0** (dep + lockfile), covering 5.10.0
  and 5.11.0:

  - `PromptInput` now hands back the actual `File` on drop, so attachments can be
    uploaded — previously only `{ id, name, bytes }` survived. Its `📎 attach`
    button also works now; it had shipped with a no-op handler.
  - Circular `Progress` accepts a pixel `size` and `strokeWidth`, and its named
    diameters ship as real CSS rather than inline styles.

  Dev-smoked: `vite` boots, the entry transforms, and the CSS actually served
  carries all 7 `@layer base` blocks and all 3 Progress diameter rules.

## [1.1.32] — 2026-08-09

### Changed

- `@particle-academy/react-fancy` to **5.9.0** (dep + lockfile).

  5.9.0 moves the kit's base styles into `@layer base`, so a Tailwind utility
  passed through `className` finally wins — previously the unlayered base styles
  outranked every utility, silently.

  **Worth knowing on upgrade:** overrides that were previously ignored now apply.
  A `className` left in place believing it did nothing will start taking effect.
  Nothing in this scaffold relied on that, and dev + build render clean.

  Dev-smoked: `vite` boots, the entry transforms, and all 7 `@layer base` blocks
  are present in the CSS actually served.

## [1.1.31] — 2026-08-09

### Changed

- `@particle-academy/react-fancy` to **5.8.0** (dep + lockfile).

  5.8.0 fixes seven components that silently dropped `data-*` and `aria-*` props
  — `Switch`, `Checkbox`, `CheckboxGroup`, `RadioGroup`, `MultiSwitch`, `Field`
  and `Table.Row` — so handles put on them now reach the DOM.

  The caret already admitted 5.8.0; the **lockfile** is the reason this release
  exists. `laravel new` installs from the committed lockfile, so a fresh scaffold
  would have kept getting 5.7.0 no matter what the range said.

  Smoked in **dev mode**, not just `build`: `vite` boots, the transformed entry
  serves, and react-fancy's optimized dep bundle loads clean. That check exists
  because 1.1.2 shipped with dev mode broken for everyone and a green `build` did
  not notice.

## [1.1.30] — 2026-08-09

### Changed

- `react-fancy` 5.6.1 → **5.7.0** — adds `<PullQuote>`. Purely additive.
  Same session as upstream, per the lockstep rule.

## [1.1.29] — 2026-08-09

### Changed

- `react-fancy` 5.5.0 → **5.6.1** — adds `<Stat>` / `<Stat.Band>` (display
  figure + band) and `<IndexList>` (numbered stretched-link rows), each with
  stable per-part handles. Purely additive.

  Same session as upstream, per the lockstep rule.

## [1.1.28] — 2026-08-09

### Changed

- `react-fancy` 5.4.0 → **5.5.0** — adds `<Kbd>`, the keyboard key cap.
  Purely additive. Same session as upstream, per the lockstep rule.

## [1.1.27] — 2026-08-09

### Changed

- `react-fancy` 5.3.0 → **5.4.0** — adds `<Brand.Mark>` (the square logo tile)
  and `<Eyebrow>` (the mono section running head). Purely additive.

  Same session as upstream, per the lockstep rule. Dev-mode smoked.

## [1.1.26] — 2026-08-09

### Changed

- `react-fancy` 5.2.0 → **5.3.0** — adds `<Card.Media>` (fixed-ratio thumbnail
  region with corner slots) and `<Card interactive>`. Purely additive; an
  existing `Card` renders identically.

  Shipped the same session as upstream, per the lockstep rule. Dev-mode smoked.

## [1.1.25] — 2026-08-09

### Changed

- `react-fancy` 5.1.0 → **5.2.0** — `<Heading>` gains display sizes `3xl`–`7xl`
  with display tracking. Purely additive; every existing size is unchanged.

  Shipped here the same session it shipped upstream, because `laravel new`
  installs this repo's lockfile: a kit left behind hands stale packages to every
  new scaffold, regardless of what the constraints allow.

  Dev-mode smoked again (Vite connected, React Refresh active, clean console),
  not only built.

## [1.1.24] — 2026-08-09

### Security

- **`league/commonmark` 2.8.3 → 2.9.0**, clearing six advisories — four high,
  two medium — covering denial of service via crafted Markdown (quadratic-time
  parsing, colliding heading slugs, duplicate footnote definitions, adjacent
  inline attribute blocks, deeply nested XML output) and an unsafe-link filter
  bypass in the AttributesExtension via embedded control bytes.

  It arrives transitively through `laravel/framework`, so it is a **lockfile**
  fix — which is exactly the kind that matters here: `laravel new` installs this
  repo's lockfile, so every scaffold created since the advisories landed got the
  vulnerable version regardless of what its own constraints allowed.

  **What you must do:** on a new scaffold, nothing. On an existing one,
  `composer update league/commonmark`.

### Changed

- Dependency refresh: `fancy-query` 0.7.0 → **0.8.0** (adds the Live Contract;
  purely additive) and `react-fancy` 5.0.0 → **5.1.0**.

  `fancy-query`'s caret is on a `0.x`, which locks the MINOR — so `^0.7.0` could
  never have resolved 0.8.0 on its own, and the range had to move for the kit to
  pick it up at all.

- Verified in **dev mode**, not only via `npm run build`: Vite connected, React
  Refresh active, welcome + login + register rendering with a clean console. The
  kit shipped a dev-mode-broken release once because the ship checks only ever
  built.

## [1.1.23] — 2026-08-08

### Changed

- Took the kit onto the 0.5 releases: `fancy-echarts` 6.0.0, `fancy-inertia`
  0.10.1, `fancy-pwa` 0.2.0, `fancy-query` 0.7.0, `fancy-screens` 0.7.0,
  `react-fancy` 5.0.0.
- `CLAUDE.md` is now a symlink to `AGENTS.md`.

> Recorded after the fact — this release was tagged without a changelog entry.

## [1.1.22] — 2026-08-03

### Changed

- Dependency refresh: `fancy-screens` 0.6.0, `fancy-inertia` 0.9.7,
  `react-fancy` 4.19.1.

  fancy-screens 0.6 adds optional node ids and `<Screen doc={…}>`, which is
  what makes a schema-driven screen addressable by an agent afterwards. Nothing
  in the scaffold changes; existing screens are untouched.

### Fixed

- **A fresh scaffold could not `npm install`.** Moving to fancy-screens 0.6
  tripped an `ERESOLVE` failure: `fancy-inertia@0.9.6` declared its optional
  `fancy-screens` peer as `^0.4.0 || ^0.5.0`, and a caret on a `0.x` locks the
  minor — so 0.6.0 read as a conflict rather than an upgrade. Fixed upstream in
  `fancy-inertia@0.9.7` and pinned here.

  It only failed on a *clean* tree; installing into the existing lockfile
  resolved fine, which is why the smoke for this release builds a scaffold from
  scratch rather than running `npm install` in the repo. Verified end to end:
  clean install, `vite build`, `php artisan test`, and `npm run dev` with a
  clean browser console on the welcome, login and register pages.

## [1.1.21] — 2026-08-02

### Changed

- **react-fancy 4.18.0 → 4.19.0**, which adds the `brand` / `primary-*` /
  `secondary-*` colour scheme. Purely additive: new utilities become available,
  nothing existing changes meaning. Scaffolds can now use `bg-brand` and the
  theme-aware `secondary-*` neutrals, and rebrand by redefining one token:

  ```css
  @theme { --color-brand: var(--color-emerald-600); }
  ```

  Bumped in the same session react-fancy shipped, per the kit's lockstep rule —
  a fresh `laravel new` pulls this lockfile, so a stale kit hands every new user
  a stale package.

## [1.1.20] — 2026-07-31

### Security

- **Takes `fancy-inertia` 0.9.6**, which fixes two high-severity ReDoS
  vulnerabilities in `<Seo>` (CodeQL `js/polynomial-redos`). The canonical and
  image helpers trimmed slashes with a regex whose quantifier backtracks, at a
  cost quadratic in the input length — on a code path that runs on every page
  render.

  **A fresh `laravel new --using=particle-academy/fancy-starter-kit` pulls this
  lockfile**, so every new app scaffolded before this shipped with the
  vulnerable version. Nothing to adapt: behaviour is identical.

### Changed

- **Takes `react-fancy` 4.18.0** — navigation primitives (`Navbar.Item`,
  `Sidebar.Item`, `Menu.Item`, `MobileMenu.Item`, `Breadcrumbs.Item`) now accept
  an `as` prop, so an Inertia `<Link>` can render in their place instead of the
  plain `<a href>` that made nav chrome a full page load. **No action needed** —
  the default is unchanged.

  Verified in dev mode against a running scaffold, not just built: the page
  renders with 0 console errors and 0 warnings.

## [1.1.19] - 2026-07-30

Dependency and agent-guidance refresh. Existing applications do not need to
change; these updates affect newly generated projects and developers who choose
to update their dependencies.

### Added

- Root-level `AGENTS.md` with Fancy UI application architecture, Human+
  interactive-component conventions, commands, and verification guidance.
- Root-level `CLAUDE.md` imports the same canonical instructions so the two
  agent entry points cannot drift.

### Changed

- **Laravel and PHP:** `laravel/framework` 13.22.0 → 13.23.0,
  `inertiajs/inertia-laravel` 3.1.1 → 3.2.1, `laravel/pao` 1.1.2 → 1.1.3,
  `laravel/pint` 1.29.3 → 1.30.0, and PHPUnit 12.5.31 → 12.5.33, plus current
  compatible transitive packages. PHPUnit stays on 12 because PHPUnit 13
  requires PHP 8.4 while the kit intentionally supports PHP 8.3.
- **Fancy UI:** `@particle-academy/fancy-inertia` 0.9.3 → 0.9.5 and
  `@particle-academy/react-fancy` 4.17.1 is now the declared minimum as well as
  the locked version.
- **Frontend:** Vite 8.1.5 → 8.2.0, TypeScript 6.0.3 → 7.0.2,
  `concurrently` 9.2.4 → 10.0.4, React 19.2.7 → 19.2.8, Inertia React 3.5.0 →
  3.6.1, Tailwind CSS 4.3.1 → 4.3.3, and the remaining direct npm dependencies
  to their current stable releases.

### Verified

- TypeScript 7 typecheck, PHP test suite (7 tests / 15 assertions), client + SSR
  production build, Composer audit, and npm audit.
- Clean clone through `composer run setup`, followed by a Vite dev-mode browser
  smoke of `/`, `/login`, and `/register`; all three rendered with HTTP 200 and
  no console or page errors.

## [1.1.18] - 2026-07-28

### Fixed

- **Lockfile now pulls `react-fancy` 4.17.1, which fixes a `TimePicker` crash.**
  4.17.0 threw `Rendered more hooks than during the previous render` the first
  time a `mode="view"` TimePicker was clicked into edit mode — four `useCallback`s
  sat below the early return, so the two modes ran different numbers of hooks.
  The field vanished from the page and the error named none of the responsible
  code.

  The declared range (`^4.16.0`) already allowed the fix, but **a fresh
  `laravel new` installs from this lockfile**, so every new app would have
  scaffolded with the broken version until this release.

  Verified the way the rule requires — not just a green `npm run build`: fresh
  scaffold, `npm run dev`, `/`, `/login` and `/register` loaded in a real
  browser, Vite HMR connected and the console clean. Dev mode is checked
  explicitly because a build-only check is exactly what let 1.1.2 ship with a
  permanently broken dev server.

## [1.1.17] - 2026-07-25

Lockstep with a shipped dependency. **Upgrading requires no action.**

### Changed

- **`@particle-academy/fancy-query` 0.5.0 → 0.6.0.** `poll.while` now also
  accepts a predicate (`() => boolean`), so missed-broadcast recovery can run off
  your own in-flight state instead of waiting on a `stream.started` that may
  never arrive. Purely additive — `while` still defaults to `"streaming"`, and
  the kit's own code does not use `poll`.

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

[Unreleased]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.19...HEAD
[1.1.19]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.18...v1.1.19
[1.1.18]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.17...v1.1.18
[1.1.17]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.16...v1.1.17
[1.1.16]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.15...v1.1.16
[1.1.15]: https://github.com/particle-academy/fancy-starter-kit/compare/v1.1.14...v1.1.15
[1.1.14]: https://github.com/particle-academy/fancy-starter-kit/releases/tag/v1.1.14
