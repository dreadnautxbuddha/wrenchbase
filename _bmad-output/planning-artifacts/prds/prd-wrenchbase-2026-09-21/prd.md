---
title: Wrenchbase Canonical Product Requirements Document
status: final
approval: approved
approved: 2026-09-22
created: 2026-09-21
updated: 2026-09-22
---

# PRD: Wrenchbase

## 0. Document Purpose and Authority

This document is the canonical product requirements document for Wrenchbase. It
is written for product decision-makers and for downstream UX, architecture, and
delivery planning. It consolidates the existing vision, product requirements,
roadmap, and MVP 0–1 implementation plans without changing their authority
during the reconciliation checkpoint.

The source documents remain authoritative until this PRD is approved.
[ASSUMPTION A-2: After explicit approval, this PRD governs product behavior.]
`addendum.md` preserves relevant contract and implementation decisions that do
not belong in a product requirements narrative. Exact source-heading coverage
is recorded in `source-reconciliation.md`.

### 0.1 Approval Scope

Approval makes the vision, coherent MVP boundary, vocabulary, and settled
requirements in this PRD canonical. Focused technical documents may refine
implementation but cannot override product behavior stated here.

- MVP 0–2 are decision-ready for downstream planning.
- MVP 3 planning must resolve OQ-1 and OQ-4 before Job and Maintenance Need
  stories are treated as implementation-ready.
- MVP 4 planning must resolve OQ-2 before notification-subscription stories are
  treated as implementation-ready.
- MVP 5 is decision-ready subject to the earlier domain contracts it consumes.
- MVP 6 and a public production launch must resolve OQ-6 before FR-38 is treated
  as implementation-ready.
- OQ-3, OQ-5, and OQ-7 remain governance or launch gates at the points named in
  §10.

## 1. Vision

Wrenchbase is an open-source, mobile-first maintenance tracker for physical
assets that require recurring care. It helps an owner or small trusted team
turn guidance from a manual or practical experience into a Maintenance
Schedule, record the work performed, and see what needs attention next.

The product occupies the space between narrow vehicle-only trackers and large
enterprise maintenance systems. It must model vehicles, equipment, tools,
appliances, upgrades, and recursively nested components with enough precision
to preserve their history, while remaining approachable for a person tracking
a scooter, chair, tool, or small workshop.

The product thesis is that trustworthy maintenance decisions require three
things together: a faithful model of the asset and its guidance, an append-
friendly record of actual work and lifecycle changes, and an honest view of
what is due—including uncertainty when history or readings are incomplete.

### 1.1 Product Principles

- **Mobile-first.** Core work must be practical in garages, at the roadside,
  in workshops, and at job sites.
- **Manual-led.** Maintenance schedules must faithfully represent manufacturer
  guidance or an owner's deliberate maintenance choices.
- **Flexible, not vague.** Configurable Asset Types and recursive Components
  remain typed, relational, and understandable.
- **History-preserving.** Later edits to definitions, schedules, locations, and
  assets must not reinterpret completed maintenance history.
- **Useful before complex.** The complete owner and small-team maintenance loop
  takes priority over enterprise breadth.
- **Honest about uncertainty.** Unknown history and stale Meter Readings are
  explicit and never presented as safe or current.
- **Offline where it matters.** Field work and evidence can be drafted without
  connectivity and synchronized safely after reconnection.

## 2. Target Users and Jobs To Be Done

### 2.1 Target Users

- Individuals maintaining their own vehicles, equipment, tools, appliances, or
  household assets.
- DIY mechanics and hobbyists maintaining simple or deeply nested equipment.
- Small garages, workshops, and businesses maintaining assets they own or
  operate.
- Small, trusted teams sharing a Workspace and its maintenance records.

For the first version, a garage may be named as a Maintainer but does not use
Wrenchbase to manage customer accounts, customer-owned fleets, bookings, or
billing. The Workspace owns the records for the Assets it owns or operates.

### 2.2 Jobs To Be Done

- When I acquire an Asset, help me model what it is, where it is, how it is
  assembled, and what guidance applies so I can maintain it correctly.
- When I inherit incomplete history, help me establish an honest baseline
  without fabricating past work.
- When work is planned or performed, help me capture the work, people, place,
  cost, evidence, readings, and component changes without losing context.
- When time or usage advances, tell me what is upcoming, due, overdue, or
  uncertain so I can act before maintenance is missed.
- When definitions or schedules change, help me adopt them explicitly without
  silently rewriting existing Assets or completed Jobs.
- When connectivity is unreliable, let me continue field work and recover from
  synchronization conflicts without losing the draft or its evidence.

### 2.3 Key User Journeys

- **UJ-1. Maya establishes a private maintenance Workspace.** Maya signs in
  with a verified external identity, creates a Workspace, and lands on an
  explicit Workspace route. She edits its locale and currency, creates a
  second Workspace, and switches between them without signing in again. The
  interface shows which Workspace is active, and data from the other Workspace
  never appears. If an edit is stale, Maya keeps her entered values while she
  reloads the current state.

- **UJ-2. Luis models a scooter and its CVT assembly.** Luis, an owner in a
  small workshop, creates a Site and nested Location, publishes versioned Asset
  Types for a scooter and its components, and defines typed attributes, Meters,
  and Component Roles. He creates a concrete scooter from a published revision;
  required unambiguous Components are created and installed atomically. He can
  inspect the resulting Asset tree, current revision, and inherited Location.

- **UJ-3. Priya starts trustworthy tracking for a used Asset.** Priya records a
  second-hand Asset at 35,000 km with unknown brake-fluid history. She chooses
  an unknown-history Baseline at the current date and effective usage. The
  system calculates the next 10,000 km interval while continuing to report that
  earlier history is unknown; it never invents a replacement event.

