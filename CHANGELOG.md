# Changelog

All notable changes to `particle-academy/fancy-starter-kit` are documented here.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

> **History before 1.1.14 is not yet recorded here.** This file starts at the
> release that introduced it; earlier versions are described by their git tags.
> Backfilling is tracked separately.

## 1.1.120 — 2026-11-08

### Changed

- **react-fancy 6.18.0** (was 6.17.1). The range moves from `^6.17.1` to `^6.18.0`. Two
  additions:
  - **`--fancy-accent` / `--fancy-accent-dark`:** a theme token for the checked colour of
    native `Checkbox`, `CheckboxGroup` and `RadioGroup`, which was hard-coded blue-600. Both
    default to blue-600.
  - **`Pillbox` `maxLength`:** an optional cap on the length of each pill, with the count
    left announced near the cap.
- **The kit's own pages look the same.** The kit sets neither accent variable, so its
  "Remember me" checkbox stays blue-600 when checked, and it renders no `Pillbox`.
  **Consumer action:** none. To theme the checkbox colour, set `--fancy-accent` (and
  `--fancy-accent-dark`) beside your other `--fancy-*` tokens. In an app made from an
  earlier kit, `npm install @particle-academy/react-fancy@^6.18.0` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.18.0 installed, `composer test` 41 passed). The "Remember me"
checkbox's computed `accent-color` is `oklch(0.546 0.245 262.881)`, which is blue-600, in
both light and dark mode. It equals both the page's own `--color-blue-600` and the literal
value. The earlier checks still hold:
- a probe placeholder on the login fields computes to the muted token;
- the login Email field's resting outline is `#71717b` (zinc-500) in both modes, 4.83:1 on
  `#ffffff` and 3.44:1 on `#1e1e24`;
- in dark mode the checkbox computes `color-scheme: dark`.

`/login`, `/register` and `/forgot-password` each still have exactly one `main`, with the
h1 inside it and the home link in a `header`, and the card is 384px wide. `/` runs h1 then
six h2s. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.119 — 2026-11-08

### Changed

- **react-fancy 6.17.1** (was 6.17.0). The range moves from `^6.17.0` to `^6.17.1`. Two
  changes:
  - **`Pillbox` accessibility fix:** its text input takes `label`, `labelHidden`,
    `description`, `error`, `required` and `id` through the shared `Field` wrapper, links
    its messages with `aria-describedby`, sets `aria-invalid` and `aria-required`, announces
    added and removed pills in a polite live region, and takes `labels` for translation.
  - **`Field` gains optional `descriptionId` and `errorId`,** so a control can point
    `aria-describedby` at its messages. Without them it renders exactly as before.
- **The kit's own pages look the same.** The kit renders no `Pillbox`. Its `Input` fields
  use `Field` but don't pass the new ids, so their markup is unchanged.
  **Consumer action:** none. In an app made from an earlier kit,
  `npm install @particle-academy/react-fancy@^6.17.1` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.17.1 installed, `composer test` 41 passed). The earlier
checks still hold:
- a probe placeholder on the login fields computes to the muted token;
- the login Email field's resting outline is `#71717b` (zinc-500) in both modes, 4.83:1 on
  `#ffffff` and 3.44:1 on `#1e1e24`;
- in dark mode the "Remember me" checkbox computes `color-scheme: dark`, with a blue-600
  `accent-color`.

`/login`, `/register` and `/forgot-password` each still have exactly one `main`, with the
h1 inside it and the home link in a `header`, and the card is 384px wide. `/` runs h1 then
six h2s. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.118 — 2026-11-07

### Changed

- **react-fancy 6.17.0** (was 6.16.0). The range moves from `^6.16.0` to `^6.17.0`. Two
  changes:
  - **`keepMounted` on `Drawer` and `Modal`:** opt-in and off by default. With it, a closed
    overlay keeps its children in the tree, hidden, inert and `aria-hidden`, so state such
    as a playing `<audio>` element or a half-filled form survives close and reopen.
  - **Native checkboxes and radios lose dead background classes:** Checkbox, CheckboxGroup
    and RadioGroup no longer carry the `--fancy-input` background pair, which the browser
    never painted on a native control. `accent-color` and the dark `color-scheme` remain.
- **The kit's own pages look the same.** The kit renders no `Drawer` or `Modal`, and the
  classes removed from its "Remember me" checkbox never painted.
  **Consumer action:** none. In an app made from an earlier kit,
  `npm install @particle-academy/react-fancy@^6.17.0` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.17.0 installed, `composer test` 41 passed). The earlier
checks still hold:
- a probe placeholder on the login fields computes to the muted token;
- the login Email field's resting outline is `#71717b` (zinc-500) in both modes, 4.83:1 on
  `#ffffff` and 3.44:1 on `#1e1e24`;
- in dark mode the "Remember me" checkbox computes `color-scheme: dark`, with a blue-600
  `accent-color`. Its computed `background-color` is now transparent, where 1.1.117 read
  `#ffffff` / `#1e1e24`: that is the removed class, which the browser never painted on the
  native box.

`/login`, `/register` and `/forgot-password` each still have exactly one `main`, with the
h1 inside it and the home link in a `header`, and the card is 384px wide. `/` runs h1 then
six h2s. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.117 — 2026-11-07

### Changed

- **react-fancy 6.16.0** (was 6.15.1). The range moves from `^6.15.1` to `^6.16.0`. It adds
  `StreamingAudio`, a controlled player for server-hosted MP3s and Icecast / Shoutcast live
  streams on the native `<audio>` element, on the subpath
  `@particle-academy/react-fancy/streaming-audio`. Nothing else changed.
- **The kit's own pages look the same.** The kit doesn't render `StreamingAudio`.
  **Consumer action:** none. In an app made from an earlier kit,
  `npm install @particle-academy/react-fancy@^6.16.0` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.16.0 installed, `composer test` 41 passed). The 1.1.115 and
1.1.116 checks still hold:
- a probe placeholder on the login fields computes to the muted token;
- the login Email field's resting outline is `#71717b` (zinc-500) in both modes, 4.83:1 on
  `#ffffff` and 3.44:1 on `#1e1e24`;
- in dark mode the "Remember me" checkbox computes `color-scheme: dark`, with a blue-600
  `accent-color`.

`/login`, `/register` and `/forgot-password` each still have exactly one `main`, with the
h1 inside it and the home link in a `header`, and the card is 384px wide. `/` runs h1 then
six h2s. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.116 — 2026-11-07

### Changed

- **react-fancy 6.15.1** (was 6.13.0). The range moves from `^6.13.0` to `^6.15.1`. This
  takes in three releases:
  - **6.14.0:** adds `SetupWizard`, and `OtpInput` gains a named group, translatable cell
    names, SMS one-time-code autofill and whole codes landing in one cell. `CodeBlock` no
    longer rewrites its code on every re-render.
  - **6.15.0:** interactive form-control outlines move onto `--fancy-border-strong`, whose
    light and dark defaults are now both zinc-500, to meet WCAG 1.4.11 (3:1 non-text
    contrast). Before, zinc-300 on white was 1.48:1 and zinc-700 on the `#1e1e24` dark field
    was 1.59:1.
  - **6.15.1:** corrects 6.15.0 for native checkboxes and radios (Checkbox, CheckboxGroup,
    RadioGroup). The browser draws those boxes itself, so the border classes 6.15.0 darkened
    never rendered and are removed. Instead the checked colour is set with `accent-color`
    (blue-600), and in dark mode the box carries `color-scheme: dark`, so the browser draws
    its dark box on a dark surface rather than a white one.
- **Visible on the kit's own pages:**
  - **Field outlines:** the `Input` resting outline on login, register, forgot-password,
    reset-password and the profile and password settings goes from zinc-300 to zinc-500 in
    light mode, and from zinc-700 to zinc-500 in dark mode. Focus, invalid and disabled
    styling are unchanged.
  - **The "Remember me" checkbox on login:** in dark mode it is now the browser's dark box
    instead of a white one, and when checked it fills blue-600. Its outline is the
    browser's own in both modes, as before.
  - The kit's buttons are solid `violet` or `ghost`, so the outline Button's darker hover
    doesn't show, and the kit renders no `SetupWizard`, `OtpInput` or `CodeBlock`.

  **Consumer action:** none. To keep the previous field outlines, set
  `--fancy-border-strong` to `var(--color-zinc-300)` and `--fancy-border-strong-dark` to
  `var(--color-zinc-700)`. In an app made from an earlier kit,
  `npm install @particle-academy/react-fancy@^6.15.1` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.15.1 installed, `composer test` 41 passed). The login Email
field's resting outline, not focused, is 1px on all four sides and resolves to
`oklch(0.552 0.016 285.938)`, which is `#71717b` (zinc-500), in both modes. Against the
field's own opaque background that is 4.83:1 on `#ffffff` in light mode and 3.44:1 on
`#1e1e24` in dark mode, both above 3:1. In dark mode the "Remember me" checkbox computes
`color-scheme: dark` while `<html>` stays `normal`; on 6.15.0 it computed `normal`. Its
`accent-color` is blue-600 (`oklch(0.546 0.245 262.881)`) in both modes. The 1.1.115
placeholder check still holds: a probe placeholder on the login fields computes to the
muted token. `/login`, `/register` and `/forgot-password` each still have exactly one
`main`, with the h1 inside it and the home link in a `header`, and the card is 384px wide.
`/` runs h1 then six h2s. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.115 — 2026-11-07

