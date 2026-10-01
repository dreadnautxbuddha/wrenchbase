---
source: ../../../../docs/architecture.md
status: final
updated: 2026-09-22
---

# Reconciliation: Architecture

## Reconciliation verdict

`docs/architecture.md` remains the retained focused authority for application
boundaries, code organization, technical state ownership, persistence, and
platform integration. It is not replaced by the UX spines and is not a source
proposed for retirement.

Only explicit user-visible consequences migrate to `EXPERIENCE.md`. The source
does not establish a visual direction, token, layout, or component treatment,
so it contributes no independent rule to `DESIGN.md`. Where architecture names
a user-visible state, EXPERIENCE owns its meaning and behavior while DESIGN
obtains its accessible visual treatment from the approved visual and
accessibility sources.

The canonical PRD remains authoritative for product behavior, scope,
terminology, and milestone boundaries. Architecture refines technical and
client boundaries but does not silently override the PRD.

## Heading-complete mapping

### `# Architecture`

**Classification:** retained focused document; `EXPERIENCE.md` platform
foundation; deferred later platform.

Retain the Symfony API, Next.js browser application, PostgreSQL, Docker Compose,
and monorepo architecture here. Migrate only the user-facing platform boundary:
the browser is the primary client today. A React Native client is planned for a
future phase but is outside the first version, so it creates no current route,
surface, interaction, or component-parity requirement.

No `DESIGN.md` rule originates here.

**Detail not migrated:** all named implementation technologies remain in this
focused document. No qualitative UX detail is dropped.

### `## Repository Layout`

**Classification:** retained focused document; deferred later platform.

Retain the repository tree and the instruction not to create `mobile/` until
mobile application work begins. These are engineering constraints, not visible
information architecture.

The deferred React Native client must not be represented in the current screen
inventory, navigation, mocks, or component system.

**Detail not migrated:** directory names, root files, and repository-layout
rules remain entirely in architecture. No qualitative UX detail is dropped.

### `## Application Boundaries`

**Classification:** retained focused document; `EXPERIENCE.md` global
constraint.

Migrate these user-visible consequences to EXPERIENCE:

- UI controls and state presentation may anticipate returned Capabilities, but
  the API remains authoritative for business rules, authorization, validation,
  and persistence.
- Browser-specific presentation and interaction stay client concerns.
- Browser behavior must consume a client-neutral API rather than depend on
  Next.js-specific response semantics.
- The browser must not independently reproduce domain rules that the API owns.
- API errors and authoritative returned representations control visible
  success, validation, authorization, and conflict outcomes.
- Queued work, tenant/attachment handling, and shared client behavior remain
  bounded by `docs/offline-sync.md`, `docs/security-and-data-lifecycle.md`, and
  `docs/api-contract.md` respectively.

Retain the system-boundary and code-ownership rules in architecture. They do
not create new user-facing components or an information architecture.

**Detail not migrated:** directory placement and cross-client engineering
policy remain here. No visual decision is introduced.

### `## Identity and Tenancy`

**Classification:** retained focused document; `EXPERIENCE.md` authentication,
Workspace context, authorization, and attachment-state consequences; deferred
future client.

Migrate these user-visible consequences:

- Authentication is provider-neutral OpenID Connect; browser flows must not
  imply that a development provider is the product identity.
- Workspace identity is explicit in each Workspace-scoped route and request,
  so switching, recovery, and synchronization remain unambiguous.
- Available controls follow named Capabilities for the active Workspace.
- Cross-Workspace data never appears through switching or background work.
- Evidence upload and download remain authorized; any user-visible expiry or
  retry state must reflect the focused attachment contract rather than imply a
  permanent public URL.

Retain Authorization Code with PKCE, bearer validation, identity ports,
repository scoping, S3-compatible storage, signed URLs, bucket-credential
isolation, and infrastructure adapters in architecture and contract documents.
Do not invent an Evidence-expiry screen or recovery choice where the supplied
sources do not specify one.

The phrase “background synchronization” at line 43 is constrained by this
document's later rule and canonical PRD FR-33: the first version synchronizes
while the browser is open or returns to the foreground and does not promise
closed-browser synchronization.

**Deferred detail:** future native-client authentication and interaction.

### `## Backend Architecture`

**Classification:** retained focused document only.

Capability-first Clean Architecture, dependency directions, Domain/Application/
Infrastructure responsibilities, Symfony composition, ports and adapters,
concept-first directories, naming rules, aggregate behavior, and Doctrine
isolation remain entirely in architecture.

None of these source-code structures establishes visible navigation, screen
grouping, component names, user vocabulary, or visual hierarchy. No content
migrates to DESIGN or EXPERIENCE.

**Detail not migrated:** all content under this heading remains available in
the retained source; nothing is dropped.

### `## Frontend Architecture`

**Classification:** retained focused document; selected `EXPERIENCE.md`
state-authority consequences; deferred later capabilities.

Migrate only these user-visible consequences:

- Presentation consumes Application read models and may adapt them into view
  models without becoming a second implementation of API aggregates.
- The API remains authoritative when queued work is submitted.
- Offline Job drafts, queued attachments, and sync states may have meaningful
  client-owned behavior before submission.
