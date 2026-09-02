# Architecture

Wrenchbase is a monorepo with a Symfony API, a Next.js browser application, PostgreSQL, and Docker Compose. The browser application is the primary client today, with a React Native client planned for the future.

## Repository Layout

```text
wrenchbase/
├── api/
├── web/
├── docs/
├── compose.yaml
├── Makefile
└── README.md
```

The future `mobile/` directory should not be created until mobile application work begins.

## Application Boundaries

- Keep business rules, authorization, validation, and persistence behavior in the API.
- Treat the API as the source of truth for both the browser application and the future mobile application.
- Keep client-specific presentation and interaction logic in the relevant client directory.
- Design API contracts for both browser and React Native clients; avoid coupling responses to Next.js-specific behavior.
- Do not duplicate domain rules across clients when the API can enforce them.

## Backend Architecture

Organize API business code by capability first and by Clean Architecture layer second. For example, use `App\Asset\Domain`, `App\Asset\Application`, and `App\Asset\Infrastructure` rather than global layer-first namespaces.

The allowed source-code dependency direction is:

```text
Infrastructure -> Application -> Domain
Infrastructure ----------------> Domain
```

These arrows describe imports and type dependencies, not every runtime method call:

- Domain contains aggregates, entities, value objects, domain events, and domain services. It must not depend on Application, Infrastructure, Symfony, Doctrine, HTTP, or persistence concerns.
- Application implements use cases and orchestration. It may depend on Domain and ports owned by Application, but it must not import Infrastructure or framework-specific infrastructure contracts.
- Infrastructure contains HTTP controllers, persistence implementations, external-service adapters, framework configuration, and other technical details. It may depend on Application and Domain.
- Symfony dependency injection is the composition root that wires infrastructure implementations into application ports.

When an application use case needs an external capability, define a purpose-specific port in Application. For example, `CreateAssetHandler` may depend on an application-owned `VehicleDataProvider`; an infrastructure `HttpVehicleDataProvider` implements that port and may depend on Symfony's `HttpClientInterface`.

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
- Keep behavior on an aggregate or value object when it naturally belongs there. Equality usually belongs on the relevant value object as `equals()` rather than in a standalone service.
- Keep Doctrine mapping and Symfony-specific adapters in Infrastructure so Domain objects remain framework-independent.

## Frontend Architecture

Organize browser application code by capability first and by Clean Architecture layer second. Capabilities should reflect product concepts such as assets, asset types, maintenance jobs, maintenance plans, and due work rather than pages or framework features.

The allowed source-code dependency direction is:

```text
Presentation   -> Application -> Domain
Infrastructure -> Application -> Domain
Composition    -> Presentation
Composition    -> Application
Composition    -> Infrastructure
```

These arrows describe imports and type dependencies, not every runtime method call:

- Domain contains only genuine client-owned domain concepts and pure behavior. It must not depend on Application, Infrastructure, Presentation, React, Next.js, TanStack Query, HTTP, IndexedDB, or browser APIs.
- Application implements client use cases and orchestration. It owns purpose-specific ports, commands, and read models and may depend on Domain, but it must not import concrete Infrastructure or presentation and framework contracts.
- Infrastructure implements Application ports using HTTP, IndexedDB, browser APIs, and other external systems. It owns API request and response DTOs, runtime response parsing, and mapping those DTOs to Application read models or Domain objects.
- Presentation contains React components and presentation adapters such as TanStack Query hooks. It may depend on Application and Domain, but it must not import concrete Infrastructure implementations.
- Composition is the only area that wires concrete Infrastructure implementations into Application use cases and makes those use cases available to Presentation or Next.js delivery code. Keep browser and server composition separate when their available APIs or configuration differ.
- Next.js `app/` files are delivery code. Keep pages, layouts, providers, loading states, and error boundaries thin and delegate workflows through Application boundaries.

Source-code dependencies point inward even though a runtime call may begin in Presentation, enter an Application use case, and reach Infrastructure through an Application-owned port.

Do not recreate API aggregates in TypeScript merely because the API returns their data. Use precise names for the different representations:

- Infrastructure DTOs describe external wire formats and remain private to Infrastructure.
- Application read models describe the data returned by a query use case.
- Presentation view models may adapt Application output when a view needs a materially different shape.
- Domain objects model framework-independent client behavior only when the browser application genuinely owns that behavior.

For example, an asset details response is normally an Infrastructure DTO mapped to an Application read model, not a second implementation of the API's `Asset` aggregate. Offline maintenance job drafts, queued attachments, and sync states may form a client Domain because they have meaningful behavior before the API receives them. The API remains authoritative when queued work is submitted.

Use a capability-first structure and introduce layers only as the capability needs them:

```text
web/src/
├── app/
├── composition/
│   ├── browser/
│   └── server/
├── features/
│   ├── assets/
│   │   ├── application/
│   │   ├── infrastructure/
│   │   └── presentation/
│   └── maintenance-jobs/
│       ├── domain/
│       ├── application/
│       ├── infrastructure/
│       └── presentation/
└── shared/
```

The `features/` directory is a Wrenchbase convention, not a special Next.js directory. Do not create empty layers in advance. A capability such as assets does not need a Domain directory until it contains genuine client-owned domain behavior.

For simple API-backed reads, a small Application use case and port are sufficient; do not require classes or broad service objects. Presentation may use TanStack Query to execute the use case and manage browser server state, but its query function must call the Application boundary rather than import an HTTP adapter directly.

Use separate server and browser composition when needed:

- Server composition may use server-only configuration such as `INTERNAL_API_URL` and may load data for Server Components.
- Browser composition may use public configuration, IndexedDB, connectivity APIs, and other browser-only adapters.
- Server-rendered data that remains interactive may be prefetched and hydrated into TanStack Query using the same query identity on both sides.

Do not use Next.js Route Handlers or Server Functions as a second business backend. Add them only when a delivery-specific boundary is needed, and keep business rules, authorization, validation, and persistence in the Symfony API.

## Domain Storage

Keep core maintenance concepts relational and use flexible attribute values only where flexibility is required.

Planned core entities include:

- `asset_types`
- `asset_type_attributes`
- `assets`
- `asset_attribute_values`
- `maintenance_plans`
- `maintenance_plan_items`
- `jobs`
- `job_attachments`

## Configurable Asset Types

Users can define asset types such as car, scooter, tire, battery, engine, appliance, or tool. Each asset type can define attributes appropriate to that type.

Assets must belong to an asset type. Assets may also have a parent asset, allowing nested structures:

```text
Car
  Engine
  Battery
  Tire Set
    Front Left Tire
    Front Right Tire
```

## Attribute Values

Attribute values should use a hybrid storage model:

```text
asset_attribute_values
  id
  asset_id
  asset_type_attribute_id
  value_json
  value_text
  value_number
  value_date
  value_boolean
```

`value_json` supports flexible or complex values. Typed columns make filtering and reporting practical for common values such as dates, numbers, and booleans.

Asset type attributes should not be hard-deleted once used by an asset:

- An unused attribute may be deleted.
- A used attribute should be archived or deactivated.
- Archived attributes should remain visible on assets that already have values.
- Archived attributes should not appear by default when creating new assets.

This preserves historical data and prevents orphaned values.

## Maintenance Plans

Maintenance plans represent manufacturer or custom recommendations. Plan items may be triggered by distance, time, usage hours, or manual conditions.

The due-work engine should compare completed jobs against active maintenance plan items and return statuses such as:

- `ok`
- `due soon`
- `overdue`
- `never done`

## Frontend State

Use TanStack Query for server state such as assets, jobs, plans, and due-work summaries.

Use component state for simple UI state. Add a small client-state library only if UI state becomes difficult to manage with React alone.

Offline data should be stored in IndexedDB, likely through Dexie. Do not use `localStorage` for meaningful offline data.

## Offline Scope

The first version should avoid full offline-first behavior.

Supported in v1:

- Cached offline read access for recently viewed assets and histories
- Offline creation of maintenance job drafts
- Queued photo and receipt uploads
- Sync status and outbox view

Online-only in v1:

- Asset type changes
- Asset attribute changes
- Maintenance plan changes
- Edits and deletes of existing records

Suggested sync states are `pending`, `syncing`, `synced`, `failed`, and `needs_review`.