### Changed

- **react-fancy 6.13.0** (was 6.12.0). The range moves from `^6.12.0` to `^6.13.0`. Two
  changes:
  - **Per-option `lang` and `dir`:** the object form of `InputOption` and
    `AutocompleteOption` takes optional `lang` and `dir`, so a language switcher can mark
    each label's language (WCAG 3.1.2). An option that sets neither renders as before.
  - **Readable faint text moves to muted:** placeholders on Input, Textarea and every field
    on the shared input classes, empty-value text, in-box affixes and a list of secondary
    labels now read `--fancy-text-muted` instead of `--fancy-text-faint`, which reaches AA.
    In light mode they are one palette step darker (zinc-400 to zinc-500), and in dark mode
    one step lighter.
- **The kit's own pages look the same.** The auth and settings pages use `Input`, so their
  fields take the muted placeholder colour, but none of them sets a `placeholder`
  (react-fancy's Input defaults it to empty) or an affix, so no text changes colour. The
  kit renders no Select, Autocomplete, view-mode field, Menu, Sidebar, Accordion or Table.
  **Consumer action:** none. A placeholder you add to a kit field will show in the muted
  colour. In an app made from an earlier kit,
  `npm install @particle-academy/react-fancy@^6.13.0` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.13.0 installed, `composer test` 41 passed). `/login`,
`/register` and `/forgot-password` each still have exactly one `main`, with the h1 inside
it and the home link in a `header`, and the card is 384px wide. `/` runs h1 then six h2s.
The login page's Email and Password fields carry no `placeholder`. With a probe placeholder
set in the page only, both placeholders compute to `oklch(0.552 0.016 285.938)`, the muted
token (zinc-500), not faint (`oklch(0.705 0.015 286.067)`, zinc-400). Chromium's
`getComputedStyle(input, '::placeholder')` returns the input's own text colour, so this was
read from the placeholder node in the input's shadow root. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.114 — 2026-11-07

### Changed

- **react-fancy 6.12.0** (was 6.11.0). The range moves from `^6.11.0` to `^6.12.0`. This
  takes in two releases:
  - **6.11.1:** `FileUpload` text follows the `--fancy-text-*` theme tokens, and its
    thumbnail remove button now shows on keyboard focus instead of only on hover.
  - **6.12.0:** secondary grey text across the kit (80 lines in 44 files) moves off bare
    `text-zinc-*` onto the `--fancy-text-*` tokens, so an app that maps the tokens themes
    it too, and that text reaches AA contrast by default. In light mode some of it looks
    a step darker: Calendar's out-of-month days and chart tick marks noticeably,
    placeholders and the Modal, Drawer, Toast and other close or icon buttons from
    zinc-400 to zinc-500, and zinc-600 hovers to zinc-700. No token's default value
    changed.
- **The kit's own pages look the same.** They use `Button`, `Input`, `Checkbox`,
  `Callout`, `Badge`, `Icon` and the `Toast` provider, and none of those changed on what
  the kit renders. The `Input` change is the password reveal, which the kit doesn't turn
  on, and the `Toast` change is its close button and default icon, which show only when
  an app fires a toast. **Consumer action:** none. In an app made from an earlier kit,
  `npm install @particle-academy/react-fancy@^6.12.0` to follow.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, react-fancy 6.12.0 installed, `composer test` 41 passed). `/login`,
`/register` and `/forgot-password` each still have exactly one `main`, with the h1 inside
it and the home link in a `header`, and the card is 384px wide. `/` runs h1 then six h2s.
The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and
  matches no `:focus-visible`, and a reload stays dark; Tabbing to the profile Save
  button matches `:focus-visible`;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.113 — 2026-11-06

### Fixed

- **Accessibility: the login, register and password pages have a `main` landmark.**
  `AuthLayout` now puts the logo in a `<header>` and the card in `<main>`. axe flagged
  `landmark-one-main` and `region`, because nothing on those pages sat inside a landmark.
  The card's classes moved with it, so it looks the same.
- **Accessibility: the welcome page's cards are `h2`, not `h3`.** They followed the
  `h1` directly, so axe flagged `heading-order`. Same classes, so the cards look the same.
- Both were reported by PS Mapper running axe on an app made from the kit.
  `tests/Unit/LandmarksTest.php` checks the layout sources for both. Before the fix it
  failed on all three of the cases it now guards.
- **Consumer action:** in an app made from an earlier kit, make the same two edits to
  `resources/js/layouts/AuthLayout.tsx` and `resources/js/Pages/Welcome.tsx`, unless
  you've already restyled those pages.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, `composer test` 41 passed). In the rendered page, `/login`, `/register`
and `/forgot-password` each have exactly one `main`, with the h1 inside it and the home
link in a `header`, and the card is still 384px wide. `/` runs h1 then six h2s, with no
h3. The usual checks passed:
- register submitted by clicking the button, sign out, log in submitted by pressing Enter;
- profile saved (303) and password changed (303), both confirmed in the database;
- the theme toggle and Tab focus behave as in 1.1.112;
- 0 console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.112 — 2026-11-06

### Changed

- **Pest 5** for the kit's tests: `pestphp/pest` `^4.7` to `^5` (5.3.5 installed), which
  brings PHPUnit 13 (13.4.5) and the Pest plugins at 5.x. Dev-only: nothing the app runs
  changed. The kit's 34 tests pass unchanged, and the `RefreshDatabase` binding in
  `tests/Pest.php` works as before. PHPUnit 13 adds `sebastian/file-filter` and
  `sebastian/git-state` to the lockfile. **Consumer action:** an existing app made from the
  kit is unaffected. To follow, set `pestphp/pest` to `^5` and run `composer update
  pestphp/pest -W`. The kit hit no Pest 5 or PHPUnit 13 breaks, so its own tests needed
  no edits. The Pest browser plugin, which Fancy recommends for browser tests, needs
  Pest `^5.2.1`.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, Pest 5.3.5 and PHPUnit 13.4.5 installed, `composer test` 34 passed):
register submitted by clicking the button, sign out, log in submitted by pressing Enter
in the password field, profile saved (303) and password changed (303), both confirmed
in the database. The theme toggle, mouse-clicked to dark, puts `dark` on `<html>`,
stores `dark` and matches no `:focus-visible`; a reload stays dark. Tabbing to the
profile Save button matches `:focus-visible`. 0 console errors and 0 warnings, with the
listener proven by a planted error and warning.

## 1.1.111 — 2026-11-06

### Security

- **Symfony 8.1.11 in the kit's lockfile** for `symfony/http-foundation` (was 8.1.10),
  `symfony/http-kernel`, `symfony/routing` and `symfony/serializer` (were 8.1.2 to 8.1.3).
  That clears the 9 advisories `composer audit` reported against the committed lockfile,
  which a fresh `laravel new` installed as is. **Consumer action:** in an app made from an
  earlier kit, run `composer update symfony/http-foundation symfony/http-kernel
  symfony/routing symfony/serializer`, then `composer audit`.

Only the lockfile changed: no `composer.json` range moved and no code changed. 34 tests
pass and `composer audit` reports no advisories.

Dev-mode smoke on a fresh, git-initialised scaffold of this release (headless Chromium,
`npm run dev`, Symfony 8.1.11 installed): register submitted by clicking the button,
sign out, log in submitted by pressing Enter in the password field, profile saved (303)
and password changed (303), both confirmed in the database. The theme toggle,
mouse-clicked to dark, puts `dark` on `<html>`, stores `dark` and matches no
`:focus-visible`; a reload stays dark. Tabbing to the profile Save button matches
`:focus-visible`. 0 console errors and 0 warnings, with the listener proven by a planted
error and warning.

## 1.1.110 — 2026-11-05

### Added

- **README: "Sessions, queues and cache".** The kit stays on Laravel's `database`
  driver for all three. The section covers how to move to Redis, and why to pick
  `phpredis` or `predis` first. **No action needed.**

### Changed

- **react-fancy 6.11.0** (was 6.7.2; range `^6.7.2` to `^6.11.0`). 6.11.0 makes
  `Modal`, `Drawer` and `Command` trap focus. Before this, focus never moved into an
  open dialog, Tab walked out of it, and closing never returned focus to the trigger.
  The `Modal.Header` and `Drawer.Header` close buttons grow to a 44px target and take
  a translatable `closeLabel`. 6.10.0 adds
  `PhoneInput`, a country picker and number whose value is E.164 or `null`. 6.9.0
  follows `dir="rtl"`: overlays, form inputs, keys and direction-meaning icons mirror
  in a right-to-left page, and edge-anchored defaults are logical (`Drawer`
  `side="end"`, `Toast` `position="bottom-end"`). Left-to-right output is
  box-identical. 6.8.0 adds `QrCodePanel`, `qrCodeSvg` and `qrCodePng` on the
  `./qr-code` subpath. The kit uses none of the new components. **No action
  needed**, unless a test of yours reads `input.style.paddingLeft` (now
  `paddingInlineStart`) or selects on `[data-side="right"]` for a default `Drawer`.
  The kit's own `Toast.Provider` passes `position="bottom-right"`, which stays on the
  physical right in a right-to-left page; pass `"bottom-end"` if you want it to mirror.
  The kit renders no `Modal`, `Drawer` or `Command`, so the focus fix changes nothing
  in the kit's own pages.

