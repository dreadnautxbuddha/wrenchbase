# Wrenchbase

Wrenchbase is an open-source asset management and maintenance tracker for vehicles, equipment, and other nested assets. The browser application is the primary client, with mobile-first workflows and a future React Native application planned.

## Repository Layout

- `api/` contains the backend API. It uses PHP 8.5, Symfony 8.1, Doctrine ORM, and PostgreSQL.
- `web/` contains the browser application. It uses Next.js 16, React, and TypeScript. This is the primary user interface today.
- `mobile/` is reserved for the future React Native application and does not exist yet. Do not create it unless a task explicitly requires mobile application work.
- `docs/` contains project and product documentation.

Follow the nearest `AGENTS.md` when working inside a subdirectory. Directory-specific instructions supplement this file and take precedence when they conflict with it.

## Product Direction

- Keep the product useful for individuals, hobbyists, small garages, and small teams.
- Design browser workflows mobile-first while retaining a good desktop experience.
- Support configurable asset types and attributes.
- Support parent and child asset relationships.
- Preserve historical maintenance records.
- Treat maintenance jobs as append-friendly records with clear history behavior.
- Keep offline support scoped and practical for v1.

## Application Boundaries

- Keep business rules, authorization, validation, and persistence behavior in the API.
- Treat the API as the source of truth for both the web application and the future mobile application.
- Keep client-specific presentation and interaction logic in the relevant client directory.
- Design API contracts so they can support both browser and React Native clients; avoid coupling responses to Next.js-specific behavior.
- Do not duplicate domain rules across clients when they can be enforced by the API.

## Technology

- Backend: PHP 8.5, Symfony 8.1, and Doctrine ORM
- Browser client: Next.js 16, React, and TypeScript
- Future mobile client: React Native
- Database: PostgreSQL
- Local development: Docker Compose

## Engineering Guidance

- Prefer clear domain modeling over generic JSON-only storage.
- Use configurable attributes, but keep core concepts relational.
- Use archived or deactivated asset type attributes instead of deleting attributes that are already used.
- Preserve auditability and historical meaning when changing assets, maintenance plans, or completed maintenance records.
- Use TanStack Query for frontend server state.
- Use IndexedDB, likely through Dexie, for offline job drafts and queued attachments.
- Do not use localStorage for meaningful offline data.
- Keep asset type, attribute, and maintenance plan changes online-only in v1.
- Allow offline creation of maintenance jobs in v1, but avoid offline edits and deletes until sync behavior is more mature.

## Working in the Repository

- Keep changes scoped to the application or shared contract involved in the task.
- Update API behavior and consuming clients together when a contract changes.
- Add or update tests for behavior changes, especially domain rules and historical-record behavior.
- Run checks from the application directory you changed: `composer qa` in `api/` and `npm run check` in `web/`.
- Treat each application's manifest and lockfile as the source of truth for exact dependency versions.
