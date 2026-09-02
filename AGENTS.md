# Wrenchbase

Wrenchbase is an open-source, mobile-first asset management and maintenance tracker. The browser application is the primary client today, with a React Native client planned for the future.

## Instruction Scope

- Follow the nearest `AGENTS.md` when working inside a subdirectory. Directory-specific instructions supplement this file and take precedence when they conflict with it.
- Follow the [API instructions](api/AGENTS.md) for API architecture and PHPUnit standards.
- Follow the [web instructions](web/AGENTS.md) for browser application, offline behavior, and Vitest standards.
- The `mobile/` directory is reserved for the future React Native application. Do not create it unless a task explicitly requires mobile application work.

## Required Context

- Read the [product vision](docs/product-vision.md) before making product behavior or scope decisions.
- Read the [architecture](docs/architecture.md) before changing application boundaries, domain structure, persistence design, client state, or offline behavior.
- Follow the [contribution standards](CONTRIBUTING.md) for tests, quality checks, Markdown, and commits.
- Use the [README](README.md) for the repository layout, stack, development environment, and root commands.

## Repository-Wide Guardrails

- Keep the product useful for individuals, hobbyists, small garages, and small teams.
- Design browser workflows mobile-first while retaining a good desktop experience.
- Treat the API as the source of truth for business rules, authorization, validation, and persistence.
- Keep client-specific presentation and interaction logic in the relevant client.
- Design API contracts for both browser and React Native clients; avoid Next.js-specific response contracts.
- Preserve historical meaning when assets, configurable attributes, maintenance plans, or completed maintenance records change.
- Treat maintenance jobs as append-friendly records with clear history behavior.
- Keep core domain concepts relational while supporting configurable asset types and attributes.
- Keep offline support scoped and practical for v1, as defined in the product and architecture documentation.

## Working in the Repository

- Keep changes scoped to the application or shared contract involved.
- Update API behavior and every affected client together when a contract changes.
- Add or update tests in every application affected by a behavior change.
- Treat each application's manifest and lockfile as authoritative for exact dependency versions and available commands.

## Commit Discipline

- Create commits automatically as work is completed unless the user explicitly asks to leave changes uncommitted or committing is unsafe or blocked.
- Make each commit a single cohesive change. Do not combine unrelated features, fixes, refactors, formatting, or documentation.
- Separate commits may modify the same file when the edits represent distinct logical changes.
- Keep implementation and its directly related tests together.
- Keep each commit reviewable and independently valid where practical. Run the most relevant available checks before committing.
- Inspect the working tree before staging. Stage explicit files or hunks and never include unrelated or pre-existing user changes.
- Use a Conventional Commit-style subject, including an appropriate scope when useful.
- In every commit body, explain why the change is needed, what changed, and how it was verified.