Dev-mode smoke on a fresh, git-initialised scaffold of this release's manifests
(headless Chromium, `npm run dev`, react-fancy 6.11.0 installed): register submitted
by clicking the button, sign out, log in submitted by pressing Enter in the password
field, profile saved (303), password changed (303). The theme toggle, mouse-clicked
to dark, puts `dark` on `<html>`, stores `dark` and matches no `:focus-visible`; a
reload stays dark. Tabbing to the profile Save button matches `:focus-visible`. 0
console errors and 0 warnings, with the listener proven by a planted error and warning.

## 1.1.109 — 2026-11-04

### Changed

- **react-fancy 6.7.2** (was 6.7.1; range `^6.7.1` to `^6.7.2`). Keeps `PromptInput`'s
  `/` and `@` menu row in view while arrowing, stops long names scrolling the menu
  sideways, and gives the menu stable handles. The kit doesn't use `PromptInput`.
  **No action needed.**

## 1.1.108 — 2026-11-04

### Changed

- **react-fancy 6.7.1** (was 6.6.1; range `^6.6.1` to `^6.7.1`). Adds `NumberField`
  and `FileUpload`'s `onReject`. 6.7.1 is the security fix for `NumberField`, new
  in 6.7.0: a very long pasted run of digits no longer backtracks badly enough to
  freeze the tab. The kit uses neither, so nothing in the kit behaves differently.
  **No action needed**, unless your app adopted `NumberField` on 6.7.0, in which
  case update.
- **fancy-echarts 6.2.0** (was 6.1.0; range `^6.0.0` to `^6.2.0`). A chart's `ref`
  now holds `{ instance, element, capture }`, and `captureEChart` is new. **BREAKING
  for TypeScript only if your app passes a ref to a chart:** `useRef<HTMLDivElement>`
  no longer type-checks. That ref was always `null`, so use `useRef<EChartHandle>`
  and read `.element` for the div or `.instance` for the chart. The kit passes no
  chart ref. **Otherwise no action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit's manifests
(headless Chromium, `npm run dev`, react-fancy 6.7.2 and fancy-echarts 6.2.0
installed): register submitted by clicking the button, sign out, log in submitted
by pressing Enter in the password field, profile saved (303), password changed
(303). The theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores
`dark` and matches no `:focus-visible`; a reload stays dark. Tabbing to the
profile Save button matches `:focus-visible`. 0 console errors and 0 warnings.

## 1.1.107 — 2026-11-04

### Changed

- **react-fancy 6.6.1** (was 6.6.0; range `^6.6.0` to `^6.6.1`). A behaviour fix
  with no API change: `VirtualList` no longer pauses `followTail` by itself when
  its viewport grows, a clamp no longer resumes a paused list, and `ArrowUp` at
  the bottom now pauses. The kit does not use `VirtualList`, so nothing in the
  kit behaves differently. **No action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit's manifests
(headless Chromium, `npm run dev`, react-fancy 6.6.1 and fancy-file-commons 0.5.0
installed): register submitted by clicking the button, sign out, log in submitted
by pressing Enter in the password field, profile saved (303), password changed
(303). The theme toggle, mouse-clicked to dark, puts `dark` on `<html>`, stores
`dark` and matches no `:focus-visible`; a reload stays dark. Tabbing to the
profile Save button on a settled page matches `:focus-visible`. 0 console errors
and 0 warnings.

## 1.1.106 — 2026-11-02

### Changed

- **react-fancy 6.6.0** (was 6.5.0; range `^6.5.0` to `^6.6.0`). Additive:
  `CodeBlock` and `CodeView` colours are now CSS variables declared on the
  component root, switched to the dark palette by `.dark` /
  `[data-theme="dark"]`, so server-rendered HTML is correct in either theme
  with no light flash before hydration; PHP snippets without `<?php` now
  highlight. Brings `@particle-academy/fancy-file-commons` 0.5.0 (installed
  for you as a react-fancy dependency). The kit uses neither component, so
  nothing in the kit renders differently. **No action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.6.0 and fancy-file-commons 0.5.0
installed): register submitted by clicking the button, sign out, log in
submitted by pressing Enter in the password field, profile saved (303),
password changed (303). The theme toggle, mouse-clicked to dark, puts `dark`
on `<html>`, stores `dark`, shows no ring and matches no `:focus-visible`; a
reload stays dark. Tabbing to the profile Save button shows the
`:focus-visible` ring. 0 console errors and 0 warnings.

## 1.1.105 — 2026-11-02

### Changed

- **react-fancy 6.5.0** (was 6.4.0; range `^6.4.0` to `^6.5.0`). Additive:
  `CodeBlock` and `CodeView` now highlight TypeScript, JavaScript, JSON, PHP,
  Python, Go, Markdown, shell and dotenv as well as HTML, using grammars shared
  through `@particle-academy/fancy-file-commons` 0.4.0 (installed for you as a
  react-fancy dependency). The kit uses neither component, so nothing in the
  kit renders differently. The kit does not depend on `fancy-code`.
  **No action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.5.0 and fancy-file-commons 0.4.0
installed): register submitted by clicking the button, sign out, log in
submitted by pressing Enter in the password field, profile saved (303),
password changed (303). A mouse-clicked theme toggle shows no ring and matches
no `:focus-visible`; tabbing to the profile Save button shows the
`:focus-visible` ring. 0 console errors and 0 warnings.

## 1.1.104 — 2026-11-01

### Changed

- **react-fancy 6.4.0** (was 6.3.0; range `^6.3.0` to `^6.4.0`). Additive: a
  new display-only `CodeBlock` component (`<pre><code>` with a copy button, no
  form elements), and `CodeView` no longer requires `window.matchMedia`. The
  kit uses neither, so nothing in the kit renders differently.
  **No action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.4.0 installed): register submitted by
clicking the button, sign out, log in submitted by pressing Enter in the
password field, profile saved (303), password changed (303). A mouse-clicked
theme toggle shows no ring and matches no `:focus-visible`; tabbing to the
profile Save button shows the `:focus-visible` ring. 0 console errors and 0
warnings.

## 1.1.103 — 2026-11-01

### Changed

- **react-fancy 6.3.0** (was 6.2.0; range `^6.2.0` to `^6.3.0`). Additive: a
  new `Stepper` component (ordered steps with `upcoming` / `current` /
  `complete` / `error` states, from a JSON `steps` array or `Stepper.Step`
  children), and `Breadcrumbs.Item` now accepts the element's HTML attributes
  in its type. The kit uses neither, so nothing in the kit renders differently.
  **No action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.3.0 installed): register submitted by
clicking the button, sign out, log in submitted by pressing Enter in the
password field, profile saved (303), password changed (303). A mouse-clicked
theme toggle shows no ring and matches no `:focus-visible`; tabbing to the
profile Save button shows the `:focus-visible` ring. 0 console errors and 0
warnings.

## 1.1.102 — 2026-11-01

### Changed

- **react-fancy 6.2.0** (was 6.1.1; range `^6.1.1` to `^6.2.0`). Additive:
  `Sidebar.Item` gains `dotTooltip` and `badgeLabel`, and an expanded item's
  label and badge are now separated by a visually hidden space in its
  accessible name. The kit does not use `Sidebar`, so nothing in the kit
  renders differently. **No action needed**, unless your app snapshots Sidebar
  markup: an expanded item with a `badge` gains one
  `<span class="sr-only"> </span>`.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.2.0 installed): register submitted by
clicking the button, sign out, log in submitted by pressing Enter in the
password field, profile saved (303), password changed (303). A mouse-clicked
theme toggle shows no ring and matches no `:focus-visible`; tabbing to the
profile Save button shows the `:focus-visible` ring. 0 console errors and 0
warnings.

## 1.1.101 — 2026-11-01

### Changed

- **react-fancy 6.1.1** (was 6.1.0; range `^6.1.0` to `^6.1.1`). A patch with
  three fixes: `Breadcrumbs` crumbs that navigate by `onClick` now work in the
  collapsed (narrow-window) dropdown, the `MultiSwitch` thumb re-measures when
  the selected option changes size, and `Tabs` keeps a tab stop when the
  controlled value matches no tab. The kit's pages use none of these
  components, so nothing in the kit renders differently. **No action needed.**

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.1.1 installed): register submitted by
clicking the button, sign out, log in submitted by pressing Enter in the
password field, profile saved (303), password changed (303). A mouse-clicked
theme toggle shows no ring and matches no `:focus-visible`; tabbing to the
profile Save button shows the blue `:focus-visible` ring. 0 console errors and
0 warnings.

## 1.1.100 — 2026-11-01

### Changed

- **react-fancy 6.1.0** (was 6.0.0; range `^6.0.0` to `^6.1.0`). Additive:
  `Sidebar.Item` gains `dot`, `dotLabel` and `collapsedBadge`, and `Sidebar`
  gains `navLabel` and `keyboardNav`. All are opt-in, and the kit uses none of
  them, so no kit page renders differently because of them. **No action needed**
  in an app made from the kit.

### Fixed

- **A `Button` no longer keeps a focus ring after a mouse click** (from
  react-fancy 6.1.0). The ring moved from `:focus` to `:focus-visible` and now
  uses the focus colour (`--fancy-focus`, blue-500) instead of falling back to
  `currentColor`. In the kit this applies to every `Button`: the theme toggle,
  Sign out, and each form's submit button. Keyboard focus
  still shows the ring. If you added `focus:ring-*` classes to a `Button`'s
  `className` in your app, change them to `focus-visible:ring-*` to keep them.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, `npm run dev`, react-fancy 6.1.0 installed): register submitted by
