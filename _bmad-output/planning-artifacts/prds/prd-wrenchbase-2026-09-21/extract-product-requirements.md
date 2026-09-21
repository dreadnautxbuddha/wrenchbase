# Source Extraction: `docs/product-requirements.md`

## Extraction Scope

- Source: `docs/product-requirements.md`
- Source title: `Product Requirements`
- Authority stated by the source: normative source for Wrenchbase product behavior.
- Extraction rule: preserve exact source headings and any stable requirement IDs; do not assign new IDs during extraction.
- Stable requirement IDs found: **none**. The source contains domain terms and literal state/role values, but no PRD requirement identifiers such as `FR-*`, `NFR-*`, or equivalent.

## Exact Heading Inventory and Extracted Requirements

### `# Product Requirements`

The document defines Wrenchbase product behavior. The requirements below retain the source's heading structure; no source requirement IDs were available to retain.

### `## Status and Authority`

Source location: line 3.

- This document is normative for product behavior.
- `docs/product-vision.md` explains the problem and principles.
- `docs/architecture.md` defines technical boundaries.
- `docs/roadmap.md` orders delivery.
- Where those other documents are less specific, this document controls product decisions.

Canonical-PRD implication: this source remains authoritative until the reconciliation/finalization checkpoint changes that authority explicitly.

### `## Product Purpose`

Source location: line 11.

- Wrenchbase helps people and small organizations maintain assets they own or operate.
- The central workflow is to translate an owner manual or practical experience into a maintenance schedule, record actual work, and expose the next required work at the right time.
- Intended users include individuals, hobbyists, small garages, workshops, and small teams.
- Managed assets include vehicles, equipment, tools, appliances, and nested components.
- A garage workspace manages its own assets.
- Wrenchbase is not a customer-management, booking, billing, or full CMMS system.

### `## Product Vocabulary`

Source location: line 23.

- **workspace**: owns all product data and has one or more members.
- **site**: a physical place with an address and IANA timezone; it may contain a nested **location** tree.
- **asset type**: a reusable, versioned blueprint, either broad or model-specific.
- **asset**: a concrete thing managed by a workspace, created from an asset type revision and retaining its own identity and history.
- **component role**: a blueprint relationship describing where a compatible child asset can be installed; it is not an asset.
- **installation**: records a child asset occupying a parent component role over time.
- **meter**: records a typed unit of usage; a **reading** is a dated observation of the meter.
- **maintenance schedule**: a versioned set of maintenance requirements offered by an asset type. A concrete asset activates one base schedule and can have explicit additions, disables, and overrides.
- **requirement**: describes one maintenance action and its trigger rules.
- **job**: a planned or completed service event containing one or more **work items**.
- **maintenance need**: one-off work discovered during work.
- **maintainer**: an external person or organization that performed or hosted work. Workspace members may instead/also be job participants.
- Use **maintenance schedule** consistently; do not use “maintenance plan” as a synonym.

### `## Workspace, Members, and Settings`

Source location: line 52.

#### Tenancy and access

- Every record belongs to exactly one workspace.
- A user can belong to multiple workspaces and switch active workspace without signing in again.
- Active workspace must always be explicit in the client route and API request.
- Members must never see or modify another workspace's data by mistake.
- Authentication uses an OpenID Connect provider.

#### Onboarding and invitations

- On first sign-in, a user with no memberships may create a workspace or ask an existing workspace owner outside Wrenchbase to invite the provider-verified email address.
- The MVP does not create a personal workspace automatically.
- The MVP provides neither a workspace directory nor self-service join requests.
- Owners invite members by email.
- Invitations are single-use and expire.
- An invitation grants only the `member` role, and only after sign-in using the invited email address.
- Owners may revoke pending invitations.
- Ownership can transfer only to an existing member.
- The last owner cannot leave or be removed.

#### Roles and authorization

- MVP role `owner`: manages workspace settings, membership, and all maintenance data.
- MVP role `member`: manages all maintenance data, but not workspace membership.
- The API authorizes named capabilities rather than scattered literal role checks.
- The authorization shape must allow later roles such as read-only or asset-type editor without changing data ownership.

#### Settings and subscriptions

- Workspace settings include name, photo/logo, locale, default currency, unit preferences, due-soon defaults, meter-reading reminder defaults, sites, and members.
- The workspace owner starts subscribed to maintenance email and may unsubscribe.
- Security and account messages are mandatory.