- **UJ-4. Luis completes service without erasing unfinished work.** Luis opens
  a planned Job, records an oil change at 25,000 km, adds an unexpected repair,
  and defers a CVT cleaning. The completed oil-change Work Item clears its Due
  Work and projects the next occurrence; the ad hoc repair remains history
  unless explicitly mapped; the deferred cleaning remains due and can be
  carried into a new planned Job or Maintenance Need.

- **UJ-5. Maya replaces a Component and retains both histories.** During a Job,
  Maya replaces an engine. One atomic action closes the old Installation,
  installs the new Component, and requires the removed engine to be moved,
  reinstalled, retired, or disposed. The parent report continues to show each
  engine's work and costs for the period in which it was installed.

- **UJ-6. Ava finishes field work after losing connectivity.** Ava opens a
  recently used or pinned Asset tree, drafts a Job with Work Items, Meter
  Readings, attachments, and a replacement proposal while offline, and marks
  it ready for completion. On reconnect, all content uploads before the API
  validates and publishes the completed Job atomically. A stale replacement
  becomes `needs_review`; Ava can resolve it without losing photos or receipts.

- **UJ-7. Priya reviews what needs attention.** Priya opens the notification
  center and due-work dashboard, sees primary due state together with any
  `history_unknown`, `reading_needed`, or `planned` context, and receives only
  the email categories she has enabled. She can review Workspace-only history,
  cost, evidence, and compliance reports without exposing them publicly.

## 3. Glossary

- **Workspace** — The tenant that owns all Wrenchbase data and has one or more
  Members. Every Workspace-scoped route and API request identifies it
  explicitly.
- **Member** — A user with an active tenure in a Workspace. MVP roles are
  `owner` and `member`; clients authorize through named Capabilities.
- **Capability** — A stable permission identifier returned by the API and used
  by clients to decide which controls to expose.
- **Site** — A physical place with an address and IANA time zone that contains a
  Location tree.
- **Location** — A node in an ordered, acyclic tree within one Site. It
  organizes physical placement but has no independently maintainable identity.
- **Asset Type** — A reusable, versioned blueprint for Assets. A published
  Asset Type Revision is immutable.
- **Asset Type Revision** — A draft or published snapshot of an Asset Type's
  attributes, Meters, Component Roles, and Maintenance Schedule alternatives.
- **Asset** — A concrete thing managed by a Workspace, created from a published
  Asset Type Revision and retaining its own identity and history.
- **Component** — An Asset installed in another Asset. Ordinary consumables
  without independently useful identity remain Work Item materials.
- **Component Role** — A blueprint relationship specifying where compatible
  child Assets may be installed; it is not itself an Asset.
- **Installation** — A dated history record of a Component occupying a parent
  Asset's Component Role or an explicitly labeled ad hoc position.
- **Meter** — A typed measure of Asset usage. A **Meter Reading** is a dated
  observation, and compatible Components may inherit host usage while installed.
- **Maintenance Schedule** — A versioned set of maintenance Requirements
  offered by an Asset Type. Do not use “maintenance plan” as a synonym.
- **Requirement** — One maintenance action and its typed Trigger rules, with a
  stable internal identity across compatible Maintenance Schedule revisions.
- **Trigger** — A one-time, elapsed, Meter, calendar, or manual condition that
  contributes to a Requirement's Due Work calculation.
- **Baseline** — The date and/or effective usage from which future occurrences
  are projected when prior history is known, performed now, or acknowledged as
  unknown.
- **Due Work** — The calculated state of an active Requirement for an Asset,
  including primary urgency plus data-quality and planning annotations.
- **Job** — A planned or completed service event containing one or more Work
  Items.
- **Work Item** — Targeted work within a Job. It may be ad hoc or explicitly
  fulfill one or more Requirements on its target Asset.
- **Maintenance Need** — One-off work discovered during inspection or service;
  it does not become recurring unless explicitly converted into a Requirement.
- **Maintainer** — An external person or organization that performed or hosted
  work. Members may separately participate in a Job.
- **Evidence** — Receipts, invoices, photos, documents, or other files attached
  to a Job or Work Item.
- **Reconciliation** — An explicit preview-and-apply process for adopting a new
  Asset Type Revision or Maintenance Schedule revision without silent changes.

## 4. Functional Requirements

No source document contained formal requirement IDs. The `FR-*`, `NFR-*`,
`UJ-*`, and `SM-*` identifiers in this document are newly assigned canonical identifiers.
They are stable from this document onward and must not be renumbered when
requirements are reorganized or retired.

### 4.1 Identity, Workspaces, and Membership

#### FR-1: External identity and sign-in

Users can sign in through a standards-compliant OpenID Connect provider using a
provider-verified email address and can sign out through that provider. Realizes
UJ-1.

**Consequences (testable):**

- The external identity is provider-neutral and remains linked by issuer and
  subject even when synchronized profile fields change.
- Verified email, display name, and optional avatar can be synchronized.
- Wrenchbase does not persist access or refresh tokens in its database.
- A first-time user without Memberships can create a Workspace or authenticate
  through an owner-sent invitation; there is no automatic personal Workspace,
  public Workspace directory, or self-service join request.

#### FR-2: Workspace creation, editing, and switching

An authenticated user can create, edit, and switch among Workspaces without
signing in again. Realizes UJ-1.

**Consequences (testable):**

- The creator becomes the first `owner`, and an authenticated user may create
  more than one Workspace.
- Workspace name is 1–100 trimmed grapheme clusters; locale is canonical BCP
  47; default currency is uppercase ISO 4217.
- The active Workspace is explicit in both client route and API request.
- The browser may persist only the last selected Workspace identifier across
  sessions; it does not place meaningful server data, drafts, or tokens in
  `localStorage`.

