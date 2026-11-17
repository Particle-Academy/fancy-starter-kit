# Contributing to the Fancy Dev Kit starter kit

Notes for maintainers of the starter kit itself. Building an application with
the kit is in [AGENTS.md](./AGENTS.md); what the kit is, is in
[README.md](./README.md).

## This repo is copied into every new app

`laravel new my-app --using=particle-academy/fancy-starter-kit` copies this
repository into the new application. Everything here, including `AGENTS.md`,
`CLAUDE.md` and this file, lands in every app made from the kit. Write each
file for that reader.

## Why CLAUDE.md points at AGENTS.md here

Elsewhere in the Fancy kit, `CLAUDE.md` is a symlink to `CONTRIBUTING.md`,
because an agent working in a package repo is working ON that package. Here the
developer of a new app is working ON their app, and the guide they need is the
build-with-Fancy guide. So in this repo `CLAUDE.md` is a symlink (git mode
`120000`) to `AGENTS.md`. Keep it that way, and keep `AGENTS.md` complete: the
commands, tests, fake data and before-finishing checks belong there, not here.

## Checking a change to the kit

The kit's own checks are the app's checks, run from this repo:

```bash
composer test
npm run build
composer run dev   # then load the pages and check the browser console
```

Update `CHANGELOG.md` in the same commit as the change.