clicking the button, sign out, log in submitted by pressing Enter in the
password field, profile saved, password changed (303). After a mouse click on
the theme toggle, the focused `Button` matches no `:focus-visible` and has no
box-shadow ring. Tabbing to the profile form's Save `Button` matches
`:focus-visible` and shows the blue ring. 0 console errors and 0 warnings.

## 1.1.99 — 2026-11-01

### Changed

- **BREAKING for code you add to a new app: react-fancy 6.0.0** (was 5.72.0;
  range `^5.30.0` to `^6.0.0`). react-fancy 6 makes `<Button>` default to
  `type="button"` (Change Council CC-fancy-0003). A `<Button>` inside a
  `<form>` with no `type` used to submit the form and now does not. If that
  untyped Button was the form's only submit control, pressing Enter in a field
  stops submitting it too. `PromptInput`'s send button also no longer submits a
  surrounding form of yours.
- **Every kit form already submits, and nothing in the kit needed to change.**
  All six forms (login, register, forgot-password, reset-password, profile,
  password) have had an explicit `type="submit"` on their submit `Button` since
  the kit's auth pages were written. Every other kit `Button` (Sign out, the
  theme toggle, the welcome-page links) is outside any form, and no kit
  `Button` uses `form="id"`. A new Pest file, `tests/Feature/FormSubmissionTest.php`,
  now fails the build if a kit form loses its `type="submit"` control, and
  covers the endpoint each form posts to.
- **What to DO, if you added your own forms to an app made from the kit and you
  upgrade that app to react-fancy 6:** add `type="submit"` to each `<Button>`
  that is meant to submit a form. To list the candidates:

  ```bash
  grep -rlE '<(form|Form)\b' --include='*.tsx' --include='*.jsx' resources/js \
    | xargs grep -nE '<(Button|Action)\b'
  grep -rnE '<(Button|Action)\b[^>]*\bform="' --include='*.tsx' --include='*.jsx' resources/js
  ```

  Any hit without a `type` that is the form's Save / Submit / Send / Sign in
  needs `type="submit"`; Cancel and other action Buttons are correct untyped.
  **Existing apps are not affected until they upgrade react-fancy themselves:**
  `^5` ranges never resolve to 6.
- `fancy-inertia` 0.14.0 to 0.14.1 (range `>=0.14.1 <2.0`), and the lockfile
  takes `fancy-app-update` 0.7.1 (a transitive peer of `fancy-pwa` and
  `fancy-inertia`). Both widen their react-fancy peer range to admit 6, so
  `npm ls` stays clean. No API change.

### Fixed

- **New apps now actually load Instrument Sans.** Before, `@fonts` was missing
  from `resources/views/app.blade.php`, and pages rendered in the system font.
  `vite.config.js` already downloaded the font at build time and served it from
  the app's own origin, but the `@font-face` rules and preloads reach a page
  only through Laravel's `@fonts` directive, which was never called. It now sits
  before `@vite(...)`, and it adds the CSP nonce when the app uses one.
  `tests/Feature/FontsTest.php` covers it. **Existing apps:** add the single
  line `@fonts` above `@viteReactRefresh` in `resources/views/app.blade.php`.

`composer audit --locked` and `npm audit --omit=dev` both report no
advisories.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit (headed
browser, react-fancy 6.0.0 installed): register submitted by clicking the
button, sign out, log in submitted by pressing Enter in the password field,
forgot-password (reset link mailed), reset-password submitted by Enter, then
profile and password updates. Each request reached the server and redirected
as expected, with 0 console errors and 0 warnings. `body` computes
`"Instrument Sans"` and `document.fonts.check('16px "Instrument Sans"')` is
true. Every font file was served from the app's own origin, with no request
to an external font host.

## 1.1.98 — 2026-11-01

### Changed

- **react-fancy 5.72.0 in the lockfile** (was 5.71.3). The shared href
  sanitiser now accepts `blob:` URLs, and `Button` / `ChatMessage` warn in
  development when they drop an href. No API change; nothing in the kit needs
  to change, and every link the kit renders is accepted (no dev warning).
- Only that lockfile entry moved. The `package.json` range is unchanged
  (`^5.30.0`). `composer audit --locked` and `npm audit --omit=dev` both
  report no advisories.
- **Consumer action: none.** Existing apps made from the kit pick this up with
  `npm update @particle-academy/react-fancy`.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit: `/`,
`/register` and `/login` render with a clean console (0 errors, 0 warnings).

## 1.1.97 — 2026-11-01

### Changed

- **react-fancy 5.71.3 in the lockfile** (was 5.71.2). `Button` now shows a
  pointer cursor when enabled, and sets `aria-busy="true"` while `loading`.
  No API change; nothing in the kit needs to change.
- Only that lockfile entry moved. The `package.json` range is unchanged
  (`^5.30.0`). `composer audit --locked` and `npm audit --omit=dev` both
  report no advisories.
- **Consumer action: none.** Existing apps made from the kit pick this up with
  `npm update @particle-academy/react-fancy`.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit: `/`,
`/register` and `/login` render with a clean console (0 errors, 0 warnings),
and a `Button` computes `cursor: pointer`.

## 1.1.96 — 2026-10-31

### Changed

- **fancy-query 0.9.1 in the lockfile** (was 0.9.0). `useFancyStream` and
  `useFancyEchoInvalidation` now refetch / invalidate on every subscription
  acknowledgement, the initial one and each one after a reconnect, so events
  published while the socket was down are no longer lost. No API change;
  nothing in the kit needs to change.
- Only that lockfile entry moved (it also gains the `license` field 0.9.1's
  manifest now declares). The `package.json` range is unchanged
  (`>=0.9.0 <2.0`). `composer audit --locked` and `npm audit --omit=dev` both
  report no advisories.
- **Consumer action: none.** Existing apps made from the kit pick this up with
  `npm update @particle-academy/fancy-query`.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit: `/`,
`/register` and `/login` render with a clean console (0 errors, 0 warnings).

## 1.1.95 — 2026-10-31

### Changed

- **BREAKING for new apps: the kit now requires PHP 8.4 or newer** (was
  `^8.3`). This is the kit 0.5 platform floor, which the rest of the suite
  already declares; the starter kit was the one place still allowing 8.3.
  Creating a kit app on PHP 8.3 now stops with a Composer platform error
  ("your php version does not satisfy that requirement").
  **What to do:** upgrade PHP to 8.4+, or pin the last 8.3-compatible
  release:
  `laravel new my-app --using=particle-academy/fancy-starter-kit:1.1.94`.
- Only the constraint moved. `composer.lock` changes in its content hash and
  its `platform` entry and nothing else: no package version moved, and Pest
  stays on 4.
- The bundled `AGENTS.md` now says PHP 8.4+.
- **Consumer action for existing apps: none.** The PHP requirement lives in
  your app's own `composer.json`, which this release does not touch.

## 1.1.94 — 2026-10-31

### Changed

- **New apps now get Pest instead of bare PHPUnit.** The kit's 22 tests are
  ported one for one to `test()` closures with `expect()`, and
  `tests/Pest.php` binds `tests/Feature` to `Tests\TestCase` with
  `RefreshDatabase`, the same shape Laravel's own Pest starter kits ship. The
  suite still reports 22 tests and 655 assertions. `composer test` and
  `php artisan test` both run Pest; `phpunit.xml` is unchanged and still
  configures it.
- `require-dev` swaps `phpunit/phpunit` for `pestphp/pest` `^4.7` (v4.7.8 in
  the lockfile, which pairs with the PHPUnit 12.5.33 the kit already had, so
  PHPUnit itself did not move). Pest brings its own transitive packages
  (`brianium/paratest`, `pestphp/pest-plugin-arch`, and others); nothing in the
  production `require` changed.
- Every test in `tests/Feature` now uses `RefreshDatabase`, including the
  example test that previously did not. It still asserts only that `/`
  responds 200.
- `pestphp/pest-plugin-laravel` is **not** included: it fails the estate's
  third-party freshness bar, and none of the kit's tests need its function
  helpers (`$this->get()` works through `Tests\TestCase`).
- **Consumer action: none.** An app made from an earlier kit keeps its PHPUnit
  tests; they are your own code and nothing here touches them. To move such an
  app to Pest, follow Pest's installation guide.

## 1.1.93 — 2026-10-30

### Changed

- **react-fancy 5.71.2 in the lockfile** (was 5.71.1). `VirtualList` no
  longer reads `scrollTop` in each commit while following the tail. A
  performance fix with no API change; nothing in the kit needs to change.
- Only that lockfile entry moved. The `package.json` range is unchanged
  (`^5.30.0`). `composer audit --locked` and `npm audit --omit=dev` both
  report no advisories.
- **Consumer action: none.** Existing apps made from the kit pick this up with
  `npm update @particle-academy/react-fancy`.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit: `/`,
`/register` and `/login` render with a clean console (0 errors, 0 warnings).

## 1.1.92 — 2026-10-30

### Changed

- **react-fancy 5.71.1 in the lockfile** (was 5.71.0). A `VirtualList`
  performance fix with no API change; nothing in the kit needs to change.