#### FR-3: Membership invitations and tenure

An owner can invite, revoke, resend, list, remove, and transfer ownership while
preserving Membership history. Realizes UJ-1.

**Consequences (testable):**

- Invitations are single-use, expire after seven days, and grant only the
  `member` role after sign-in with the matching verified email.
- An invitation can include an optional personal message. The submitted email
  address is retained for display and delivery, while matching uses its
  normalized value.
- Email matching trims surrounding whitespace, applies Unicode case folding,
  and IDNA-normalizes the domain without provider-specific alias rewriting.
- Only one unexpired pending invitation exists per normalized email and
  Workspace; resend rotates its secret and expiry; revocation invalidates prior
  links.
- Acceptance is idempotent and atomically creates one active Membership,
  consumes the invitation, advances revisions, and records audit history.
- Invitation secrets are never stored in plaintext, and unauthorized viewers
  cannot discover the Workspace or invitee details; only the addressed signed-
  in user can inspect the safe summary needed for acceptance.
- Ownership transfers only to an active Member; the last owner cannot leave,
  be removed, or be demoted without a successful transfer.
- Rejoining creates a new tenure rather than rewriting prior tenure.

#### FR-4: Capability authorization and tenant isolation

The API authorizes every Workspace operation through named Capabilities and
isolates all Workspace data. Realizes UJ-1 and UJ-2.

**Consequences (testable):**

- `owner` and `member` receive the read/manage Capabilities for maintenance
  data; only owners receive Workspace settings and Membership-management
  Capabilities.
- Clients use returned Capabilities rather than inferring permissions from role
  names.
- Every tenant-owned record belongs to exactly one Workspace, and
  cross-Workspace parentage, compatibility, placement, and Installation are
  impossible.
- A valid identifier belonging to another Workspace is concealed as not found
  rather than revealing its existence.
- The authorization shape can add later roles without changing data ownership.

#### FR-5: Workspace settings and preferences

Owners can configure Workspace identity and shared maintenance defaults without
rewriting historical facts.

**Consequences (testable):**

- Settings include name, locale, default currency, unit preferences, due-soon
  defaults, Meter-reading reminder defaults, Sites, Members, and—in MVP 3 when
  private storage exists—a photo or logo.
- Canonical measurements are stored independently of display preferences;
  changing a preference affects input defaults and display conversion only.
- Security and account messages cannot be unsubscribed from.

### 4.2 Sites, Locations, and Placement

#### FR-6: Site management

Members with the appropriate Capability can create, edit, archive, and restore
Sites.

**Consequences (testable):**

- A Site has a name, an IANA time zone, a structured postal address, a lifecycle
  status, an immutable creation time, and a revision.
- Structured addresses do not invent unknown fields and use an ISO 3166-1
  country code.
- Creating a Site does not create a default Location; direct Asset placement
  requires the Member to choose or create one explicitly.
- A Site can be archived only after all its Locations are archived and no active
  Asset is directly placed there.

#### FR-7: Nested Location management

Members can manage an ordered, arbitrarily deep Location tree inside one Site.

**Consequences (testable):**

- Location relationships are acyclic and cannot cross Site or Workspace
  boundaries.
- Display paths derive from current ancestors and are not identifiers.
- Reparenting, reordering, archival, and restoration are concurrency checked.
- Archiving a selected subtree is atomic and blocked if an active Asset is
  directly placed anywhere within it.
- Restoring a Location requires an active Site and an active parent when one is
  specified.

#### FR-8: Singular active placement and history

Every active Asset has exactly one current physical placement: directly in one
active Location or installed in one parent Asset. Realizes UJ-2 and UJ-5.

**Consequences (testable):**

- An active Asset is never both directly placed and installed, and is never
  locationless.
- An installed descendant derives Site and Location from the directly placed
  root of its assembly.
- Moving, installing, or detaching closes the current dated history record and
  opens the next atomically, with no overlap or invalid chronology.
- Historical paths, addresses, and time zones remain intelligible after current
  Sites or Locations change.

### 4.3 Asset Types, Assets, and Components

#### FR-9: Versioned Asset Types

Members can author, publish, revise, archive, and restore reusable Asset Types.
Realizes UJ-2.

**Consequences (testable):**

- A new Asset Type starts with one mutable draft; publishing freezes that
  revision permanently.
- Starting a revision clones the latest published revision; an Asset Type has
  at most one draft and one current published revision.
- Assets are created only from an explicitly selected published revision.
- A never-published, unreferenced draft may be deleted; a published or referenced
  type is archived rather than deleted and remains readable through history.
- An archived Asset Type must be restored before it can be revised or
  published. It cannot be archived while a current published parent revision
  depends on it for automatic required-Component creation.
- Stable definition identities survive ordinary renames and revisions; new
  concepts receive new identities and are never matched by display title.

#### FR-10: Typed attributes and configured values

Asset Type Revisions can define typed attributes, and Assets retain the values
accepted by their selected revision. Realizes UJ-2.

**Consequences (testable):**

- Supported types are short text, long text, exact decimal, measurement,
  boolean, calendar date, and single choice with stable ordered options.
- Each definition can include a required flag, default, help text, and sibling
  position subject to the selected type's validity rules.
- Publication rejects duplicate stable keys, invalid defaults, empty choice
  sets, and incompatible reuse of an existing identity.
- Exact decimals do not use binary floating-point semantics; measurements are
  normalized to canonical units; choices reference option identities.
- Defaults are materialized on Asset creation; required fields without defaults
  must be supplied; absent optional values remain absent.
- Values retain definition identity and accepting revision, including after a
  later revision removes them from the active configuration.

#### FR-11: Meter definitions and Meter Readings

