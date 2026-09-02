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
