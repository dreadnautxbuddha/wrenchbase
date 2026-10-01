# Wrenchbase

Wrenchbase is an open-source, mobile-first maintenance tracker for vehicles,
equipment, and recursively nested assets.

It helps individuals and small teams keep a clear record of what they own or
operate, what work has been done, what components changed, and what maintenance
is due next.

## What It Tracks

- Versioned asset types and concrete assets such as cars, scooters, tools,
  machines, upgrades, and equipment
- Recursive component relationships, installation history, and physical
  locations
- Maintenance schedules, due work, meter readings, planned jobs, and completed
  service history
- Photos, receipts, invoices, part numbers, notes, maintainers, and costs
- Workspace notifications and scoped offline job drafting

## Product Direction

Many maintenance tools are either too narrow, focused only on cars, or too heavy, designed for large facilities and enterprise maintenance teams.

Wrenchbase aims to sit in the middle: flexible enough to model vehicles, parts, equipment, and nested assets, while remaining simple enough for individuals, hobbyists, small garages, and small teams.

## Stack

- PHP 8.5 and Symfony 8.1 API
- Next.js 16, React 19, and TypeScript frontend
- PostgreSQL 16 database
- Docker Compose for development and production images
- S3-compatible object storage for attachments

## Repository Layout

- `api/` contains the Symfony API and its PHPUnit test suite.
- `web/` contains the Next.js browser application, which is the primary client today.
- `docs/` contains the architecture, API contract, offline-sync contract,
  security policy, deployment guide, UX brief, and focused delivery documents.
- `_bmad-output/planning-artifacts/` contains the canonical PRD and its planning
  audit trail.
- `mobile/` is reserved for a future React Native client and does not exist yet.

## Development

Docker is the only host dependency. PHP, Composer, Node.js, npm, PostgreSQL, and all test tools run in containers.

```shell
make up
```

The web app is available at [http://localhost:3000](http://localhost:3000). The API is available at [http://localhost:8080](http://localhost:8080); HTTPS is also exposed at `https://localhost:8443` using Caddy's local development certificate.

```shell
make test       # PHPUnit
make api-qa     # GrumPHP: Composer, PHP CS Fixer, PHPStan, PHPUnit
make web-check  # ESLint and TypeScript
make check      # all checks
```

Run `make hooks` once to use the repository's containerized GrumPHP pre-commit hook. App-specific generated files are ignored by `api/.gitignore` and `web/.gitignore`; repository-wide editor and environment files are ignored at the root.

See [CONTRIBUTING.md](CONTRIBUTING.md) for testing, quality, documentation, and commit standards.

## Documentation

The [canonical PRD](_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/prd.md) is authoritative for product behavior. The [architecture spine](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) governs cross-unit invariants; [docs/architecture.md](docs/architecture.md) remains the detailed architecture reference, with section coverage in the [source reconciliation](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/source-reconciliation.md). Read the [API contract](docs/api-contract.md) before changing a client-visible endpoint, the [offline synchronization contract](docs/offline-sync.md) before changing queued work, and the [security and data lifecycle policy](docs/security-and-data-lifecycle.md) before changing identity, tenancy, or attachments.

Use the [deployment guide](docs/deployment.md) for portable production and AWS reference operations, and the [UX and accessibility brief](docs/ux-accessibility.md) for browser workflows.

## Project Status

Wrenchbase is currently in early development.

See the [canonical PRD](_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/prd.md) and [architecture spine](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) for current direction. The [detailed architecture reference](docs/architecture.md) and [source reconciliation](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/source-reconciliation.md) retain the source coverage.