Asset Types can define multiple typed Meters, and Members can record and correct
their dated readings. Realizes UJ-3, UJ-4, and UJ-6.

**Consequences (testable):**

- A Meter definition has stable identity, key, label, measurement dimension,
  canonical unit, decimal precision, and position.
- Every published Asset Type Revision defines one or more typed Meters.
- A later revision may change label or presentation unit without changing the
  Meter's accumulated meaning or dimension.
- Meter Readings can be recorded independently or during completed work. They
  retain correction history and never double-count usage.
- A Component inherits compatible host usage while installed unless it uses a
  self-managed Meter; a used Component may establish starting usage.

#### FR-12: Component Roles and recursive Asset creation

Asset Type Revisions can define Component Roles that create or constrain nested
Assets. Realizes UJ-2.

**Consequences (testable):**

- A Component Role has stable identity, key, label, minimum and optional maximum
  cardinality, position, and one or more compatible Asset Types.
- Publication rejects invalid cardinality, missing compatible published types
  for required roles, and unambiguous required-role chains that recurse forever.
- A positive-minimum role with one compatible type snapshots its current
  published revision and creates the minimum children atomically with the parent.
- Automatically created Component names use the Component Role label and an
  ordinal where necessary and remain editable.
- Ambiguous required roles require an explicit compatible published revision at
  Asset creation.
- Optional blueprint compatibility cycles may exist, but concrete Installation
  cycles are always forbidden.
- Members may install an ad hoc typed Component and later map it explicitly to a
  new Component Role; label matching never performs that mapping automatically.

#### FR-13: Concrete Asset creation

Members can create an Asset with stable identity, editable name, chosen Asset
Type Revision, configured values, instantiated Meters, and an initial
placement. Realizes UJ-2.

**Consequences (testable):**

- Creation requires either an active direct Location or an Installation in an
  active compatible parent.
- Required values, required-child creation, and initial placement or
  Installation succeed or fail atomically.
- The Asset records creation time, lifecycle state, revision, and the accepted
  Asset Type Revision.

#### FR-14: Movement, Installation, and detachment

Members can move Assets, install Components, and detach Components with dated,
validated history.

**Consequences (testable):**

- Installation requires active same-Workspace parent and child, an available
  compatible Component Role or explicit ad hoc label, and an acyclic result.
- Effective instants default to current API time and cannot overlap or predate
  later transitions.
- Moving an assembly moves its directly placed root; descendants retain their
  Installations and derive the new Location.
- Installing or replacing a Component as an upgrade preserves both the prior
  configuration and the upgraded configuration in dated Installation history.
- Manual install and detach actions are lifecycle history, not completed
  maintenance and do not reset Requirements.

#### FR-15: Asset lifecycle and retained subtrees

Members can retire, dispose, trash, restore, and reactivate Assets without
deleting their history. Realizes UJ-5.

**Consequences (testable):**

- Lifecycle states are `active`, `retired`, `disposed`, and `trashed`; trash
  records the prior state for deterministic restoration.
- Every transition records reason, effective instant, actor, and audit event.
- Making a root inactive closes its incoming placement while retaining its
  descendant Installations; the subtree becomes operationally paused.
- Selected non-overlapping Component subtrees may be atomically detached and
  rehomed, retired, or disposed before a host transition; invalid choices abort
  the whole action.
- An active Asset already inside a paused subtree must be detached into a valid
  active placement or transitioned to `retired` or `disposed` before it can
  resume independently.
- Restoring or reactivating to `active` requires a valid active placement;
  disposed Assets are not restored, and corrections use audited amendments.
- Domain records and Evidence objects are not hard-deleted in the MVP.

#### FR-16: Asset Type adoption and Reconciliation

Members can preview and explicitly apply a newer Asset Type Revision to an
existing Asset. Realizes UJ-2.

**Consequences (testable):**

- Preview uses stable identities to classify unchanged, renamed, added,
  removed, compatible, and incompatible definitions and affected Installations.
- New required values, ambiguous Components, and incompatible changes require
  explicit resolution.
- Reconciliation may create unambiguous required Components or map ad hoc
  Installations, but never silently removes, retires, disposes, or deletes an
  Asset.
- Application is atomic, records the previous and adopted revisions and accepted
  diff, and rejects a stale preview.

### 4.4 Maintenance Schedules, Baselines, and Due Work

#### FR-17: Versioned Maintenance Schedules

Asset Types can offer named, sourced Maintenance Schedule alternatives whose
published revisions are immutable.

**Consequences (testable):**

- An Asset activates one base Maintenance Schedule and may explicitly add,
  disable, or override Requirements.
- Components run their own Maintenance Schedules; a parent rolls up currently
  installed descendant Due Work without duplication.
- Source metadata can record kind, title, edition or date, page or section, URL
  or notes, and an optional manual attachment.
- Adopting a revision is an atomic Reconciliation; unchanged Requirements retain
  stable identity and completion history, removed Requirements stop producing
  future work, and explicit Asset overrides survive.

#### FR-18: Typed Requirements and Triggers

Members can define maintenance Requirements using a typed, extensible Trigger
model.

**Consequences (testable):**

- Requirements have a standard action category, custom title, instructions,
  and one or more typed Triggers.
- Supported Trigger families are one-time date or Meter milestones, recurring
  elapsed intervals, recurring Meter intervals, calendar recurrences, and
  manual/as-needed work.
- Initial stable action categories are `inspect`, `clean`, `adjust`,
  `lubricate`, `replace`, and `service`; each Requirement also has a custom
  title. Adding a category is a versioned contract change and never silently
  reclassifies historical Requirements.
- Recurrence may roll from completion or anchor to fixed lifetime/calendar
  milestones and may include an initial phase.
- Multi-trigger policy is `first_reached` by default or `all_reached` when
  explicitly selected.
