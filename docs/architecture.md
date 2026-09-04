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
- Follow the [API contract](api-contract.md) for shared client behavior, the
  [offline synchronization contract](offline-sync.md) for queued work, and the
  [security and data lifecycle policy](security-and-data-lifecycle.md) for
  tenant and attachment handling.

## Identity and Tenancy

Wrenchbase delegates authentication to a standards-compliant OpenID Connect
issuer. Browser and future mobile clients use Authorization Code with PKCE; the
API accepts bearer access tokens and validates their issuer, audience, expiry,
and subject before loading a Wrenchbase user profile. Application code depends
on an identity port, not an identity-vendor SDK.

The API is multi-tenant. Workspace membership and named capabilities are loaded
for every workspace-scoped request, and repositories must scope every query and
mutation to the authorized workspace. Workspace identity is part of the API
path, rather than ambient server or browser state, so clients can safely switch
workspaces and background synchronization has an unambiguous tenant.

Use S3-compatible object storage through an Application-owned attachment port.
The API authorizes each upload and download and creates short-lived signed URLs;
clients never receive bucket credentials. Email delivery, OIDC validation,
object storage, clock access, and background delivery are infrastructure
adapters behind purpose-specific ports.

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

Organize browser application code by capability first and by Clean Architecture layer second. Capabilities should reflect product concepts such as workspaces, assets, asset types, maintenance schedules, jobs, and due work rather than pages or framework features.

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

Keep core maintenance concepts relational. Flexible values are allowed only where
the product needs them; they must not replace typed relationships, lifecycle
history, authorization, or due-work rules. The normative behavior is defined in
the [product requirements](product-requirements.md).

The domain will need relational capabilities for:

- workspaces, members, capabilities, sites, and nested locations
- versioned asset types, typed attributes, meters, and component roles
- assets, direct placements, component installations, movements, and lifecycle
  states
- maintenance schedules, revisions, requirements, typed triggers, assignments,
  overrides, and baselines
- meter readings and inherited component usage
- jobs, work items, requirement completions, maintenance needs, participants,
  costs, and attachments
- notifications, reports, and offline outbox state

Do not choose a final table layout before the relevant capability is implemented.
The API must preserve the following invariants regardless of persistence shape:

- Every record is scoped to a workspace and authorization is capability-based.
- Published asset type and schedule revisions are immutable.
- An active asset is either directly placed in one location or installed in one
  parent asset, never both or neither.
- Asset and location hierarchies are acyclic.
- Jobs and their completed work preserve historical snapshots; corrections use
  amendments or voids rather than silent rewrites.
- Completed work is the only source that resets a maintenance requirement.
- Archived, retired, disposed, voided, and soft-deleted records retain their
  distinct historical meanings.

## Configurable Asset Types and Values

Asset types are reusable blueprints, not merely broad categories. A type can be
generic, such as `Keyboard`, or specific, such as `2024 Yamaha NMAX`. A type
revision defines typed attributes, meters, component roles, and named schedule
alternatives. Types compose through component roles but do not inherit from
other types.

Use a hybrid value model for configured attributes: typed columns or relations
for text, numbers or measurements, booleans, dates, and choices; structured
data only for genuinely complex future field kinds. Keep field identities stable
across revisions so archived fields and their values remain explainable.

Model independently maintainable, replaceable, reusable, or reportable parts as
assets. Model ordinary consumables as work-item materials. Component
installations are dated relations, not a timeless `parent_id`, because a child
may be replaced, moved, retired, or installed elsewhere.

## Schedules, Usage, and Time

Maintenance schedules and asset types use independent immutable revision
streams. A concrete asset selects one base schedule alternative and may have
explicit additions, disables, and overrides. Schedule requirements retain stable
identities across ordinary revisions so completion history follows a corrected
rule without title matching.

Represent schedule triggers as typed variants. The first version supports
one-time date or meter milestones, elapsed intervals, meter intervals, calendar
recurrences, and manual requirements. It also supports initial phases, rolling
or anchored recurrence, and first-reached or all-reached trigger policies. Keep
the evaluator extensible; do not persist executable formulas or arbitrary rule
expressions.

Asset types may define multiple meters. Components inherit compatible host usage
while installed unless a component uses its own meter. Store meter readings and
their corrections as history. The API calculates due work from effective
readings, schedule baselines, completed work, and active placements.

Store instants in UTC and calendar-only facts as dates. Calendar recurrences are
evaluated in the asset site's IANA timezone. Snapshot a job's location and
timezone so later moves or site edits never reinterpret history.

## Jobs, Reports, and Notifications

A job is a service event with targeted work items. Work items may be ad hoc or
explicitly fulfill requirements. Job status and work-item completion are
separate so a closed job can preserve completed, deferred, and not-done work.
Use a purpose-specific replacement operation to atomically end one installation
and start another.

Store receipts and invoices at job scope and evidence at job or work-item scope.
Keep one job total plus optional work-item allocations to avoid double-counting
cost. Model maintainers as reusable people or organizations and allow workspace
members to participate directly.

The API owns due-work calculation, notification eligibility, report data, and
authorization. The browser renders those read models and must not replicate the
schedule evaluator or lifecycle rules.

## Frontend State and Offline Scope

Use TanStack Query for server state such as assets, schedules, jobs, due-work
summaries, notifications, and reports. Use component state for simple UI state.
Add a small client-state library only if UI state becomes difficult to manage
with React alone.

Offline data belongs in IndexedDB, likely through Dexie; do not use
`localStorage` for meaningful offline data. Cache recently used and explicitly
pinned asset trees. Draft jobs, readings, attachments, and replacement proposals
can be created offline using cached types. Asset type and schedule authoring are
online-only.

The client owns local draft behavior and sync presentation. It generates stable
idempotency IDs, synchronizes while the app is open or returns to the foreground,
and exposes manual Sync now and Retry controls. The API validates and atomically
publishes completed jobs. It returns semantic conflicts for member review rather
than guessing how to merge stale component, schedule, meter, or lifecycle state.

Use sync states `pending`, `syncing`, `synced`, `failed`, and `needs_review`.
Do not promise synchronization while the browser is closed in the first version.