### `## Sites, Locations, and Asset Placement`

Source location: line 85.

- A site owns its address and IANA timezone.
- Locations form an arbitrarily nested, acyclic tree inside one site.
- The first version supports location names, ordering, archiving, and human-readable paths.
- Capacity, maps, geofences, and floor plans are deferred.
- Every active asset has exactly one placement at any point in time: either directly in one workspace location or installed in exactly one parent through a component role.
- Installed children derive physical location and site from their host.
- Removing a child must atomically result in one of: direct placement, installation elsewhere, retirement, or disposal.
- Active assets cannot be locationless.
- Dated movement/installation history preserves past placement and timing.
- A physical organizer is a location if it only organizes placement; it is an asset if it has maintainable identity, component structure, or lifecycle.
- The same relationship must not model an object as both a location and an asset.

### `## Asset Types and Asset Lifecycles`

Source location: line 107.

#### Asset type revisions

An asset type revision defines:

- Typed attributes: short text, long text, number or measurement with unit, boolean, date, and single choice.
- Attribute requirements, defaults, and help text.
- One or more typed meters.
- Component roles with cardinality and compatible child asset types.
- Named base maintenance schedule alternatives, including patterns such as normal-use and severe-use.

#### Structure and creation

- Asset types do not inherit from other asset types.
- Asset types may reference other types only through component roles.
- Asset hierarchy depth is unrestricted, but cycles are forbidden.
- A required component role with one unambiguous child type creates a minimal child asset with the parent.
- Ambiguous required roles are resolved during setup.
- Owners may install ad-hoc typed components and later add the role to a future type revision.

#### Revisions and lifecycle

- Published asset type revisions are immutable.
- Existing assets receive an explicit reconciliation diff when fields, meters, or component roles change.
- Existing assets never silently gain or lose components.
- Used types are archived rather than deleted.
- Asset states are active, retired, disposed, or soft-deleted into restorable trash.
- Retirement/disposal pauses future due calculations and reminders without losing component, maintenance, or placement history.
- Domain records and attachment objects are never hard-deleted in the MVP.

#### Materials versus assets

- Simple consumables/materials are recorded on a work item.
- A part becomes a child asset when its identity, installation history, maintenance schedule, meter, reuse, upgrade, or resale history matters.

### `## Meters, Time, and Baselines`

Source location: line 140.

#### Meter behavior

- Asset types can define multiple meters.
- Readings can be recorded independently or during work completion.
- By default, a component inherits compatible host usage while installed.
- Owners may set a used component's starting usage, record corrections, or select a self-managed meter.
- Usage must never be double-counted.

#### Time model

- Store instants such as reading capture, synchronization, and email delivery in UTC.
- Store calendar-only facts as dates, not invented timestamps.
- Calendar recurrences use the asset site's IANA timezone.
- Completed jobs snapshot place and timezone.
- Members view instants in their own timezone while the original site-local context remains available.

#### Unknown history

- Never invent completions for an asset with unknown prior maintenance history.
- An owner may record evidence of known prior work, perform the work now, or acknowledge an unknown-history tracking baseline at the current date and effective usage.
- An unknown-history baseline schedules future work while reporting that earlier history is unknown.

### `## Maintenance Schedules and Due Work`

Source location: line 166.

#### Schedule composition and revisions

- A type can offer multiple named schedule alternatives.
- An asset activates one base schedule and may add requirements, disable inherited requirements, or override inherited rules.
- Components run their own schedules.
- A parent rolls up due work from currently installed descendants without duplicating their requirements.
- Schedules and published schedule revisions are immutable.
- Schedule revision adoption is an atomic diff.
- Unchanged requirements keep their stable internal identity and prior completions.
- New requirements request a baseline.
- Removed requirements stop producing future work.
- Explicit asset overrides survive revision adoption.
- Schedule-source metadata includes kind, title, edition/date, page/section, URL/notes, and optional manual attachments.

#### Requirement definition and triggers

- Requirements have a standard action category, such as inspect, clean, adjust, lubricate, replace, or service, plus custom title and instructions.
- Supported trigger families are one-time date/meter milestones, recurring elapsed intervals, recurring meter intervals, calendar recurrences, and manual/as-needed work with no automatic due calculation.
- Recurring meter/time rules may roll from completion or anchor to fixed lifetime/calendar milestones.
- Requirements may have an initial phase followed by recurrence.
- Trigger policy is configurable as first reached or all reached; first reached is the default.
- The trigger model is typed and extensible; the MVP does not use a generic expression language.