- The MVP does not execute arbitrary formulas or a generic expression language.

#### FR-19: Honest Baselines and unknown history

Members can establish a Baseline for known, newly performed, or unknown prior
maintenance without fabricating history. Realizes UJ-3.

**Consequences (testable):**

- A Member may record Evidence of known prior work, perform the work now, or
  acknowledge an unknown-history Baseline at current date and effective usage.
- An unknown-history Baseline schedules future work while retaining the
  `history_unknown` data-quality flag.
- A newly introduced Requirement requests a Baseline rather than inventing a
  completion.

#### FR-20: Due Work calculation and presentation

The API calculates Due Work from effective Meter Readings, Baselines, completed
Work Items, active placement, and Maintenance Schedule rules. Realizes UJ-3,
UJ-4, and UJ-7.

**Consequences (testable):**

- Primary due state is `upcoming`, `due_soon`, `due`, or `overdue`.
- The user-facing status also exposes separate `history_unknown` and
  `reading_needed` flags and a `planned` annotation; none is silently collapsed
  into a safer primary state.
- `due_soon` uses Workspace defaults unless the Requirement overrides them;
  work is overdue immediately after the authoritative threshold.
- A stale Meter requests a fresh Meter Reading and never makes Meter-based work
  appear safe; time-based Triggers continue calculating.
- Planning work never clears Due Work. Only a completed Work Item explicitly
  fulfilling a Requirement resets it and projects the next occurrence.
- Completing Meter-based work captures an effective Meter Reading at work time.
- Retirement, disposal, or an inactive retained host pauses future Due Work and
  reminders without losing history.

### 4.5 Jobs, Work Items, and Maintenance Needs

#### FR-21: Job lifecycle and assignment

Members can create and operate Jobs through `draft`, `planned`, `active`, and
`closed` states with planned and actual ranges. Realizes UJ-4 and UJ-6.

**Consequences (testable):**

- Planned Jobs can assign one or more Members, and Work Items can override Job
  assignment.
- Completed Work Items may record their own local date and optional time.
- Jobs can be cancelled before closure, subject to the unresolved cancellation
  semantics in OQ-1.
- Job status and Work Item completion remain separate so a closed Job can retain
  completed, deferred, and not-done Work Items.

#### FR-22: Requirement fulfillment and partial completion

A Work Item can explicitly fulfill one or more Requirements on its target Asset.
Realizes UJ-4.

**Consequences (testable):**

- Only completed Work Items reset mapped Requirements and immediately project
  their next occurrences.
- Deferred or not-done Work Items remain due.
- Closing a partially completed Job prompts the Member to carry unfinished
  Work Items into a new planned Job or create a Maintenance Need.
- A planned Job adds only a `planned` annotation to the corresponding Due Work.

#### FR-23: Ad hoc work

Members can add ad hoc Work Items to `draft`, `planned`, or `active` Jobs,
including during on-site work. Realizes UJ-4.

**Consequences (testable):**

- Ad hoc work records a target Asset and may record materials, Evidence, cost
  allocation, and inspection outcome.
- It is historical by default and affects a Requirement only through explicit
  mapping.
- Closed Jobs are not edited in place to add later discoveries.

#### FR-24: Traceable Job correction

Closed Jobs can be corrected only through an auditable amendment or a void with
reason.

**Consequences (testable):**

- Original closed history remains available after correction.
- Silent overwrite and deletion of closed work are impossible.
- The effects of an amendment or void on Requirement completion and reports are
  traceable.

#### FR-25: Job place, time zone, and participants

Jobs retain who participated and where and when the work occurred.

**Consequences (testable):**

- A Job defaults to its Site or Location but can use a Maintainer address or
  custom place.
- Completion snapshots place, address, and IANA time zone so later edits or
  moves never reinterpret history.
- A Job can include reusable external people or organizations, Members, and
  participant roles; a person may be affiliated with an organization.
- Instants are stored in UTC, calendar-only facts remain dates, and Members may
  view instants in their own time zone while original site-local context remains.

#### FR-26: Costs and Evidence

Members can record Job costs and attach Evidence without double counting.

**Consequences (testable):**

- The Job total is stored once with snapshotted currency.
- Optional Work Item allocations support Component reporting; unallocated cost
  is not counted again.
- Receipts and invoices attach at Job scope; photos and other Evidence attach to
  a Job or Work Item.
- Evidence access is Workspace-authorized and survives Job correction and Asset
  lifecycle changes.

#### FR-27: Maintenance Needs

Inspections can create linked one-off Maintenance Needs that remain distinct
from recurring Requirements.

**Consequences (testable):**

- A Maintenance Need is immediately due or has a one-off date or Meter target.
- Later work resolves it; it may be voided only with a reason.
- It does not become a recurring Requirement without an explicit authoring
  action.

#### FR-28: Atomic Component replacement

A replacement Work Item can atomically end one Installation and start another.
Realizes UJ-5.

**Consequences (testable):**

- All validation succeeds before either Installation changes.
- A new Component begins its lifecycle at Installation unless it is an existing
  used Asset with history.
- The removed Component is moved, reinstalled, retired, or disposed in the same
  operation.
- Parent history and reports attribute each Component's work and costs to its
  actual Installation period.

### 4.6 Awareness, Reports, and Offline Resilience

#### FR-29: Notification center and due-work dashboard

Members can review authoritative Due Work, Meter-reading reminders,
assignments, and synchronization problems in mobile-first browser views.
Realizes UJ-7.

**Consequences (testable):**

- Notification and dashboard states preserve primary urgency, data-quality
  flags, and planning annotations.
- A Member can navigate from an item to its Workspace, Asset, Requirement, Job,
  or synchronization resolution context as applicable.

#### FR-30: Email preferences and delivery

