# Vault

Laravel **13** + **Livewire 4** + **PostgreSQL** (via Laravel Sail). Replaces `grb-vault` over time.

## Quick start (Sail)

```bash
cp .env.example .env   # if needed; ensure DB_* and APP_PORT match below
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install && ./vendor/bin/sail npm run build
```

Open **http://vault.local:9089** (via Caddy) or **http://localhost:9083** directly.

- Demo Livewire page: `/demo/counter`
- Local hostname: add `vault.local` to `/etc/hosts` (see `grb-setup/README.md`)

## Ports (local)

| Setting | Default | Notes |
| ------- | ------- | ----- |
| `APP_PORT` | `9083` | Published HTTP; Caddy proxies `vault.local:9089` → `9083` |
| `FORWARD_DB_PORT` | `54322` | Host port for Postgres |

## Agent docs

With the `grb/` workspace: [`grb-setup/docs/vault/`](../grb-setup/docs/vault/README.md)

## Repo

`git@github.com:artursgrebezs/vault.git`