- Only that lockfile entry moved. The `package.json` range is unchanged
  (`^5.30.0`), and every other first-party package is already at its latest
  release. `composer audit --locked` and `npm audit --omit=dev` both report
  no advisories.
- **Existing apps made from the kit** pick this up with
  `npm update @particle-academy/react-fancy`.

Dev-mode smoke on a fresh, git-initialised scaffold of this commit: `/`,
`/register` and `/login` render with a clean console (0 errors, 0 warnings).

## 1.1.91 — 2026-10-29

### Security

- **symfony/http-foundation 8.1.10 in the lockfile** (was 8.1.2). Fixes
  CVE-2026-108082 (high): a ReDoS in `HeaderUtils::split()` reachable through
  the `Cache-Control` request header, so any request could carry it.
- **symfony/mime 8.1.10 in the lockfile** (was 8.1.2). Fixes CVE-2026-45070
  (medium): email header injection through non-token characters in MIME
  parameter names.
- Only those two packages moved; `composer audit --locked` now reports no
  advisories. No constraint in `composer.json` changed.
- **Existing apps made from the kit must update themselves.** The kit's
  lockfile only reaches apps created after this release. In an app you already
  have, run `composer update symfony/http-foundation symfony/mime`.

Dev-mode smoke on a fresh scaffold of this commit: `/`, `/register` and
`/login` render with a clean console (0 errors, 0 warnings).

## 1.1.90 — 2026-10-27

### Changed

- **react-fancy 5.71.0 in the lockfile** (was 5.65.0, six releases behind).
  5.66.0 to 5.71.0 add `PromptInput` pill labels, `ContentRenderer` copy
  buttons and progressive streaming, `Editor` copy-button pass-through,
  acknowledged send for `Composer` / `PromptInput`, IME-safe Enter across the
  input components, and the new `ChatThread` / `ChatMessage`. One default
  changed: `ContentRenderer` (and `Editor` in view mode) now shows copy buttons
  and wraps each `pre` / `table`. The kit's pages use none of these
  components, so there is nothing to do. The `package.json` range is unchanged
  (`^5.30.0`).
- **First-party 0.x ranges widened to `>=X <2.0`**: fancy-inertia
  `>=0.14.0 <2.0`, fancy-pwa `>=0.2.0 <2.0`, fancy-query `>=0.9.0 <2.0`,
  fancy-screens `>=0.7.1 <2.0` (each was a caret). A caret on a 0.x locks the
  minor, so every later minor of those packages read as a conflict rather than
  an upgrade in a scaffolded app. Widening only adds candidates: the versions
  in the lockfile are unchanged and still resolve. Nothing to do.

Dev-mode smoke on a fresh scaffold of this commit: `/`, `/register` and
`/login` render with a clean console (0 errors, 0 warnings).

## 1.1.89 — 2026-10-27

### Changed

- **react-fancy 5.65.0 in the lockfile** (was 5.64.1). `PromptInput` gains
  controlled state (`value` / `onChange`) and draft save/restore (`draft`,
  a `ref` handle with `getDraft()` / `setDraft()`). Existing usage renders the
  same markup; the kit's pages don't use `PromptInput`, so there is nothing to
  do. The `package.json` range is unchanged (`^5.30.0`).
- **fancy-inertia 0.14.0** (was 0.12.0; range `^0.12.0` → `^0.14.0`, because
  a caret on a 0.x excludes the next minor). 0.13.0 and 0.14.0 only add the
  `@particle-academy/fancy-inertia/whats-new` entry (`createHttpStorage`,
  `WhatsNew`) and declare `fancy-whats-new` as an optional peer. The kit
  imports only `/server` and the root, so there is nothing to do.
- **fancy-app-update 0.7.0 in the lockfile** (was 0.6.0; transitive, through
  fancy-inertia). It adds a `./cards` entry and deprecates `AppUpdateStack`
  without changing it. Nothing to do.
- **fancy-file-commons 0.3.0 in the lockfile** (was 0.2.0; transitive, through
  react-fancy). It declares `engines.node >=22`, which the kit already
  requires. Nothing to do.

Dev-mode smoke on a fresh scaffold of this commit: `/`, `/register` and
`/login` render with a clean console.

## 1.1.88 — 2026-10-27

### Changed

- **react-fancy 5.64.1 in the lockfile** (was 5.64.0). Fix: `Dropdown` menu
  items can now be reached from the keyboard (arrows, Home/End, typeahead;
  focus returns to the trigger on Escape, Tab and activation). Nothing to do.
  Only the react-fancy entry in the lockfile moved. Dev-mode smoke: `/`,
  `/register` and `/login` render with a clean console.

## 1.1.87 — 2026-10-26

### Changed

- **react-fancy 5.64.0 in the lockfile** (was 5.63.0). It adds
  `ReorderableGrid`, which reorders grid cells in place by pointer or
  keyboard. The kit's pages don't use it, so there is nothing to do. Only the
  react-fancy entry in the lockfile moved. In the dev-mode smoke test, `/`,
  `/register` and `/login` render with a clean console.

## 1.1.86 — 2026-10-26

### Changed

- **react-fancy 5.63.0 in the lockfile** (was 5.62.0). `Editor.Toolbar` gains a
  `toolbarExtra` slot for host buttons, and `Kanban.Column` no longer shrinks
  in a narrow container. The kit's pages use neither; nothing to do. Only the
  react-fancy entry in the lockfile moved. Dev-mode smoke: `/`, `/register`
  and `/login` render with a clean console.

## 1.1.85 — 2026-10-26

### Changed

- **react-fancy 5.62.0 in the lockfile** (was 5.61.1). Escape now goes to the
  innermost open layer (menu, select, popover, tooltip, modal, full screen), so
  one Escape no longer closes a Dropdown and the Modal it was opened from
  together. The kit's pages use no layered Escape; nothing to do. Only the
  react-fancy entry in the lockfile moved. Dev-mode smoke: `/`, `/register`
  and `/login` render with a clean console.

## 1.1.84 — 2026-10-26

### Changed

- **react-fancy 5.61.1 in the lockfile** (was 5.60.1). This adds the
  `FullScreen` primitive and an opt-in full-screen toggle on the `Editor`
  (5.61.0), and puts full screen in the browser top layer so a transformed
  ancestor cannot trap it (5.61.1). It also makes the Editor's markdown output
  source-preserving (5.60.2). The kit's pages use none of these; nothing to do.
  Only the react-fancy entry in the lockfile moved. Dev-mode smoke: `/`,
  `/register` and `/login` render with a clean console.

## 1.1.83 — 2026-10-26

### Changed

- **react-fancy 5.60.1 in the lockfile** (was 5.60.0). Fix: the `Editor` in
  markdown mode no longer rewrites markdown nobody touched (tight lists stayed
  tight only by accident; ordered and nested lists and code fences now
  round-trip). The kit's pages don't use the markdown Editor; nothing to do.
  Only the react-fancy entry in the lockfile moved.

## 1.1.82 — 2026-10-23

### Changed

- **fancy-query 0.9.0** (was 0.8.0). The range in `package.json` moves to
  `^0.9.0`, because a caret on a 0.x version does not admit the next minor.
  Additive: a new opt-in `@particle-academy/fancy-query/socket` entry (a
  dependency-free realtime client) that nothing in the kit imports. Leaving a
  private or presence channel no longer drops a public subscription with the
  same bare name. Nothing to do.

## 1.1.81 — 2026-10-23

### Changed

- **react-fancy 5.60.0 in the lockfile** (was 5.59.0). Additive: a new
  `ResizablePanels` splitter, and `FileUpload`'s dropzone is now reachable and
  operable from the keyboard with a full-opacity focus ring. Nothing in the
  kit's pages changes. Only the react-fancy entry in the lockfile moved.

## 1.1.80 — 2026-10-23

### Changed

- **react-fancy 5.59.0 in the lockfile** (was 5.58.0). Additive: `PdfViewer`
  shows a readable "couldn't be shown" panel with Retry for a page image that
  fails to load, instead of a broken-image icon. Nothing in the kit's pages
  changes. Only the react-fancy entry in the lockfile moved.

## 1.1.79 — 2026-10-22

### Changed

- **react-fancy 5.58.0 in the lockfile** (was 5.54.1). All additive; nothing
  in the kit's pages changes.
  - 5.54.2: the default Button's fill follows the theme tokens.
  - 5.55.0: `TimeGrid` typed cells and rectangle / linear range selection.
  - 5.56.0: `Calendar` per-day hooks (`renderDay`, `dayClassName`,
    `dayAriaLabel`), stable date ids and a controlled visible month.
  - 5.57.0: `TimeGrid` column windowing (`windowColumns`).
  - 5.58.0: `MultiSwitch` per-option `color`.

  **What to do:** in an existing project, `npm update
  @particle-academy/react-fancy` if you want these. Only the react-fancy entry
  in the lockfile moved.

## 1.1.78 — 2026-10-21

### Security

- **vite 8.3.5 in the lockfile** (was 8.2.0). Vite bundles `launch-editor`, and
  the versions it shipped before had three Windows advisories, one high: an
  existence check that could be bypassed, missing `%` escaping, and editor CLI
  flags misread as commands. This kit's lockfile marks vite as a runtime
  package (fancy-pwa has a `vite` peer dependency), so every new
  `laravel new --using=particle-academy/fancy-starter-kit` project installed
  the vulnerable version for its dev server.

  **What to do:** in an existing project made from this kit, run `npm update
  vite`. New projects get the fix automatically.