Members can control optional maintenance email while mandatory security and
account messages remain enabled. Realizes UJ-7.

**Consequences (testable):**

- Immediate alerts are produced for relevant due-state transitions.
- A weekly digest of unresolved work is enabled by default; Members can
  configure or disable it.
- The first Workspace owner is subscribed to maintenance email by default and
  can unsubscribe.
- Invitation delivery is transactional and retryable; invitation creation
  commits independently of mail-provider availability.
- Default maintenance-email behavior for newly invited non-owner Members remains
  the explicit gap in OQ-2.

#### FR-31: Workspace-only reports

Members can view Workspace-authorized reports for Assets and maintenance
history. Realizes UJ-5 and UJ-7.

**Consequences (testable):**

- Reports cover Asset identity and current configuration, Component and
  Location lifecycle, service timeline, Maintenance Schedule compliance, Due
  Work, costs, Maintainers, and Evidence.
- Reports retain old and new Component history for their respective
  Installation periods.
- Public links, buyer-facing reports, PDF, and CSV export are not part of the
  MVP.

#### FR-32: Offline reading and Job drafting

The browser supports offline reading and Job drafting for recently used and
explicitly pinned Asset trees. Realizes UJ-6.

**Consequences (testable):**

- Offline Jobs may contain Meter Readings, attachments, Work Items, and
  Component replacement proposals.
- Offline Asset creation is limited to cached existing Asset Types.
- Asset Type and Maintenance Schedule authoring remain online-only.
- The app downloads large attachments only on request.
- Drafts and attachments persist locally under client-generated stable IDs.

#### FR-33: Synchronization, publication, and conflict review

Offline work synchronizes safely while the browser is open and preserves user
work through failures. Realizes UJ-6.

**Consequences (testable):**

- The app attempts synchronization when connectivity returns, when it opens or
  enters the foreground, and after online saves. It also provides manual
  **Sync now** and **Retry** controls.
- First successful upload creates a shared server draft; its author remains the
  editor until explicit handoff.
- Marking a Job complete offline is a local request to close and publish, not a
  new server lifecycle status. The server reaches `closed` only after all
  content uploads and the API validates current state atomically.
- Transient failures remain retryable; semantic conflicts become
  `needs_review` and retain all draft content and Evidence.
- Resolution never guesses: a Member may retarget stale-Component work, correct
  conflicting Meter Readings, map work to a current Requirement, or preserve it
  as ad hoc history.
- Repeated synchronization cannot create duplicate Jobs.
- The MVP does not promise synchronization while the browser is closed.

### 4.7 Shared Contracts and Operability

#### FR-34: Optimistic concurrency and input preservation

State-dependent changes reject missing or stale revision preconditions without
discarding the Member's work. Realizes UJ-1 and UJ-2.

**Consequences (testable):**

- Current representations expose opaque revision metadata.
- A stale browser form retains entered values and offers a way to reload current
  server state before deliberate resubmission.
- Domain conflicts, validation failures, missing preconditions, and stale
  revisions remain distinguishable.

#### FR-35: Retry-safe commands

Creates and multi-record commands are idempotent across client retries.

**Consequences (testable):**

- Repeating the same operation with the same idempotency key and payload replays
  the successful result.
- Reusing a key for a different operation or payload is rejected.
- Compound invitation, ownership, tree, publication, placement, Installation,
  lifecycle, replacement, and Reconciliation commands succeed or fail atomically.

#### FR-36: Versioned client-neutral API

Browser and future native clients consume a versioned API whose contracts are
not coupled to Next.js behavior.

**Consequences (testable):**

- Collections use opaque cursor pagination with stable ordering.
- Unsupported query features are rejected rather than silently ignored.
- Errors provide stable machine-readable codes, field sources when relevant,
  and correlation identifiers.
- Clients use purpose-specific commands for domain invariants instead of
  coordinating them through generic patches.

#### FR-37: Auditability and historical provenance

Identity, Membership, Workspace, Site, Location, Asset, Maintenance Schedule, Job, and
lifecycle changes retain enough provenance to explain current and historical
state.

**Consequences (testable):**

- Audited changes identify actor, time, Workspace, action, and relevant before-
  and-after context.
- Published revisions and historical records remain readable when archived or
  superseded.
- Corrections are appended through explicit actions rather than by silently
  rewriting history.

#### FR-38: Production readiness

The coherent MVP can be deployed and operated with repeatable release and
recovery procedures.

**Consequences (testable):**

- The production Docker Compose package builds and starts without host language
  runtimes beyond Docker.
- A release passes repository quality checks, applies migrations successfully,
  and completes a deployed-service health check.
- Backup and restore procedures are documented, and data is successfully
  restored into the target environment before release.
- An AWS ECS/Fargate deployment is maintained as a reference, not as a mandatory
  hosting provider.
- Quantitative service, capacity, and delivery thresholds remain gated by OQ-6
  and are required before FR-38 becomes implementation-ready.

## 5. Cross-Cutting Non-Functional Requirements

#### NFR-1: Accessibility

The browser targets WCAG 2.2 AA. Critical workflows are keyboard operable with
logical focus behavior, visible focus, associated help and error text, and
announced asynchronous outcomes. Meaning does not depend only on color, motion,
hover, fine pointer accuracy, or icon recognition. Ordinary content reflows at
a 320-pixel CSS viewport and 200% text zoom without horizontal scrolling.

#### NFR-2: Mobile-first interaction

Core workflows are designed and acceptance-tested from a 320-pixel-wide
viewport upward, use practical touch targets, preserve reading and keyboard
order across layouts, and do not depend on drag-and-drop.

#### NFR-3: Security and privacy