- Loading and error behavior remains deliberate even though Next.js delivery
  pages, layouts, loading states, and error boundaries stay thin.
- Hydrated server data and interactive browser data must represent the same
  query identity rather than appear as contradictory records.

Retain dependency directions, layer responsibilities, DTO mapping, Composition,
directory structure, TanStack Query integration, server/browser composition,
and the prohibition on a second Next.js business backend as technical detail.

Capability-first source organization reflects Wrenchbase concepts but does not
define the visible information architecture. It does not authorize new
navigation groups or screens. Asset, Maintenance Schedule, Job, and Due Work
applications remain scoped to their PRD milestones.

**Detail not migrated:** framework and source-layout mechanics remain in the
retained architecture. No visual decision is created.

### `## Domain Storage`

**Classification:** retained focused document; selected `EXPERIENCE.md`
historical/state consequences; deferred later milestones; technical ambiguity.

Migrate these user-visible consequences, with the canonical PRD as their
product authority:

- Workspace scope and Capability authorization apply to every exposed record.
- Published Asset Type and Maintenance Schedule revisions remain immutable.
- Placement, hierarchy, Job correction, Requirement reset, and lifecycle
  states preserve their distinct meanings.
- Completed Work is the only source that resets a Requirement.
- Corrections use explicit amendment or void behavior rather than silently
  rewriting history.
- Archived, retired, disposed, voided, and soft-deleted records must not be
  collapsed into one generic status wherever a later surface exposes them.

Retain relational modeling, persistence-shape decisions, listed storage
capabilities, and database invariants in architecture. The UX spines reference
the PRD's canonical terminology rather than copying this heading's lowercase
technical prose.

The phrase “offline outbox state” in the relational-capabilities list is
technically ambiguous beside the later statement that meaningful offline data
lives in IndexedDB. Do not infer a second user-visible outbox or state taxonomy.
The storage distinction remains an architecture clarification, not a UX design
decision.

**Deferred detail:** user-visible Site, Location, Asset Type, Asset, Component,
Maintenance Schedule, Job, report, notification center, and offline
applications follow MVP 1 through MVP 5.

### `## Configurable Asset Types and Values`

**Classification:** retained focused document; deferred later-milestone
`EXPERIENCE.md` consequences.

Preserve for later UX planning:

- Asset Types are reusable blueprints, not loose categories.
- Asset Types compose through Component Roles and do not inherit.
- Typed configured values and stable field identities keep archived values
  explainable across revisions.
- Independently maintainable, replaceable, reusable, or reportable parts are
  Assets; ordinary consumables are Work Item materials.
- Installations are dated relationships, not timeless parentage.

These constraints inform later authoring, creation, hierarchy, history, and
replacement flows but do not define their routes, screens, controls, or visual
treatment. Do not invent those surfaces during this migration.

Retain hybrid-value storage and relational implementation in architecture.

**Deferred detail:** primarily MVP 1 Asset Type, Asset, Component Role,
Installation, and lifecycle UX; Maintenance Schedule alternatives continue in
MVP 2.

### `## Schedules, Usage, and Time`

**Classification:** retained focused document; deferred later-milestone
`EXPERIENCE.md` consequences.

Preserve for later UX planning:

- Asset Type and Maintenance Schedule revision streams are independently
  immutable.
- An Asset selects one base Maintenance Schedule and may explicitly add,
  disable, or override Requirements.
- Stable Requirement identity, not title matching, preserves completion
  history across ordinary revisions.
- Triggers use the canonical typed families and policies; the product does not
  accept executable formulas or arbitrary rule expressions.
- Meter corrections retain history, compatible Components may inherit host
  usage, and the API—not the browser—calculates Due Work.
- UI input and display must distinguish UTC instants, calendar-only dates, the
  Asset Site's IANA time zone, and the snapshotted Job Location/time zone.

Retain evaluator, persistence, and calculation mechanics in architecture. The
UX spines do not reproduce a schedule evaluator or invent schedule-authoring
screens.

**Deferred detail:** Maintenance Schedule, Requirement, Trigger, Baseline,
Meter Reading, Due Work, and time-display applications begin in MVP 2; Job
snapshot behavior applies in MVP 3.

### `## Jobs, Reports, and Notifications`

**Classification:** retained focused document; deferred later-milestone
`EXPERIENCE.md` consequences.

Preserve for later UX planning:

- A Job contains targeted Work Items; Work Items may be ad hoc or explicitly
  fulfill Requirements.
- Job status and Work Item completion remain separate, including completed,
  deferred, and not-done Work Items in a closed Job.
- Component replacement is one purpose-specific atomic operation.
- Receipts and invoices attach at Job scope; other Evidence may attach to the
  Job or Work Item.
- One Job total plus optional Work Item allocation avoids double counting.
- Maintainers remain distinct from participating Workspace Members.
- The API owns Due Work calculation, notification eligibility, reports, and
  authorization; the browser renders returned read models and does not copy
  schedule or lifecycle rules.

Retain data ownership, calculation, and atomic-operation mechanics in
architecture. This heading does not define a route model, report layout,
notification taxonomy, or component system.