#### Due state and data quality

- Primary due state is one of `upcoming`, `due_soon`, `due`, or `overdue`.
- `due_soon` uses workspace defaults unless a requirement overrides them.
- Work becomes overdue immediately after its authoritative threshold; there is no invented safety grace period.
- `history_unknown` and `reading_needed` are separate data-quality flags rather than primary due states.
- Planning work adds a `planned` annotation but never clears due work.
- A stale meter requests a new reading and must not make meter-based work appear safe.
- Time-based rules continue calculating even when a meter is stale.
- Completing a meter-based requirement must capture an effective reading at work time.
- Completing work immediately projects the next occurrence from the applicable rule/baseline.

### `## Jobs, Work Items, and Maintenance Needs`

Source location: line 211.

#### Job lifecycle, assignment, and correction

- Jobs follow `draft → planned → active → closed`.
- Planned jobs can assign one or more workspace members; work items can override job assignment.
- Jobs have planned and actual ranges.
- Completed work items may record their own local date and optional time.
- Jobs can be cancelled before closure.
- Closed jobs are corrected only by traceable amendment or void-with-reason, never silent overwrite/deletion.

#### Work items and requirement fulfillment

- Jobs contain targeted work items.
- A work item may be ad hoc or explicitly fulfill one or more requirements on its target asset.
- Only completed work items reset fulfilled requirements and immediately project the next occurrence.
- Deferred/not-done work remains due.
- Closing a partially completed job prompts the member to carry unfinished items to a new planned job or create a maintenance need.
- Any member can add ad-hoc work to a `draft`, `planned`, or `active` job, including during on-site work.
- Ad-hoc work records a target asset and may record materials, evidence, cost allocation, and inspection outcome.
- Ad-hoc work is historical by default and affects a requirement only through explicit mapping.
- Closed jobs cannot be edited in place; later corrections/discoveries use an amendment or new job.

#### Place and participants

- A job defaults to recording its site/location but can use a maintainer address or custom place.
- Completion snapshots chosen place, address, and timezone.
- A job can include reusable external people/organizations, workspace members, and participant roles.
- A person can be affiliated with an organization.

#### Cost and evidence

- The job total is stored once.
- Optional work-item allocations support component reporting without double-counting unallocated cost.
- Job currency is snapshotted.
- Receipts/invoices attach to the job.
- Photos/other evidence attach to either a job or a work item.

#### Maintenance needs and replacements

- Inspections may record outcomes and create linked maintenance needs.
- A maintenance need is immediately due or has a one-off date/meter target.
- Needs are resolved by later work or voided with a reason.
- Needs do not automatically become recurring schedule requirements.
- Replacement work atomically ends the old installation and installs the new component.
- A new component begins its lifecycle at installation unless it is an existing used asset with history.
- The removed component must be moved, reinstalled, retired, or disposed.
- Parent reports retain the lifecycle of both old and new components for their respective installation periods.

### `## Notifications and Reports`

Source location: line 256.

- The notification center is authoritative for due work, meter-reading reminders, assignments, and sync problems.
- Members control their own email subscriptions.
- Email provides immediate state-transition alerts.
- A weekly unresolved-work digest is enabled by default, configurable, and disableable.
- Workspace-only reports cover asset identity, current configuration, component/location lifecycle, service timeline, schedule compliance, due work, costs, maintainers, and evidence.
- Public links, PDF/CSV export, and buyer reports are deferred.

### `## Offline Behavior`

Source location: line 269.

#### Offline scope

- The browser caches recently used and explicitly pinned asset trees for offline reading and job drafting.
- Large attachments download only on request.
- Offline jobs may include readings, attachments, work items, and component replacements.
- Offline asset creation is limited to cached existing asset types.
- Asset-type and schedule authoring are online-only.

#### Persistence and synchronization

- Drafts and attachments persist locally under client-generated IDs.
- While open, the app attempts synchronization on reconnect, open/foreground, and online saves.
- Members can manually invoke Sync now and Retry.
- The MVP does not promise closed-browser background synchronization.
- First successful upload creates a shared server draft.
- The draft author remains editor until explicit handoff.
- A job marked complete offline publishes only after all content uploads and the API atomically validates current state.
- Transient failures are retryable.
- Semantic conflicts become `needs_review` and preserve draft content and evidence.

#### Conflict resolution and idempotency