All server-side business rules, validation, authorization, and persistence are
enforced by the API. Workspace isolation is mandatory, bearer tokens and
invitation secrets are not stored as plaintext in application persistence, and
Evidence access is granted only through short-lived authorized access.

#### NFR-4: Historical integrity

Published definitions are immutable, completed work and lifecycle facts are
append-friendly, and current edits cannot reinterpret earlier Asset,
Installation, place, time zone, currency, Requirement, cost, or Evidence context.

#### NFR-5: Reliability and recoverability

Multi-record domain transitions are atomic; retryable operations are
idempotent; transient offline or delivery failures preserve work; and semantic
conflicts require explicit human review.

#### NFR-6: Time and measurement correctness

Instants use UTC, calendar-only facts remain dates, calendar recurrence uses the
Asset Site's IANA time zone, and canonical measurement values remain independent
of display-unit preferences.

#### NFR-7: Extensibility without premature breadth

Typed Triggers, Capability authorization, client-neutral API contracts, and
versioned definitions permit later extensions without introducing arbitrary
rules, generic enterprise workflows, or speculative first-version features.

## 6. MVP Scope and Delivery Milestones

[ASSUMPTION A-1: “First version” and “MVP” mean the coherent capability set
delivered through MVP 0–6 because the roadmap defines them as one coherent
MVP.] Each milestone must remain independently useful and preserve the product
requirements already established. Milestone order is a dependency sequence,
not a license to weaken earlier historical, tenancy, or contract guarantees.

### MVP 0: Delivery and Contract Foundation

- Provider-neutral identity, Workspace onboarding, switching, tenancy,
  versioned API, concurrency, idempotency, mobile browser shell, and quality
  gates.
- Excludes Assets, schedules, Jobs, attachments, offline synchronization,
  maintenance email, and production hardening at this milestone only.

### MVP 1: Workspace and Asset Foundation

- Membership and invitations, settings, Sites and nested Locations, versioned
  Asset Types, typed attributes and Meters, Component Roles, concrete Assets,
  placement, Installation, lifecycle, and Asset Type Reconciliation.
- Excludes Meter Readings, schedule authoring, Due Work, Jobs, attachments,
  reports, maintenance email preferences, and offline authoring at this
  milestone only.

### MVP 2: Schedules and Due Work

- Maintenance Schedule alternatives and citations, typed Requirements and
  Triggers, recurrence, Baselines, Meter Readings and inherited usage, Due Work,
  and unknown-history behavior.

### MVP 3: Work Execution

- Job and Work Item lifecycle, assignments, partial completion, ad hoc work,
  Maintainers, place, costs, private Evidence, Maintenance Needs, atomic
  replacement, and Component lifecycle reporting.

### MVP 4: Awareness and Reporting

- Due-work dashboard, notification center, email preferences and delivery,
  weekly digest, Meter-reading reminders, and Workspace-only reports.

### MVP 5: Offline Resilience

- Recent and pinned Asset trees, offline Job drafts, Meter Readings,
  attachments, replacement proposals, foreground synchronization, retry
  controls, idempotency, and `needs_review` conflict handling.

### MVP 6: Production Readiness

- Portable deployment packaging, observability, health checks, release checks,
  tested backup/restore, and an AWS reference deployment.

## 7. Non-Goals for the MVP

- Customer accounts, customer-owned fleet management, booking, and billing.
- Procurement, parts inventory, purchasing, and accounting integrations.
- Enterprise CMMS breadth or granular custom roles and permissions.
- Public or private Maintenance Schedule catalogs, template sharing, and
  imports.
- Asset Type inheritance or arbitrary Trigger formulas.
- Public report links, buyer-facing sharing, PDF reports, and CSV export.
- Web push notifications.
- Guaranteed background synchronization while the browser is closed.
- Advanced facility maps, capacity management, floor plans, and geofencing.
- Sensor integrations, adaptive-maintenance indicators, and prediction.
- QR codes and installable PWA packaging.
- A React Native client in the first version.

## 8. Success Metrics

[ASSUMPTION A-3: In the absence of sourced adoption or business targets,
release success is measured through product-correctness and acceptance outcomes
rather than invented usage metrics.] Product usefulness targets remain an
explicit pre-launch decision in OQ-7.

### Primary

- **SM-1: Acceptance-scenario completion.** All ten canonical scenarios in
  §8.1 pass on the real product stack before MVP completion. Validates the
  specific Functional Requirements mapped beside each scenario.
- **SM-2: Tenant isolation.** Acceptance and security testing yields zero cases
  in which one Workspace can discover or mutate another Workspace's data.
  Validates FR-4 and NFR-3.
- **SM-3: Historical integrity.** Lifecycle, revision, replacement, Job
  correction, and reporting tests yield zero silent rewrites of completed or
  superseded history. Validates FR-8, FR-9, FR-15 through FR-17, FR-24, FR-28,
  FR-31, FR-37, and NFR-4.
- **SM-4: Offline draft survival.** The offline acceptance scenario preserves
  100% of draft fields and Evidence across retryable failure and semantic
  conflict paths. Validates FR-32, FR-33, and NFR-5.

### Secondary

- **SM-5: Mobile and accessible completion.** Every milestone's golden path is
  completable at 320 CSS pixels and by keyboard, with critical flows manually
  checked against WCAG 2.2 AA expectations. Validates NFR-1 and NFR-2.
- **SM-6: Honest due state.** Test fixtures for unknown history and stale Meter
  Readings never display false completion or falsely safe Meter-based Due Work.
  Validates FR-19 and FR-20.
- **SM-7: Requirement verification coverage.** Before a milestone is considered
  complete, every in-scope FR consequence and NFR has recorded automated or
  manual acceptance evidence. Validates the milestone's full requirement set
  without claiming that the ten cross-cutting scenarios cover every detail.

### Counter-metrics

