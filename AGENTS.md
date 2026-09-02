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

## Backend Architecture

Organize API business code by capability first and by Clean Architecture layer second. For example, use `App\Asset\Domain`, `App\Asset\Application`, and `App\Asset\Infrastructure` rather than global layer-first namespaces.

The allowed source-code dependency direction is:

```text
Infrastructure -> Application -> Domain
Infrastructure ----------------> Domain
```

These arrows describe imports and type dependencies, not every runtime method call:

- Domain contains aggregates, entities, value objects, domain events, and domain services. It must not depend on Application, Infrastructure, Symfony, Doctrine, HTTP, or persistence concerns.
- Application implements use cases and orchestration. It may depend on Domain and on ports owned by Application, but it must not import Infrastructure or framework-specific infrastructure contracts.
- Infrastructure contains HTTP controllers, persistence implementations, external-service adapters, framework configuration, and other technical details. It may depend on Application and Domain.
- Symfony's dependency injection configuration is the composition root that wires infrastructure implementations into application ports.

When an application use case needs an external capability, define a purpose-specific port in Application. For example, `CreateAssetHandler` may depend on an application-owned `VehicleDataProvider`; an infrastructure `HttpVehicleDataProvider` implements that port and may depend on Symfony's `HttpClientInterface`. The injected runtime object is an infrastructure implementation, but the Application source code still depends only on its own abstraction.

Use a concept-first structure within each capability and introduce subdirectories only when a cohesive concept needs them:

```text
Asset/
├── Domain/
│   ├── Asset.php
│   ├── AssetId.php
│   ├── AssetName.php
│   ├── Hierarchy/
│   │   └── ImmediateChildFinder.php
│   └── Event/
│       └── AssetCreated.php
├── Application/
│   ├── CreateAsset/
│   │   ├── CreateAssetCommand.php
│   │   └── CreateAssetHandler.php
│   └── Port/
│       ├── AssetRepository.php
│       └── VehicleDataProvider.php
└── Infrastructure/
    ├── Http/
    ├── Persistence/Doctrine/
    └── VehicleData/
```

- Do not create parallel `Model`, `Entity`, and `ValueObject` directories by default. Entities and value objects are already parts of the domain model.
- Prefer directories named after domain concepts, such as `Hierarchy`, over generic `Services` directories.
- Name application orchestrators after one use case with a `Handler` suffix, such as `CreateAssetHandler`. Avoid broad application classes such as `AssetService`.
- Name domain services after a precise domain capability, such as `ImmediateChildFinder`; avoid context-free names such as `IsEqual`.
- Keep behavior on an aggregate or value object when it naturally belongs there. For example, equality usually belongs on the relevant value object as `equals()` rather than in a standalone service.
- Keep Doctrine mapping and Symfony-specific adapters in Infrastructure so Domain objects remain framework-independent.

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

## Commit Discipline

- Create commits automatically as work is completed unless the user explicitly asks to leave changes uncommitted or committing is unsafe or blocked.
- Make each commit a single cohesive change. Do not combine unrelated features, fixes, refactors, formatting, or documentation in one commit merely because they belong to the same task.
- It is acceptable, and often preferable, for separate commits to modify the same file when the edits represent distinct logical changes.
- Keep implementation and its directly related tests together. Do not split changes that need each other to build, run, or explain their intent.
- Keep each commit reviewable and independently valid where practical. Run the most relevant available checks before committing.
- Inspect the working tree before staging. Stage explicit files or hunks and never include unrelated or pre-existing user changes in a commit.
- Use a Conventional Commit-style subject, including an appropriate scope when useful, followed by a concise explanatory body.
- In every commit body, explain why the change is needed, what behavior or implementation changed, and how it was verified.