- Conflict resolution never guesses.
- Members may retarget stale-component work, correct conflicting meter readings, map work to a current requirement, or preserve work as ad-hoc history.
- Client idempotency must prevent duplicate jobs from repeated sync attempts.

### `## MVP Acceptance Scenarios`

Source location: line 293.

These scenarios are source acceptance evidence and should remain traceable in the canonical PRD:

1. An owner invites a partner, configures sites/locations, and both manage maintenance data while membership remains owner-only.
2. A user switches between home and workshop workspaces without cross-workspace leakage; a new user creates a workspace or accepts an owner-sent invitation.
3. An owner defines a `2024 Yamaha NMAX` type with a recursively typed CVT and creates a concrete asset with required components.
4. A second-hand asset at 35,000 km acknowledges an unknown brake-fluid baseline and calculates the next 10,000 km interval without claiming prior replacement.
5. Completing oil-change work at 25,000 km clears current due work and projects 30,000 km; deferred CVT cleaning remains due with a planned-job annotation.
6. A closed weekend job carries unfinished work forward without resetting requirements.
7. A member adds an unplanned repair during active service; it remains ad-hoc history unless explicitly linked to a requirement.
8. Replacing an engine preserves the old engine's work history, starts the new engine's lifecycle, and keeps the parent report coherent.
9. A schedule revision adding a three-month oil-change trigger retains existing completion history and recalculates the earliest next due point.
10. Offline work uploads after reconnect; a replacement conflict is reviewable without losing photos or receipts.

### `## Non-Goals`

Source location: line 318.

The MVP excludes:

- Customer management.
- Bookings.
- Billing.
- Procurement.
- Inventory management.
- Accounting integrations.
- Public schedule catalogs.
- Asset type inheritance.
- Arbitrary rule formulas.
- Sensor-driven maintenance prediction.
- Advanced facility modeling.
- Granular custom roles.
- Public report links.
- PDF/CSV export.
- Web push.
- Guaranteed closed-browser background synchronization.

## Cross-Cutting Decisions and Constraints

- **Multi-tenancy and security:** workspace isolation is absolute; active workspace context is explicit in route and API request.
- **API authority:** capability-based authorization supports the simple MVP roles while avoiding role literals as the long-term contract.
- **Historical integrity:** asset placement, component installation, schedule revisions, job corrections, costs, evidence, and completed work retain historical meaning; hard deletion and silent mutation are disallowed.
- **Versioning:** asset types and maintenance schedules have immutable published revisions, adopted through explicit reconciliation/diffs.
- **Relational hierarchy:** locations and asset/component trees are recursive and acyclic; placement is singular for active assets.
- **Typed domain behavior:** attributes, meters, trigger rules, and due states are typed; arbitrary formulas are explicitly outside MVP.
- **Time correctness:** instants use UTC, date-only facts stay dates, schedule calendars use site timezones, and completed jobs retain site-local context.
- **Due-work integrity:** planning does not clear due work; only completion can reset requirements; stale or unknown data cannot be presented as safe/certain.
- **Offline boundary:** offline reading and job drafting/completion are supported for cached scope, but authoring types/schedules and closed-browser background sync are not.
- **Atomic transitions:** reconciliation, publication of offline completion, and component replacement must validate/apply atomically.
- **Recoverability:** semantic sync conflicts preserve draft/evidence and require human review; domain records and attachments are not hard-deleted in MVP.
- **Audience/scope:** the product serves owner-operators and small teams, not customer-facing service-business workflows or a full CMMS.

## Stable Requirement ID Inventory

- No explicit PRD requirement IDs occur in this source.
- Literal identifiers that must not be mistaken for requirement IDs include roles (`owner`, `member`), job states (`draft`, `planned`, `active`, `closed`), due states (`upcoming`, `due_soon`, `due`, `overdue`), data-quality flags (`history_unknown`, `reading_needed`), and conflict state (`needs_review`).
- The phrase “stable internal identity” under `## Maintenance Schedules and Due Work` describes the identity of domain maintenance requirements across schedule revisions. It is not a stable source-document requirement ID.
- Reconciliation consequence: the canonical PRD cannot “preserve” source PRD IDs from this document because none exist. Any newly introduced canonical IDs require an explicit ID-assignment policy and a source-heading mapping; they must not be represented as pre-existing IDs.

## Conflicts Found Within This Source

No direct, irreconcilable product-behavior conflicts were found within `docs/product-requirements.md`.