- **SM-C1: Record volume is not success.** More Assets, Jobs, notifications, or
  email does not demonstrate that maintenance decisions are more trustworthy.
- **SM-C2: Notification frequency is not success.** Alert volume must not be
  increased at the expense of relevance, subscription choice, or fatigue.
- **SM-C3: Configuration breadth is not success.** More field types, roles, or
  formulas must not displace the complete owner and small-team maintenance loop.

### 8.1 Canonical Acceptance Scenarios

1. An owner invites a partner, configures Sites and Locations, and both manage
   maintenance data while Membership administration remains owner-only.
   **Validates:** FR-3, FR-4, FR-6, FR-7.
2. A user switches between home and workshop Workspaces without data leakage; a
   new user creates a Workspace or accepts an owner-sent invitation.
   **Validates:** FR-1, FR-2, FR-3, FR-4.
3. An owner defines a `2024 Yamaha NMAX` Asset Type with a recursively typed CVT
   and creates a concrete Asset with required Components. **Validates:** FR-9,
   FR-10, FR-11, FR-12, FR-13.
4. A second-hand Asset at 35,000 km acknowledges an unknown brake-fluid
   Baseline and calculates the next 10,000 km interval without claiming prior
   replacement. **Validates:** FR-11, FR-17, FR-18, FR-19, FR-20.
5. Completing oil-change work at 25,000 km clears its Due Work and projects
   30,000 km; deferred CVT cleaning remains due with a planned annotation.
   **Validates:** FR-11, FR-20, FR-21, FR-22.
6. A closed weekend Job carries unfinished work forward without resetting its
   Requirements. **Validates:** FR-21, FR-22.
7. A Member adds an unplanned repair during active service; it remains ad hoc
   history unless explicitly linked to a Requirement. **Validates:** FR-23.
8. Replacing an engine preserves the old engine's work history, starts the new
   engine's lifecycle, and keeps the parent report coherent. **Validates:**
   FR-8, FR-14, FR-15, FR-28, FR-31.
9. A Maintenance Schedule revision adding a three-month oil-change Trigger
   retains completion history and recalculates the earliest next due point.
   **Validates:** FR-17, FR-18, FR-20.
10. Offline work uploads after reconnect; a replacement conflict remains
    reviewable without losing photos or receipts. **Validates:** FR-32, FR-33,
    FR-35.

## 9. Risks and Guardrails

- **Model complexity can overwhelm the intended audience.** Keep advanced
  structure progressive and ensure simple Assets do not require enterprise-like
  setup.
- **Historical integrity can be lost through generic edit operations.** Use
  explicit Reconciliation, amendment, void, replacement, and lifecycle actions.
- **Recursive trees can create invalid or unusable state.** Validate cycles,
  cardinality, tenant boundaries, placement, and the complete atomic command
  before mutation.
- **Offline completion can publish stale assumptions.** Upload all content,
  validate authoritative state atomically, and route semantic conflicts to
  `needs_review`.
- **Due calculations can imply false certainty.** Keep primary urgency separate
  from data-quality flags and require effective Meter Readings when necessary.
- **Email can become noisy or unreliable.** Keep the notification center
  authoritative, make maintenance email controllable, and deliver invitations
  through retryable transactional delivery.

## 10. Open Questions and Deferred Decisions

- **OQ-1 — Job cancellation semantics.** The sources allow cancellation before
  closure but do not define its stable state, whether a cancelled Job may retain
  completed Work Items, or how those completions affect Requirements. **Owner:**
  product. **Revisit before:** MVP 3 story creation.
- **OQ-2 — Default email subscriptions for invited Members.** Owner defaults and
  the default weekly digest are defined, but the default immediate-alert and
  digest subscriptions for new non-owner Members are not. **Owner:** product.
  **Revisit before:** MVP 4 story creation.
- **OQ-3 — Trash retention and restoration boundary.** Restoration behavior is
  defined, but no retention duration or purge policy is set, and MVP forbids
  hard deletion of domain records and Evidence. **Owner:** product and data
  governance. **Revisit before:** production data-lifecycle policy is finalized.
- **OQ-4 — Maintenance Need state vocabulary.** Creation, due targeting,
  resolution, and voiding are defined, but canonical status literals and the
  relationship to planned work are not. **Owner:** product. **Revisit before:**
  MVP 3 API and story design.
- **OQ-5 — Release policy.** MVP 0–6 form one coherent MVP and each milestone is
  independently useful, but the sources do not decide which milestones may be
  publicly released before MVP 6. **Owner:** maintainer. **Revisit before:** the
  first public release decision.
- **OQ-6 — Quantitative service targets.** Product-specific latency,
  availability, scale, attachment-size, cache-size, retry, and notification
  delivery targets are not defined. **Owner:** product and architecture.
  **Revisit before:** production-readiness acceptance criteria are fixed.
- **OQ-7 — Product-usefulness targets.** The sources define product-correctness
  acceptance criteria but no target for how efficiently a user can translate
  real guidance into a Maintenance Schedule or identify the next action without
  excessive setup. **Owner:** product research. **Revisit before:** public
  launch approval.

These open items do not change the coherent MVP feature boundary, but each is a
phase gate at the stated revisit point.

## 11. Assumptions Index

- **A-1 (§6):** “first version” and “MVP” refer to the coherent MVP 0–6
  capability set because the roadmap defines those milestones as one coherent
  MVP. This is a reconciliation interpretation, not a newly sourced release
  date or launch commitment.
- **A-2 (§0):** This PRD becomes canonical only after explicit approval; until
  then the five source documents retain authority, as directed for this run.
- **A-3 (§8):** In the absence of sourced adoption or business targets, success
  is measured through product-correctness and acceptance outcomes rather than
  invented usage metrics.