### Changed

- **react-fancy 5.54.1 in the lockfile.**
  - Narrow buttons wrap their label (`labelClassName="truncate"` for one line).
  - Switch honours `labelHidden` and forwards `aria-*`.
  - Tooltip keeps its child's ref.

## 1.1.77 — 2026-10-21

### Changed

- **react-fancy 5.51.2 and fancy-app-update 0.6.0 in the lockfile.**
  - `Toast.Stack` puts its front card first in the page order, with no visual
    change.
  - `AppUpdateStack` adds small lowercase prev / next links, a "scroll" hint
    that fades in and out, and `open` / `onOpenChange` to show the latest cards
    on demand (with "got it" instead of refresh).

  **Nothing to do.** It is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.76 — 2026-10-21

### Changed

- **react-fancy 5.51.1 and fancy-app-update 0.4.0 in the lockfile.** A stacked
  toast's "+N" count badge is opaque in dark mode, so it stays readable over
  whatever is behind it. `AppUpdateStack` feature cards take an optional
  `imageDark`.

  **Nothing to do.** It is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.75 — 2026-10-20

### Changed

- **fancy-inertia 0.12.0** (the range moves from `^0.11.0` to `^0.12.0`, because
  a caret on a 0.x never reaches the next minor). It adds `AppUpdateStack` at
  `@particle-academy/fancy-inertia/stack`: the stacked "new version" notice with
  feature cards and Inertia's version check built in. `setupFancyApp({
  appUpdate })` now also accepts an element, so you can mount the stack there.

  **Nothing to do.** `appUpdate: true` and the alert-props object behave as
  before. The stack needs react-fancy `>=5.41.0`; this kit's lockfile has
  5.51.0.

## 1.1.74 — 2026-10-20

### Changed

- **react-fancy 5.51.0 in the lockfile.** Closed overlays (Drawer, Modal,
  Command, ContextMenu, Dropdown, the mobile menu) now unmount even when no exit
  animation runs. Paste-pill previews are a Popover, on hover and focus.
  `Chart.Sparkline` takes `min`, and `MagicWand` can attach to an external
  `target`.

  **Nothing to do** unless you styled the paste-pill preview through
  `[data-react-fancy-tooltip]`: it is now `[data-react-fancy-popover]`.
  `classNames.preview` still applies. It is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.73 — 2026-10-20

### Changed

- **fancy-app-update 0.3.0 in the lockfile** (through fancy-inertia and
  fancy-pwa). It adds `AppUpdateStack` at `fancy-app-update/stack`: a refresh
  notice that can show the release's feature cards, stacked like react-fancy's
  `Toast.Stack`, with a plain notice for a release with no message.

  **Nothing to do.** The kit's existing update prompt is unchanged; the stack is
  opt-in. It is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.72 — 2026-10-20

### Changed

- **react-fancy 5.50.0 in the lockfile.** `sanitizeHtml` gains an allowlist mode
  and `renderMarkdown` is exported; `FauxClient` with `fill` and `width` scrolls
  long content (5.49.1).

  **Nothing to do.** Both are opt-in; it is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.71 — 2026-10-19

### Security

- **react-fancy 5.49.0 in the lockfile, which includes 5.48.1's sanitiser fix:**
  untrusted HTML rendered through `ContentRenderer` could carry a `<title>` that
  renamed the browser tab. It is now stripped. Also new and opt-in: a framed
  `ImageViewer` / `PdfViewer` (`frame`).

  **Nothing to do** beyond taking the release; a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.70 — 2026-10-19

### Changed

- **react-fancy 5.48.0 in the lockfile.** Tab now accepts the highlighted
  suggestion in `PromptInput`'s `/` and `@` menus, as Enter does.

  **Nothing to do.** This scaffold does not mount `PromptInput`; it is a release
  because a fresh `laravel new --using=particle-academy/fancy-starter-kit` pulls
  *this* lockfile.

## 1.1.69 — 2026-10-19

### Changed

- **react-fancy 5.47.0 in the lockfile.** `FauxClient` gains a zoom bar and a
  full-screen button (`controls`), hidden until the frame is hovered.

  **Nothing to do.** It is opt-in and this scaffold does not mount `FauxClient`;
  it is a release because a fresh `laravel new --using=particle-academy/fancy-starter-kit`
  pulls *this* lockfile.

## 1.1.68 — 2026-10-19

### Changed

- **react-fancy 5.44.0 in the lockfile.** `Input` can hold a long paste as a
  pill (`pasteThreshold`) and post pasted images with its form (`pasteImages`),
  from the same paste-pill core `Composer` and `PromptInput` use.

  **Nothing to do.** Both are opt-in, and this scaffold's inputs are unchanged;
  it is a release because a fresh `laravel new --using=particle-academy/fancy-starter-kit`
  pulls *this* lockfile.

## 1.1.67 — 2026-10-17

### Changed

- **react-fancy 5.43.0 in the lockfile.** A click in a large `TreeNav` now
  re-renders only the rows it changes (measured 175–267 ms → 17–20 ms per click on
  a 5,000-node tree), and `virtualize` renders only the rows in view.

  **Nothing to do.** This scaffold does not mount `TreeNav`; it is a release
  because a fresh `laravel new --using=particle-academy/fancy-starter-kit` pulls
  *this* lockfile.

## 1.1.66 — 2026-10-17

### Changed

- **react-fancy 5.42.1 in the lockfile.** A filled `Button`'s icon and badge now
  take the label's colour instead of hard-coded white (invisible on light fills,
  including a dark-mode brand pair), and a `badge` or `avatar` no longer renders
  twice.

  **Nothing to do.** This scaffold's buttons carry no icon or badge on a light
  fill; it is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.65 — 2026-10-17

### Changed

- **react-fancy 5.42.0 in the lockfile.** Enter in `Command`'s input now picks the
  active (or first visible) item, and focus stays in the input while the arrows
  move the active item.

  **Nothing to do.** This scaffold does not mount `Command`; it is a release
  because a fresh `laravel new --using=particle-academy/fancy-starter-kit` pulls
  *this* lockfile.

## 1.1.64 — 2026-10-17

### Changed

- **react-fancy 5.41.1 in the lockfile.** Adds `Toast.Stack` (a controlled stack
  of actionable toasts that never drops an item) and `Command`'s
  `shouldFilter={false}` with a controllable `query`; exports `Toast.Item`, which
  the docs already described.

  **Nothing to do.** All of it is opt-in and this scaffold mounts none of it; it
  is a release because a fresh `laravel new --using=particle-academy/fancy-starter-kit`
  pulls *this* lockfile.

## 1.1.63 — 2026-10-15

### Changed

- **react-fancy 5.39.0 in the lockfile.** `PromptInput` gains the inline paste
  pills `Composer` got in 5.38.0 (`pasteThreshold`, `pasteImages`), plus a quieter
  footer: icon attach and send buttons, a `near-limit` meter, and `usedTokens` for
  a real usage value.

  **Nothing to do.** All of it is opt-in and this scaffold does not mount
  `PromptInput`; it is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this* lockfile.

## 1.1.62 — 2026-10-14

### Changed

- **react-fancy 5.38.0 in the lockfile.** `Composer` can now put paste pills
  inline, where the paste happened (`pastePlacement="inline"`), hold pasted
  images as pills (`pasteImages`), and restyle the pills and their hover popover
  (`classNames`, `renderPastePreview`, `previewChars`). `Tooltip`'s arrow now
  follows a restyled bubble.

  **Nothing to do.** Every new `Composer` behaviour is opt-in and this scaffold
  does not mount `Composer`; it is a release because a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this*
  lockfile.

## 1.1.61 — 2026-10-11

### Changed

- **react-fancy 5.37.0 in the lockfile**, superseding the 5.36.1 this file
  pinned an hour ago. 5.36.2 corrected an example host in `<QrCode>`'s
  documentation to an RFC 2606 reserved name, and 5.37.0 reframed the component
  as what it always was — a byte container rather than a link component.

  **Nothing to do**, and this scaffold still does not mount `QrCode`. The
  reason it is a release is the same as last time: a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this*
  lockfile.

  **5.36.0 and 5.36.1 should not be used.** They are superseded and could not
  be unpublished — npm refuses once a package has dependents in the registry,
  and 20+ of our own packages depend on react-fancy. `^5.30.0` resolves to the
  newest, so an ordinary install never selects them; only an explicit pin
  would.

## 1.1.60 — 2026-10-11

### Changed

- **react-fancy 5.36.1 in the lockfile.** Starter-kit lockstep, same session as
  the ship. 5.36.0 added `<QrCode>` — a dependency-free QR code as an SVG — and
  5.36.1 made its encoder refuse an over-long value in constant time rather
  than linear.

  **Nothing to do, and this scaffold does not mount `QrCode`**, so nothing here
  changes shape. The reason it is still a release is that a fresh
  `laravel new --using=particle-academy/fancy-starter-kit` pulls *this*
  lockfile, so without it every new project would start on a react-fancy two
  versions behind.

  The declared range stays `^5.30.0`. The lockfile is what pins the version a
  new project gets; narrowing the range would only raise the floor for anyone
  who later runs `npm update`, and nothing here needs 5.36.

## 1.1.59 — 2026-10-10

### Changed

- **`react-fancy` moves to 5.35.1 in the lockfile**, a one-character fix to
  `ActivityLight`: the `direction="both"` mark was U+21C4 (`⇄`), which the
  Liberation fonts do not cover, so a container carrying only those drew arrows
  for `in` and `out` and a tofu box for `both`. It is now U+2194 (`↔`), which
  they do cover.

  **Nothing for you to do.** No prop, data attribute or accessible name changed,
  and the mark is decorative. As with 1.1.58, this is a release rather than a
  chore only because **a fresh `laravel new` pulls this lockfile** — the version
  recorded here is the version every new project starts from. The declared range
  (`^5.30.0`) is untouched.

  Verified before tagging: 22 tests pass (655 assertions) and both bundles build.
  No browser smoke this time: the scaffold does not mount `ActivityLight`, so
  there is no surface here in which the change could show up, and saying that is
  more honest than running a smoke test that could not have failed.

## 1.1.58 — 2026-10-10

### Changed

- **`react-fancy` moves to 5.35.0 in the lockfile**, which fixes two defects in
  `PromptInput`: its keyboard hint named a key non-Apple keyboards do not have
  (a hardcoded Command glyph, in the hint and the default placeholder), and its
  attach control drew as a tofu box wherever no colour emoji font is installed,
  because the icon was a literal emoji.

  **Nothing for you to do, and nothing changed in this scaffold’s own code.**
  This kit does not mount `PromptInput`, so no surface here changes shape — but
  a new project inheriting a stale lockfile would inherit the bug the moment it
  added a composer, which is the whole reason this is a release and not a chore:
  **a fresh `laravel new` pulls this lockfile.**

  If you DO add a composer, leave `placeholder` and `platform` unset. The
  component then names the modifier the visitor actually has, and reads the
  platform after mount so server-rendered HTML has nothing to disagree with.
  Pass `platform` only when your host knows better than `navigator` does — an
  Electron renderer, or a remote session where the keyboard is not the one
  running the browser.

  The declared range (`^5.30.0`) is untouched — only the resolved version in
  `package-lock.json` moved.

  Verified before tagging: 22 tests pass (655 assertions), the client and SSR
  bundles build, and a dev-mode smoke — Vite connected, the welcome page served
  and rendered, console clean apart from Vite’s own connect lines and React’s
  DevTools notice.

## 1.1.57 — 2026-10-09

### Changed

- **`react-fancy` moves to 5.34.0 in the lockfile**, which adds two
  components: `VirtualList` (a windowed list for tens of thousands of rows,
  with measured variable row heights, deep links by row id and sticky-bottom
  tail-following) and `ActivityLight` (activity on an edge between two
  parties, with a recency ramp).

  **Nothing for you to do, and nothing changed in this scaffold’s own code.**
  Both are new components; no existing export moved and no API changed. The
  declared range (`^5.30.0`) is untouched — only the resolved version in
  `package-lock.json` moved.

  It is a release rather than a chore because **a fresh `laravel new` pulls
  this lockfile**, so the version recorded here is the version every new
  project gets. A kit left behind ships a stale kit to everyone who starts
  from it.

  Verified before tagging: 22 tests pass (655 assertions), the client and SSR
  bundles build, and a dev-mode smoke — Vite re-optimising against the
  changed lockfile, the welcome page served and rendered, console clean apart
  from Vite’s own connect lines and React’s DevTools notice.

## 1.1.56 — 2026-10-06

### Security

- **`shell-quote` is no longer installed at a version with a command-injection
  advisory, and `source-map-js` no longer at one with a denial-of-service
  advisory.** Both arrive transitively through the build toolchain, and both are
  now pinned forward by an `overrides` block: `shell-quote` `^1.12.0` (the
  advisory covers 1.8.4 through 1.10.0; this kit shipped 1.9.0) and
  `source-map-js` `^1.2.2` (the advisory covers up to 1.2.1; this kit shipped
  1.2.1).

  **This one reached you, which is why it is a release rather than a chore.** A
  library's advisories in its own toolchain stay on the maintainer's machine —
  npm packages do not ship a lockfile. A starter kit does: `laravel new
  --using=particle-academy/fancy-starter-kit` resolves `package-lock.json` from
  this repo, so every scaffold created before today installed the flagged
  versions.

  `npm audit` now reports zero vulnerabilities. Nothing you wrote has to change —
  `npm install` on an existing scaffold picks up the pins.

## 1.1.55 — 2026-10-04

### Changed

- `@particle-academy/react-fancy` locked to **5.33.0**, which fixes two
  `FileUpload` defects: a `multiple={false}` field could never replace its file,
  and choosing the same file twice did nothing because the hidden input was
  never reset. The declared range (`^5.30.0`) already admitted it — the lockfile
  is the part that matters here, since `laravel new` installs from it, so a new
  scaffold would otherwise have shipped 5.30.0 indefinitely.

## 1.1.54 — 2026-09-30

### Changed

- **`@particle-academy/react-fancy` 5.29.1 → 5.30.0**, range `^5.30.0`.
  **Nothing to do on upgrade.** The release closes `Card`'s feature gap against
  Flux UI and every addition is optional, with defaults chosen so a card written
  before it renders byte-identically.

  What is now available without adding a dependency:

  - `Card.Header` / `Card.Footer` compose from `heading`, `description` and
    `actions` — no flex wrapper from the caller, and they work standalone above
    a card.
  - `sections="divided" | "plain" | "banded"` and `dividerInset` for how the
    sections are set apart.
  - `size="xs" | "sm" | "md" | "lg"`, scaling padding and radius together.
  - `variant` gained `muted` and `soft`; `highlight` adds an inside-top hairline.
  - `Card.Bleed` runs content out to the card's edges.

  The one visible change to existing markup: a `Card.Header` or `Card.Footer`
  rendered OUTSIDE a `Card` no longer draws the rule of a card it is not inside.

  Verified here: 22 tests / 655 assertions passed, `tsc --noEmit` clean, client
  and SSR builds clean, and a dev-mode load with a clean browser console.

## 1.1.53 — 2026-09-30

### Security

- **Four security fixes in the shipped `composer.lock`.** A fresh
  `laravel new --using=particle-academy/fancy-starter-kit` installs THIS
  lockfile, so an advisory sitting in it is an advisory every new project starts
  life with. Nothing else moved: no first-party package changed version, and
  `package-lock.json` is untouched.

  - `laravel/framework` v13.23.0 → **v13.34.0** — XSS in the debug page
    information (low).
  - `league/commonmark` 2.10.0 → **2.10.3** — quadratic-time denial of service
    in the GitHub Flavored Markdown table extension's block-start scan
    (**high**), and `DisallowedRawHtml` bypassed when a disallowed tag name ends
    the raw-HTML literal (medium).
  - `league/flysystem` 3.35.2 → **3.36.0** and `league/flysystem-local` 3.31.0 →
    **3.35.3** — CVE-2026-102601: `WhitespacePathNormalizer`'s control-character
    (`CorruptedPathDetected`) check is bypassed by malformed UTF-8 in a path,
    affecting every adapter (low).

  **Only the commonmark high one was reported by Dependabot? No — the reverse.**
  Dependabot had opened an alert for the Laravel XSS ALONE. The other three came
  from `composer audit`, which reads Packagist's advisory database directly. Two
  tools, two answers, and the quieter one was the one with an alert attached to
  it. Worth knowing before trusting an empty alert list as an all-clear.

  **What you must do: nothing** beyond taking this release. No API changed and no
  constraint in `composer.json` moved — every one of these was already admitted
  by the existing ranges, so the fix is purely which versions the lockfile
  resolves.

### Verified

- `php artisan test --compact`: 22 passed, 655 assertions. `npm run build`
  clean, including the SSR bundle.
- `composer audit`: **no advisories of any severity** remain.
- Deliberately NOT bumped: `guzzlehttp/guzzle`. Resolving the framework with
  `--with-all-dependencies` dragged guzzle 7.15.2 → **8.2.0** and promises/psr7
  across majors too — 46 packages in total. That is not what a security patch
  owes a scaffolding lockfile, so the update was narrowed to the four packages
  with advisories against them.

## 1.1.52 — 2026-09-29

### Changed

- **`@particle-academy/react-fancy` 5.29.0 → 5.29.1**, range `^5.29.1`.
  Documentation only: how to theme `color="brand"` per mode now ships in
  react-fancy's README. If you set the brand variables for dark mode, swap
  `--color-brand` and `--color-brand-contrast` TOGETHER — changing one alone
  renders an unreadable button without erroring.

## 1.1.51 — 2026-09-29

### Changed

- **`@particle-academy/react-fancy` 5.28.1 → 5.29.0**, range `^5.29.0`.

  5.29.0 adds `color="brand"` to every component that takes a colour, resolved
  from three CSS variables (`--color-brand`, `--color-brand-contrast`,
  `--color-brand-hover`) rather than a Tailwind hue — so an app built from this
  kit can point the components at its own palette, including a hover that is a
  different colour rather than a darker shade.

  **What you must do: nothing.** Defaults keep the kit's violet. If you wrote
  your own exhaustive `Record<Color, …>` against react-fancy's `Color` type, it
  will now want a `brand` entry.

## 1.1.50 — 2026-09-28

### Changed

- **`@particle-academy/react-fancy` 5.28.0 → 5.28.1** in the lockfile that
  `laravel new --using=` installs, and the range moves to `^5.28.1`.

  5.28.1 fixes `contentEditableAdapter.replaceRange` flattening the element it
  edits, which capped `InputTag` at ONE tag in any contenteditable that renders
  elements.

  **What you must do: nothing**, unless your app uses `InputTag` over a
  contenteditable. The kit itself does not.

## 1.1.49 — 2026-09-28

### Changed

- **`@particle-academy/react-fancy` 5.27.0 → 5.28.0** in the lockfile that
  `laravel new --using=` installs, and the range moves to `^5.28.0`. This also
  picks up 5.27.1, which the kit had missed.

  5.28.0 fixes `FileUpload`'s `accept` and `multiple` props, which were declared
  on `FileUploadProps` and wired to nothing. `accept` is now enforced on the DROP
  path as well as in the browse dialog — a browser only enforces it in the file
  picker, and a drag-and-drop never opens one.

  **What you must do: nothing**, unless you added a `FileUpload` with an `accept`
  prop to your app. The kit itself does not use the component. If you did pass
  `accept`, files that previously got through will now be refused — which is what
  the prop was always supposed to do.

## 1.1.48 — 2026-09-14

### Changed

- **`@particle-academy/react-fancy` 5.26.0 → 5.27.0** in the lockfile that
  `laravel new --using=` installs. `<PromptInput>` now attaches a pasted image
  the way it already attached a dropped or picked one. `package.json` is
  unchanged; this is within the existing `^5.26.0` range.

  **What you must do:** nothing. If your app handles `paste` on an element
  wrapping `PromptInput`, remove that handler, or an image paste attaches twice.

## 1.1.47 — 2026-09-13

### Removed

- **`fakerphp/faker`.** Its last release and last commit were both on
  2026-02-04, which fails the Fancy UI rule that every third-party dependency
  has been maintained within the last three months — a rule CI enforces from
  2026-09-19. Laravel only defines the global `fake()` helper when Faker is
  installed, so **a new scaffold has no `fake()`**. The unused `faker_locale`
  setting and `APP_FAKER_LOCALE` went with it.

### Added

- **`Database\Factories\Support\FakeData`**, the kit's own fake-data generator,
  and what `UserFactory` now uses:
  `FakeData::shared()->name()` and `FakeData::shared()->unique()->safeEmail()`.
  It covers exactly the formatters the kit uses, returns a repeatable sequence
  when seeded (`->seed(1234)`), and its `unique()` throws once it runs out of
  values, as Faker's does. It is application code: add a method when a factory
  needs another kind of value. Documented in `README.md` and `AGENTS.md`.

**What to do:**

- **An app scaffolded from an earlier version: nothing.** Its own
  `composer.json` still requires Faker, and `fake()` keeps working.
- **A new app:** write `FakeData::shared()->…` where the Laravel docs write
  `fake()->…`. An older app that wants to drop Faker too can copy
  `database/factories/Support/` and `tests/Unit/FakeDataTest.php` across. Or run
  `composer require --dev fakerphp/faker` and keep using `fake()`; nothing in
  the kit depends on its absence.

### Fixed

- **Inertia looked for page components in `resources/js/pages`, and the kit's
  pages are in `resources/js/Pages`.** That is the package default, and it only
  shows up in tests: `assertInertia()->component('Welcome')` checks the file
  exists, a case-insensitive disk (Windows, default macOS) matches `pages` to
  `Pages`, and Linux does not. So a page test written on a laptop passed there
  and failed on the first Linux CI run with "Inertia page component file
  [Welcome] does not exist". The browser was never affected — `app.tsx` and
  `ssr.tsx` glob `./Pages`. The kit now publishes `config/inertia.php`
  (inertia-laravel 3.2.1's own file) with only the page path changed, and
  `InertiaPagesTest` compares the configured directory name with the disk
  exactly, so it fails on any OS if the two drift apart.

  **What to do in an existing app:** if you assert Inertia components in tests
  and run them on Linux, run
  `php artisan vendor:publish --provider="Inertia\ServiceProvider"` and set
  `pages.paths` to `resource_path('js/Pages')`. Otherwise nothing.

### Changed

- **`@particle-academy/fancy-echarts` 6.0.0 → 6.1.0** in the lockfile (the
  `^6.0.0` range already allowed it). Adds `useGraphRoam(instance)`, which lets
  a `graph` series pan and zoom from anywhere on the canvas rather than only
  over the nodes. Additive; nothing to do.

### Security

- **`league/commonmark` 2.9.0 → 2.10.0** in the lockfile, clearing four high
  advisories: an XSS through the `on*` attribute filter (bypassed with a U+000C
  form feed) and three denials of service in the SmartPunct and Attributes
  extensions and in crafted code fences, reference links and emphasis. It
  arrives through `laravel/framework`, and the lockfile is what
  `laravel new --using=` installs, so every scaffold since 1.1.46 received the
  vulnerable version. This landed on `main` on 2026-09-03 and ships here.
  **An existing app:** `composer update league/commonmark`.

## 1.1.46 — 2026-08-23

### Changed

- **react-fancy 5.21.0 -> 5.26.0.** The lockfile had drifted five minors
  behind, and the lockfile is what a fresh `laravel new --using=` actually
  installs — so every new scaffold was getting 5.21.0 regardless of the
  `^5.20.0` range in `package.json`.

  Two fixes land with it, both found on real surfaces:

  - **`<Card>` pads every direct child**, not only its `<div>` children. A card
    mixing element types used to come out half-padded, with the non-`div`
    children hard against the border.
  - **`<Callout>` forwards its rest props**, so `data-*` handles, `id`,
    `aria-*` and event handlers reach the DOM instead of being silently
    dropped.

  Verified on a running dev server rather than a build alone: vite client live,
  React Refresh preamble injected, app mounted, browser console clean.

## 1.1.45 — 2026-08-18

### Added

- **A working light / dark / system theme control.** A fresh scaffold now ships
  a `ThemeToggle` in the app header, on react-fancy 5.21.0's new theme
  controller.

### Fixed

- **The theme never followed the OS after first paint.** The inline script in
  `app.blade.php` read `prefers-color-scheme` once at boot and nothing listened
  afterwards, so changing the system theme with the app open did nothing until a
  reload. `app.tsx` now calls `initTheme({ storageKey: 'fancy.theme' })`, which
  keeps the existing key and adds the listener.
- **`fancy.theme` was read but never written.** Nothing in the scaffold could
  set it, so the branch handling a saved choice was unreachable and there was no
  way for a visitor to pick a theme at all. The new toggle writes it — and, for
  `system`, clears it, since following the OS is the absence of a choice rather
  than a third stored value.
- **A junk stored value fell back to light instead of to the system**, which
  could disagree with `initTheme()` and paint the page twice.

**Nothing to do on upgrade** for an existing app — but if you scaffolded before
this and want the control, copy `resources/js/components/ThemeToggle.tsx` and
add the `initTheme` call in `resources/js/app.tsx`.

## 1.1.44 — 2026-08-11

### Changed

- **`@particle-academy/react-fancy` 5.19.0 → 5.20.0.** `AudioViewer` and
  `VideoViewer` expose `preload` and now default to `metadata` instead of
  letting the browser choose `auto`. If you render either and relied on the file
  being fully buffered before playback, pass `preload="auto"`.

### Verified

- 7 tests / 15 assertions, client + SSR build, dev-mode browser check, clean
  console.

---

## 1.1.43 — 2026-08-11

### Changed

- **`@particle-academy/react-fancy` 5.18.0 → 5.19.0.** `Sidebar` gains an
  `embedded` prop for rails inside a container that owns its own chrome.
  Additive — nothing in this kit changes behaviour.

### Verified

- 7 tests / 15 assertions, client + SSR build, dev-mode browser check with a
  clean console.

---

## 1.1.42 — 2026-08-11

### Changed

- **`@particle-academy/react-fancy` 5.17.1 → 5.18.0.** `FileBrowser` gains an
  opt-in "New folder" button: pass `onCreateFolder` and it appears, leave it off
  and nothing renders. Additive — nothing in this kit changes behaviour.

### Verified

- 7 tests / 15 assertions, client + SSR build, and a dev-mode browser check
  (`npm run dev` + `php artisan serve`, `@vite/client` and `/@react-refresh`
  served, welcome page rendered, console clean).

---

## 1.1.41 — 2026-08-11

### Changed

- **`@particle-academy/fancy-screens` 0.7.0 → 0.7.1**, and the declared minimum
  moves with it.
- **`@particle-academy/fancy-doc-commons` 0.1.0 → 0.4.0** — a TRANSITIVE that had
  been pinned three minors back in the lockfile.

  This is the failure mode the kit is most exposed to and the least likely to
  notice: `package.json` looked entirely current, every declared range already
  permitted the newer versions, and `npm outdated` on the direct dependencies
  said nothing. But `laravel new` installs from the LOCKFILE, so every new app
  scaffolded from this kit was getting doc-commons 0.1.0.

  fancy-screens 0.7.1 is also what widens its `fancy-doc-commons` range to
  `>=0.4 <2.0`; on 0.7.0 the resolver had no reason to move off the locked 0.1.0.

### Verified

- 7 tests / 15 assertions, client + SSR production build, and a **dev-mode**
  browser check: `npm run dev` + `php artisan serve`, `@vite/client` and
  `/@react-refresh` both served, welcome page rendered, console clean. Dev mode
  is checked because building is not the same as running — v1.1.2 shipped with
  dev mode broken for exactly that reason.

---

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
