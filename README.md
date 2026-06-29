# Fancy UI — Laravel starter kit

A Laravel + Inertia + React 19 + Tailwind v4 starter kit with **Fancy UI**
preinstalled — use it in place of the official `react` / `vue` / `livewire`
starter kits when you want to build on the [Fancy UI](https://ui.particle.academy)
component suite.

It ships **Fancy Core** (`react-fancy` + `fancy-inertia` + `fancy-query`), full
**Fortify auth** (login, register, password reset, dashboard, profile/password
settings) with every page built on Fancy UI, and a Fancy-branded welcome page
with jump-off points to grow your app.

## Create a new app

```bash
laravel new my-app --using=particle-academy/fancy-starter-kit
cd my-app
npm install && npm run build
composer run dev
```

Then open http://localhost:8000.

## What's inside

- **Laravel 13** (`type: project`) + **Inertia** (`inertiajs/inertia-laravel`)
- **React 19 + TypeScript + Tailwind v4 + Vite**
- **Fancy Core** — `@particle-academy/react-fancy`, `@particle-academy/fancy-inertia`
  (the `setupFancyApp` client entry), `@particle-academy/fancy-query`
- **Fortify auth** — login / register / forgot + reset password, a protected
  dashboard, and profile / password settings — all rendered as Inertia pages
  built with Fancy UI primitives

```
resources/js/
├── app.tsx                 # client entry — setupFancyApp + providers
├── layouts/                # AuthLayout, AppLayout, SettingsLayout
└── Pages/
    ├── Welcome.tsx         # the branded welcome (guest)
    ├── Dashboard.tsx       # authenticated home
    ├── auth/               # Login, Register, ForgotPassword, ResetPassword
    └── settings/           # Profile, Password
```

## Add components

Vendor Fancy components straight into your app with the CLI:

```bash
npx fancy-ui add data-table        # one primitive
npx fancy-ui add catalog-fms       # a full block (pricing, feature gating, …)
```

Browse everything at https://ui.particle.academy/packages, or ask the
`fancy-ui` MCP (`start_project`, `search_components`, `install_instructions`).

## Auth (Fortify)

Authentication is powered by [Laravel Fortify](https://laravel.com/docs/fortify).
Tune features in `config/fortify.php` and the create/reset logic in
`app/Actions/Fortify/`. Two-factor auth is **off** by default — re-enable it in
`config/fortify.php` (it needs the `two_factor_*` columns + the
`TwoFactorAuthenticatable` trait on `App\Models\User`).

## SSR

This kit runs **client-only** out of the box (Inertia without an SSR node
process — `setupFancyApp` uses `createRoot`). To add Inertia SSR, create a
`resources/js/ssr.tsx` with `createFancyServer` from
`@particle-academy/fancy-inertia/server`, point `vite.config.js`'s `laravel({
ssr })` at it, and run `npm run build && php artisan inertia:start-ssr`.

## License

MIT.
