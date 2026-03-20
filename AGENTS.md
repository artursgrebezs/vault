# vault — AI / agent entry

This repository is the **vault** app (Laravel + Livewire). When the Cursor workspace root is **`grb/`** (sibling `grb-setup/`, `grb-vault/`), canonical **agent documentation** lives in the setup repo:

**→ [`../grb-setup/docs/vault/`](../grb-setup/docs/vault/README.md)**

Also read the workspace registry (project list and path resolution):

**→ [`../grb-setup/docs/WORKSPACE-REGISTRY.md`](../grb-setup/docs/WORKSPACE-REGISTRY.md)**

## If you only opened `vault/` as the workspace root

Paths above are wrong relative to the editor. Use:

- Canonical docs: clone or mount `grb-setup` and open `grb-setup/docs/vault/`, **or** open the parent `grb/` folder as workspace so `grb-setup/docs/` is available.

## Stack

- Laravel **13** + **Livewire 4** (SFC components under `resources/views/components/`, optional `⚡` prefix)
- **Admin UI** at **`/`** (dashboard) and **`/login`**: **Livewire Flux** + **Spatie Permission**; role **`super-admin`** (seed via `ADMIN_*` in `.env` + `php artisan db:seed`)
- **PostgreSQL** via Sail (`pgsql` service)
- **Vite** + **Tailwind 4.2+** + Flux CSS import; run `./vendor/bin/sail npm run build` (or `npm run dev`) after frontend changes
- Prefer **Sail** for PHP/Artisan/tests: `./vendor/bin/sail artisan …`
- Project-specific Cursor rules: `.cursor/rules/vault.mdc`

## Frontend build (Vite)

After substantive JS/CSS/Vite, Blade layout, or `vite.config.*` changes, run **`./vendor/bin/sail npm run build`** (or `npm run dev` while iterating). Full commands and Mix vs Vite notes: **`grb-setup/agent-skills/frontend-build/SKILL.md`**.

When the Cursor workspace root is **`grb/`**, the **frontend-build** skill is also under `grb/.cursor/skills/frontend-build/` and `grb-workspace.mdc` reminds agents to use it after material frontend edits.

## Testing and verification

For **new routes, Livewire pages, auth, or domain behavior**: add or extend **Feature** and **Livewire** tests under `tests/`, then run:

`./vendor/bin/sail artisan test`

Fix failures before considering the feature done. For **lint/format/static checks** (Pint, optional PHPStan, `composer validate`, npm lint scripts if defined):

`./vendor/bin/sail exec laravel.test ./vendor/bin/pint --test` (and see skill below)

**Skills** (canonical under `grb-setup/agent-skills/`; Cursor mirror under `grb/.cursor/skills/` when workspace root is `grb/`):

- **`php-test`** — `grb-setup/agent-skills/php-test/SKILL.md` (tests + layered frontend validation: Livewire/HTTP → **frontend-build** → optional Dusk/Pest browser → manual / Cursor Browser)
- **`code-verify`** — `grb-setup/agent-skills/code-verify/SKILL.md`

**`grb-setup/`** is **meta** (docs/infra): the same mandatory app test loop does not apply there unless a defined CI/test script exists.

## Documentation maintainer

After substantive changes, apply **`grb-setup/agent-skills/doc-maintainer/SKILL.md`** (from the `grb` monorepo checkout) so `grb-setup/docs/vault/` stays current.
