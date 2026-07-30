# Fancy UI application guide

This application is built from the Fancy UI Laravel starter kit:

- Laravel 13 and PHP 8.3+
- Inertia 3 with React 19 and TypeScript
- Tailwind CSS 4 and Vite
- Fancy UI (`react-fancy`, `fancy-inertia`, and `fancy-query`)
- Laravel Fortify authentication

## Build with Fancy UI

- Prefer components from `@particle-academy/react-fancy` before creating an
  application-local primitive.
- Use `Button` or `ButtonColor`; `Action` is retired and remains only as a
  deprecated compatibility alias.
- Keep application pages in `resources/js/Pages`, reusable layouts in
  `resources/js/layouts`, and application-specific components in
  `resources/js/components`.
- Use `setupFancyApp` for the browser entry and `createFancyServer` for SSR so
  both entry points share the same provider tree.
- Use `fancy-query` for server state and Inertia hydration. Do not duplicate
  server data into a second application-local cache.
- Keep Tailwind styling token-driven. Extend the existing Tailwind v4 theme
  instead of introducing a parallel design system.

## Interactive component contract

Every stateful or interactive surface should be usable by both people and
agents:

- expose controlled state through `value` and `onChange`;
- give interactive elements stable IDs or explicit selector props;
- accept JSON-friendly data rather than requiring dynamic React children;
- keep mutations observable and suitable for an MCP bridge;
- stage destructive or prominent changes when human confirmation is useful.

Purely visual components only need a clear, typed authoring API.

## Commands

```bash
composer run setup
composer run dev
composer test
npm run build
vendor/bin/pint --dirty
```

`npm run build` produces both client and SSR bundles. Keep SSR-safe code in
shared modules and isolate browser-only APIs behind client boundaries.

## Adding Fancy components

Use the registry-backed CLI rather than copying components from package source:

```bash
npx fancy-cli@latest add <component>
```

Browse the available packages and components at
https://ui.particle.academy/packages.

## Before finishing a change

- Run the focused tests for the changed behavior.
- Run `composer test` for backend or full-stack changes.
- Run `npm run build` for frontend, dependency, or configuration changes.
- Run `vendor/bin/pint --dirty` after editing PHP.
- Exercise changed interactive UI in dev mode and check the browser console.