The following are terminology/state-model tensions requiring clarification rather than proven conflicts:

1. `## Jobs, Work Items, and Maintenance Needs` defines the lifecycle as `draft → planned → active → closed` but separately permits cancellation before closure. The source does not say whether cancellation is a terminal job state, an annotation, or a transition into another named state.
2. `## Offline Behavior` refers to a job “marked complete offline,” while the lifecycle section uses `closed` and work items use `completed`. The canonical PRD should define whether “complete” means a request to close, a local pending-publication state, or another status.
3. `## Workspace, Members, and Settings` says the workspace owner starts subscribed to maintenance email, while `## Notifications and Reports` says the weekly digest is enabled by default. It is unclear whether non-owner members are subscribed by default to any email category.

## Missing Decisions and Clarifications

Only gaps that affect a canonical product contract are listed; implementation mechanisms are intentionally excluded.

### Reconciliation blocker

- **Canonical requirement ID policy:** no stable PRD IDs exist in this authoritative source. Before finalization, decide the canonical ID scheme and record an exact source-heading-to-new-ID map. Do not imply that newly assigned IDs came from the source.

### Product-contract gaps

- **Cancellation semantics:** define the job state/result and allowed transitions for cancellation, including whether a cancelled job may contain completed work and how that work affects requirements.
- **Offline completion terminology:** align local “marked complete,” server publication, job `closed`, and work-item `completed` so acceptance tests have unambiguous states.
- **Default email subscriptions:** define defaults for newly invited non-owner members and clarify whether immediate alerts and the weekly digest share or have separate subscription controls.
- **Invitation expiry:** expiration is required, but no duration or configurability owner is stated. This may be safely deferred if treated as a policy/default outside the PRD; otherwise the product contract needs an explicit rule.
- **Trash behavior:** soft-delete/restorable trash is required, but restoration eligibility, retention duration, and treatment of an asset's installed descendants are not stated.
- **Schedule-reconciliation baseline:** new requirements “request a baseline,” but the required user choices/default when adopting a revision are not enumerated here beyond the separate unknown-history options.
- **Archived location behavior:** location archiving is supported, but the source does not say whether a location containing active assets can be archived or what relocation behavior is required.
- **Maintenance-need state vocabulary:** needs are due, resolved, or voided, but stable named states and any “planned” annotation behavior are not defined.

## Heading-by-Heading Coverage Checklist

- [x] `# Product Requirements` — source title and document-level role captured.
- [x] `## Status and Authority` — authority and relationship to vision, architecture, and roadmap captured.
- [x] `## Product Purpose` — purpose, audience, central workflow, and scope boundary captured.
- [x] `## Product Vocabulary` — every defined term and the prohibited synonym captured.
- [x] `## Workspace, Members, and Settings` — tenancy, authentication, onboarding, invitations, roles, authorization, settings, and subscription behavior captured.
- [x] `## Sites, Locations, and Asset Placement` — site/location model, placement invariant, movement history, and location/asset distinction captured.
- [x] `## Asset Types and Asset Lifecycles` — revision contents, hierarchy rules, reconciliation, lifecycle, deletion, and material/asset boundary captured.
- [x] `## Meters, Time, and Baselines` — meter inheritance/correction, time semantics, and unknown-history options captured.
- [x] `## Maintenance Schedules and Due Work` — alternatives, overrides, revisions, sources, triggers, due states, flags, stale readings, and next-occurrence behavior captured.
- [x] `## Jobs, Work Items, and Maintenance Needs` — lifecycle, assignments, fulfillment, ad-hoc work, corrections, place, participants, costs, evidence, needs, and replacement captured.
- [x] `## Notifications and Reports` — notification authority, email behavior, workspace reports, and deferred outputs captured.
- [x] `## Offline Behavior` — cache scope, offline operations, synchronization, publication, conflict handling, and idempotency captured.
- [x] `## MVP Acceptance Scenarios` — all ten scenarios captured individually.
- [x] `## Non-Goals` — all sixteen exclusions captured individually.

## Extraction Completeness Notes

- Exact source headings: 14 of 14 captured, including the document title.
- Stable source requirement IDs: 0 found; 0 altered or renumbered.
- Acceptance scenarios: 10 of 10 captured.
- Explicit non-goals: 16 of 16 captured.
- This extraction does not reconcile claims against the vision, roadmap, architecture, or implementation plans; that comparison belongs to the parent PRD reconciliation run.