**Deferred detail:** Jobs and Work Items are MVP 3; the due-work dashboard,
notification center, email, and reports are MVP 4.

### `## Frontend State and Offline Scope`

**Classification:** retained focused document; `EXPERIENCE.md` Offline and
State Patterns; deferred MVP 5; DESIGN has no direct rule; unresolved behavior
gap UX-OQ-8.

Migrate these user-visible consequences:

- Cache only recently used and explicitly pinned Asset trees.
- Draft Jobs, Meter Readings, attachments, and replacement proposals can be
  created offline from available cached data.
- Asset Type and Maintenance Schedule authoring remain online-only.
- The client owns local-draft behavior and synchronization presentation before
  authoritative submission.
- Synchronization occurs while the app is open, when it returns to the
  foreground, and under the other PRD-defined triggers; expose manual
  **Sync now** and **Retry** controls.
- The API validates and atomically publishes a completed Job.
- Semantic conflicts require Member review and never guess-merge stale
  Component, Maintenance Schedule, Meter, or lifecycle state.
- The client sync states are exactly `pending`, `syncing`, `synced`, `failed`,
  and `needs_review`; they are not Job lifecycle states.
- Do not promise synchronization while the browser is closed in the first
  version.

Retain TanStack Query, React component-state strategy, the conditional use of a
client-state library, IndexedDB, likely Dexie, idempotency-ID generation, and
adapter mechanics in architecture. `localStorage` must not hold meaningful
offline data; the PRD's separately permitted last-selected Workspace identifier
remains allowed.

Canonical PRD FR-32 also permits offline Asset creation only from cached
existing Asset Types. Its omission from this architecture summary does not
narrow product behavior. EXPERIENCE must preserve the PRD rule without
claiming architecture as its source.

UX-OQ-8 remains unresolved: the supplied sources name sync states and core
controls but do not fully specify user-visible behavior for pending, syncing,
synced, interrupted partial progress, authorization failure during sync, stale
cache freshness, or cleanup of synchronized outbox entries. Do not invent those
interactions. DESIGN obtains non-color-only state treatment from the visual and
accessibility sources, not from architecture.

## Conflict and gap register

### Resolved by authority or a more precise statement

- **Offline Asset creation omission.** Architecture does not mention it under
  offline scope; canonical PRD FR-32 explicitly permits it only from cached
  existing Asset Types. The PRD controls, and the omission does not remove the
  behavior.
- **Background synchronization wording.** The broad phrase under Identity and
  Tenancy does not promise closed-browser synchronization. The later
  architecture rule and PRD FR-33 limit first-version synchronization to the
  open/foreground behavior they define.
- **Sync vocabulary.** Use `pending`, `syncing`, `synced`, `failed`, and
  `needs_review` as client sync states. Source spelling variants such as
  `needs-review` do not replace the canonical literal, and none becomes a Job
  lifecycle state.
- **Meaningful `localStorage` data.** Architecture prohibits it while the PRD
  permits only the last selected Workspace identifier. These statements are
  compatible and must remain distinct.
- **Visible IA versus source architecture.** Capability-first code organization
  does not override the approved route model or establish navigation.

### Unresolved or intentionally unspecified

- **UX-OQ-8 sync behavior.** Exact presentation and recovery for several named
  sync and cache conditions remains undefined, as recorded in the memlog.
- **Offline outbox storage wording.** “Offline outbox state” appears in the
  relational-capability list while client offline data is assigned to
  IndexedDB. This is a technical clarification for architecture/offline-sync
  ownership; the UX migration must not invent two outboxes.
- **Evidence signed-URL recovery.** Architecture establishes short-lived,
  authorized access but does not specify user-facing expiry or retry behavior.
  Use the focused security/API contracts where they decide it; otherwise record
  the later surface gap rather than inventing a screen.
- **`likely` Dexie.** The storage wrapper is explicitly tentative and is not a
  UX decision.
- **Later route and screen closure.** Architecture names many future
  capabilities but does not supply their information architecture. MVP 1–5
  surfaces remain deferred until approved UX planning closes them.

## Technical detail retained outside the UX spines

- Repository layout and the future `mobile/` directory rule.
- Symfony and frontend Clean Architecture layers, dependency directions,
  naming, ports, adapters, composition roots, directories, and framework
  boundaries.
- DTO, read-model, and view-model implementation; HTTP, IndexedDB, browser API,
  TanStack Query, React state, hydration, and server/browser composition.
- PostgreSQL/relational design, persistence shape, constraints, and domain
  evaluator mechanics.
- OIDC validation, bearer processing, object-storage credentials, signed-URL
  generation, infrastructure delivery adapters, and deployment technologies.
- Idempotency implementation, atomic publication mechanics, and API calculation
  of Due Work, notification eligibility, and report data.

These details remain fully available in `docs/architecture.md`; omission from
the UX spines is ownership separation, not information loss.

## Dropped qualitative detail

None. Every user-visible constraint has a destination above, every future
product application is retained with its PRD milestone, and all implementation
detail remains in the focused architecture source. No visual direction was
present to migrate.
