# Extraction: `docs/mvp-1-implementation-plan.md`

## Source role and extraction rule

This source records MVP 1 delivery decisions for the workspace and asset
foundation. It explicitly keeps `docs/product-requirements.md` authoritative
for product behavior and builds on `docs/mvp-0-implementation-plan.md`.
Accordingly, user-visible behavior, business rules, permissions, lifecycle
semantics, scope boundaries, and completion outcomes below are PRD candidates.
Architecture, persistence mechanisms, framework choices, endpoint mechanics,
test inventory, and commit slicing are addendum/trace context unless needed to
state a public contract.

## Exact heading coverage

### Exact heading: `# MVP 1 Implementation Plan`

- **PRD candidate:** MVP 1 is the workspace and asset foundation milestone.
- **Authority/dependency:** product requirements remain authoritative; MVP 1
  delivery builds on the MVP 0 plan.

### Exact heading: `## Goal and completion criteria`

**PRD candidates**

- MVP 1 establishes the people, places, blueprints, and concrete assets needed
  by later maintenance workflows.
- Owners can invite people and manage membership.
- Members can create sites and nested locations; publish versioned asset types
  with typed attributes, meters, and component roles; and create concrete
  assets with recursively installed required components.
- Members can move, install, detach, retire, dispose, trash, and restore assets
  without losing placement, installation, revision, or audit history.
- Completion requires a real-stack proof that two members can manage one
  workspace while another remains isolated, and that an asset assembly retains
  coherent history through type adoption, movement, detachment, and lifecycle
  changes.
- Explicitly excluded from MVP 1: meter readings, schedule authoring, due-work
  calculation, maintenance jobs, attachments, reports, notification
  preferences, and offline authoring.
- Transactional invitation email is included. Maintenance email is MVP 4.
  Workspace photos/logos wait for private object storage in MVP 3.

**Addendum/trace context:** the completion proof is implemented as a
real-stack browser test.

### Exact heading: `## Delivery slices`

- **Scope/sequencing:** deliver in dependency order: (1) membership and
  invitations, (2) sites and nested locations, (3) versioned asset-type
  authoring, and (4) assets, placement, component installation, and lifecycle.
- **Addendum/trace context:** each slice changes API contract, browser, tests,
  and audit behavior together; earlier foundations may be reused, while empty
  layers and speculative later tables are prohibited.

### Exact heading: `## Authorization capabilities`

**PRD/product-contract candidates**

- Permissions are capability-based; clients must not infer permission from
  role names.
- Owners and members receive `workspace.read`, `workspace.membership.read`,
  `site.read`, `site.manage`, `assetType.read`, `assetType.manage`,
  `asset.read`, and `asset.manage`.
- Owners additionally receive `workspace.update` and
  `workspace.membership.manage`.
- Only `workspace.membership.manage` permits invitation creation/revocation,
  member removal, and ownership transfer.
- Cross-workspace identifiers, including nested locations, asset-type
  revisions, components, and installations, must not reveal existence.

**Addendum/trace context:** authorize before scoped lookup; represent hidden
cross-workspace resources as HTTP `404`.

### Exact heading: `## Membership and invitations`

**PRD candidates**

- An owner invites a normalized email address with an optional personal
  message. Only one unexpired pending invitation per normalized address and
  workspace is allowed.
- Email matching trims surrounding whitespace, applies Unicode case folding,
  and IDNA-normalizes the domain. It does not remove dots, plus suffixes, or
  other provider-specific aliases. The submitted form is retained for display
  and delivery.
- Invitations use random single-use secrets, expire after seven days, and
  never retain a plaintext secret.
- Creating or resending rotates the secret and expiry and queues delivery;
  revocation invalidates all previously issued links.
- The email opens the browser app; the invitee authenticates with OIDC before
  acceptance, and the verified provider email must match under the stated
  normalization policy.
- Acceptance is idempotent: it creates exactly one active `member` membership,
  consumes the invitation, advances membership revisions, and records audit
  history atomically.
- Only the addressed signed-in user may inspect the safe summary required for
  acceptance. Unauthenticated or differently addressed users see neither
  workspace nor invitee details.
- Owners can list active members and pending invitations, revoke invitations,
  and remove members. Every member can list active members.
- Ownership can transfer only to an active member. Transfer atomically promotes
  the recipient and demotes the initiating owner. The last owner cannot leave,
  be removed, or be demoted without a successful transfer.
- Membership tenures and consumed/revoked invitations remain historical.
  Rejoining creates a new tenure rather than rewriting an old one.
- Invitation creation and the request to deliver it must commit together, and
  mail-provider availability must not determine the HTTP request's success.

**Addendum/trace context:** use a purpose-specific mail port, PostgreSQL
transactional outbox, retryable worker, and captured-mail development service.
The transport/outbox may be reused for later notifications, but
invitation-specific application logic may not be reused as generic notification
logic.

### Exact heading: `## Workspace settings`

**PRD candidates**

- MVP 1 adds unit preferences for measurement dimensions used by asset
  attributes and meter definitions, on top of MVP 0 name, locale, and default
  currency settings.
- Canonical measurements are stored independently of display preferences.
  Preferences affect input defaults and display conversion only; changing them
  never rewrites stored measurements.
- Due-soon defaults are deferred to MVP 2; meter-reminder defaults and email
  subscriptions to MVP 4; photo/logo to the private storage available in MVP 3.

### Exact heading: `## Sites and nested locations`

**PRD candidates**

- A site has name, IANA timezone, optional structured postal address, lifecycle
  status, immutable creation time, and revision.
- Structured addresses use address lines, locality, administrative area,
  postal code, and ISO 3166-1 country code; unknown data is not invented.
- Locations permanently belong to one site and form an ordered, arbitrarily
  deep, acyclic tree. Each has name, optional parent, sibling position,
  lifecycle status, and revision.
- Display paths are derived from current ancestors and are not identifiers.
  Reparenting is permitted only within the same site and cannot create cycles.
- Site creation does not create a default location. A directly placed active
  asset requires the member to explicitly choose or create a location.
- Archiving a location atomically archives its selected subtree and is blocked
  when an active asset is directly placed anywhere in that subtree. Installed
  descendants derive location from the directly placed root.
- Restoring a location requires an active site and either no parent or an
  active parent.
- A site may be archived only when all its locations are archived and it has no
  directly placed active assets.
- Renaming, reparenting, sibling reordering, archival, and restoration are
  concurrency-checked commands.
- Historical placement and future completed-job snapshots retain their
  original meaning as the current tree changes. Site/location events retain
  before-and-after names, paths, address, and applicable timezone.

**Addendum/trace context:** concurrency uses opaque revisions; exact command
and event representations belong in contract/architecture detail.

### Exact heading: `## Asset types and revisions`

**PRD candidates**

- An asset type is a stable, workspace-owned identity with active/archived
  lifecycle. Its revisions contain the user-visible blueprint.
- A new type starts with one mutable draft. Publishing permanently freezes the
  revision. Starting a revision clones the latest published revision into one
  new draft. A type has at most one draft and one current published revision.
- A never-published, unreferenced draft type may be deleted. Once published or
  referenced, a type is archived, not deleted.
- Archived types and published revisions remain readable wherever history
  references them. Archived types must be restored before revising/publishing.
- Publish/archive operations are idempotent and concurrency checked.
  Publication validates the whole blueprint and advances a positive revision
  number.
- Assets can be created only from an explicitly selected published revision,
  never an editable draft.
- Definitions use stable UUID identities across cloned revisions when the
  concept persists. Renames preserve identity; genuinely new definitions or
  choice options get new identities; removed definitions remain available in
  old revisions. Definitions are never matched by title.

### Exact heading: `## Typed attributes`

**PRD candidates**

- An attribute definition has stable identity, revision-unique key, label,
  type, required flag, optional help, sibling position, and optional
  type-valid default.
- Supported types: short text, long text, exact decimal, measurement with
  dimension/canonical unit, boolean, calendar date, and single choice with
  ordered stable options.
- Keys are stable API names and cannot be silently repurposed.
- Decimal values are exact, not binary floating point. Measurements are
  normalized to canonical units. Choices reference stable option identities,
  not labels.
- Publication rejects duplicate keys, invalid defaults, empty choice sets, and
  reuse of an existing identity for an incompatible type.
- A required field without a default is valid; asset creation must obtain its
  value.

### Exact heading: `## Meter definitions`

**PRD candidates**

- A meter definition has stable identity, unique key, label, measurement
  dimension, canonical unit, decimal precision, and sibling position.
- MVP 1 defines meters and instantiates their identities on assets; readings
  and inherited usage start in MVP 2.
- Publication rejects units outside the chosen dimension and identity reuse
  with a different dimension.
- Later revisions may change label/presentation unit without changing the
  meter's accumulated meaning.

### Exact heading: `## Component roles`

**PRD candidates**

- A component role has stable identity, unique key, label, minimum and optional
  maximum cardinality, sibling position, and one or more compatible asset
  types. Minimum is non-negative; maximum cannot be below minimum.
- Compatibility references stable asset-type identity, never title.
- For a positive minimum with exactly one compatible type, publishing the
  parent snapshots that type's current published revision for automatic child
  creation. Parent creation atomically creates/installs the minimum children.
- Later publication of the child type does not change an already published
  parent blueprint. Generated child names use role label and an ordinal where
  needed and remain editable.
- Ambiguous required roles are resolved at parent creation by explicitly
  selecting compatible published revisions.
- Publication rejects a required role with no compatible published type and an
  unambiguous required-role chain that would recurse forever.
- A type cannot be archived while a current published revision depends on it
  for automatic child creation. Optional compatibility cycles are allowed;
  concrete installations independently prohibit cycles.
- Members may install an ad-hoc typed component using a role label. Later
  reconciliation may explicitly map it to a new blueprint role, but never by
  automatic label matching.

### Exact heading: `## Concrete assets and configured values`

**PRD candidates**

- An asset has stable identity, editable name, lifecycle state, selected
  asset-type revision, configured values, instantiated meters, revision, and
  creation time.
- Creation requires either a direct active location or a parent installation.
  Required-child creation and initial placement/installation are atomic.
- Values are validated against the selected published revision. Defaults are
  materialized at creation so later blueprint changes cannot reinterpret them.
- Unknown optional values remain absent. Required values without defaults must
  be supplied during creation or required-role resolution.
- Configured values retain definition identity and the accepting revision.
  Values removed by later adoption remain historically readable but leave the
  active configuration.

### Exact heading: `## Placement and installation history`

**PRD candidates**

- Every active asset has exactly one current placement: directly in one active
  workspace location or via one open installation in one active parent.
- Placements/installations are dated history records. Moving atomically closes
  the old record and opens the new record.
- Commands accept an effective instant (default current API time) and reject
  overlaps or chronology predating later transitions.
- Installation requires active same-workspace parent/child, compatible role or
  explicit ad-hoc label, available capacity, and an acyclic result.
- Installed-to-location is detach; directly placed-to-parent is install.
- Moving an assembly moves only its directly placed root; descendants inherit
  location through that root.
- MVP 1 manual install/detach is not completed maintenance. MVP 3 adds atomic
  job-based replacement work.

### Exact heading: `## Lifecycle and installed subtrees`

**PRD candidates**

- Lifecycle states are `active`, `retired`, `disposed`, and `trashed`; trash
  records the prior state for deterministic restoration.
- Retire, dispose, trash, and restore capture reason, effective instant, actor,
  and audit event and never delete asset history.
- When an active asset becomes inactive, its incoming placement/installation
  closes, but descendant installations remain open and the assembly structure
  remains intact.
- Reactivating a retired root atomically requires a new active location or
  compatible parent.
- Components below an inactive host retain their own lifecycle state but the
  subtree is operationally paused. Later due-work/reminders treat descendants
  as paused without inventing lifecycle events.
- A lifecycle command may atomically detach non-overlapping selected component
  subtrees before host transition. Each selected root must be rehomed to an
  active location/compatible parent outside the transition subtree, retired,
  or disposed in the same request; descendants travel or pause with it.
- All destinations, lifecycle choices, and cycles validate before mutation; an
  invalid selection aborts the entire operation.
- A selected asset in an already paused subtree must be atomically detached to
  active placement or transitioned to retired/disposed before independent
  resumption; it cannot remain active and locationless.
- Whole retained assemblies may be disposed or trashed. Reactivating/restoring
  an active root resumes still-active descendants; descendants with their own
  inactive state remain inactive.
- Restore returns a trashed asset to its prior state. Restoring to active
  requires active placement unless its retained root is restored atomically.
  Restoring to retired requires no active placement.
- Disposed assets are not restorable. Corrections use separately audited
  lifecycle amendments rather than overwriting disposal history.

### Exact heading: `## Asset-type adoption and reconciliation`

**PRD candidates**

- Assets never silently adopt a newer type revision.
- Preview uses stable definition identities to classify unchanged/renamed
  attributes, meters, and roles; added definitions and required decisions;
  removed definitions retained historically; compatible/incompatible type
  changes; and installations that remain, need mapping, or violate new maxima.
- Applying adoption requires explicit resolutions and current asset/target
  versions. New required values and ambiguous components must be supplied;
  unambiguous required components may be created atomically.
- Ad-hoc installations may be explicitly mapped to roles. Reconciliation never
  automatically uninstalls, retires, disposes, or deletes an asset.
- Adoption is atomic and records previous/adopted revisions and the accepted
  diff.
- A stale preview fails as a precondition; a current but unsatisfiable request
  returns an appropriate conflict or validation error.

**Addendum/trace context:** currentness uses asset/type ETags; response status
mapping is `412` for stale, `409` semantic conflict, or `422` validation.

### Exact heading: `## API contract`

**Product/public-contract candidates**

- MVP 1 preserves the versioned API and established pagination, errors,
  correlation, optimistic concurrency, and idempotency guarantees.
- Collections default to immutable creation-time plus UUID cursor order unless
  a capability contract declares another immutable order. Tree/sibling order
  is returned as data and is not a cursor key.
- Creates and multi-record commands require idempotency; state-dependent
  mutations require a current-version precondition.
- Compound invitation, ownership, tree, publication, placement, installation,
  lifecycle, and adoption actions are atomic and return the resulting read
  model.
- Clients use purpose-specific commands rather than coordinating domain
  invariants through generic patches.

**Addendum/trace context:** `/api/v1`, JSON:API 1.1, `Idempotency-Key`,
`If-Match`, and exact command endpoint shapes are API design/trace material.

### Exact heading: `## Persistence and tenancy`

**PRD candidates**

- Every tenant-owned record is non-null workspace scoped, and cross-workspace
  parentage, compatibility, placement, and installation are impossible.
- Capability authorization remains primary; row-level security provides
  defense in depth.
- Historical invitations, tenures, placements, installations, lifecycle
  events, audit information, and reconciliations must be retained sufficiently
  to support the behavior above.

**Addendum/trace context:** introduce relational concepts only per slice; use
composite constraints/FKs; enable PostgreSQL RLS on MVP 1 tenant-domain tables
with transaction-local scope and MVP 0's restricted role; keep control-plane
records outside tenant-domain RLS but explicitly scoped; use database
constraints for local invariants and locked domain transactions for graph,
subtree, recursive-creation, and reconciliation invariants. Exact tables are
capability-level implementation decisions.

### Exact heading: `## Browser application`

**PRD candidates**

- Mobile-first workflows cover invitation acceptance after sign-in;
  member/pending-invite lists with owner controls; site and nested-location
  creation/browse/move/order/archive/restore; draft type authoring, validation,
  full-blueprint review and publication confirmation; asset creation and
  ambiguous-component resolution; asset-tree browsing with current revision
  and inherited location; move/install/detach with consequences visible before
  confirmation; reconciliation preview/application; and lifecycle changes with
  atomic component detach/rehoming.
- Forms preserve user input after validation errors, network errors,
  conflicts, and stale-version failures.
- Destructive-looking lifecycle screens explain retained history and paused
  descendants.
- Tree controls are keyboard accessible, do not depend on drag-and-drop, and
  provide explicit touch/assistive-technology-compatible move actions.

**Addendum/trace context:** authenticated routes remain client-composed; browser
implementation uses Application ports/use cases, private Infrastructure DTOs
with runtime parsing, TanStack Query, and thin Next.js delivery files.

### Exact heading: `## Testing and CI`

**PRD acceptance coverage**

- Membership proof covers secrecy, expiry, resend/revocation, verified-email
  matching, replay, tenure, last-owner safety, transfer, capability behavior,
  auditing, and reliable queued delivery.
- Place proof covers timezone/address validation, ordering, reparenting,
  cycles, archive/subtree/restore rules, revisions, and tenant isolation.
- Type proof covers draft/published lifecycle, stable identities, typed
  defaults/values, units/options/cardinality/compatibility, recursion,
  idempotent publication, archive, and restore.
- Asset proof covers recursive creation, ambiguity, direct/inherited
  placement, chronology, capacity/cycles, ad-hoc components, preview/stale
  adoption, retained values, lifecycle/subtree pause-resume, atomic detach,
  restore placement, and tenant isolation.
- Browser proof covers capability-driven controls, invitation states,
  keyboard-usable trees, draft errors, creation, preserved forms,
  reconciliation, stale revisions, and lifecycle explanations.
- End-to-end completion scenario: invite/accept/switch; create site/tree;
  publish parent/component types and recursively create an assembly; move it,
  add an ad-hoc component and adopt a revised type via preview; retire the host
  while detaching/re-homing a component and verify subtree pause; transfer
  ownership; verify another workspace cannot discover the shared workspace's
  site, type, asset, or installation.

**Addendum/trace context:** run the golden path on real Compose with serial
Chromium, exercise primary flows at narrow mobile viewport, retain failure
artifacts, keep `make check` green, and add migration/RLS integration coverage
before tenant tables ship.

### Exact heading: `## Delivery sequence`

- **Sequencing/trace:** membership/invitations -> sites/locations -> versioned
  types -> asset creation/placement -> installation/lifecycle -> explicit type
  reconciliation -> end-to-end golden path.
- **Addendum/trace context:** suggested Conventional Commit subjects are
  `feat(memberships)`, `feat(locations)`, two `feat(asset-types)` phases, two
  `feat(assets)` phases, and `test(e2e)`; large slices may use smaller cohesive
  commits; implementation and tests stay together; shared API documentation is
  updated with every client-visible contract change.

## Stable identifiers and controlled vocabulary

- No formal product requirement IDs occur in this source. Do not invent legacy
  IDs for its statements.
- Preserve exact capability identifiers listed under `Authorization
  capabilities` as public contract identifiers.
- Preserve stable UUID identities for asset types, revision definitions,
  choice options, assets, and related domain concepts where explicitly stated.
- Preserve lifecycle literals `active`, `retired`, `disposed`, and `trashed`,
  and membership role literal `member` where the canonical PRD exposes
  controlled vocabulary.
- Milestone label `MVP 1` and the four named delivery slices are stable
  source-level trace anchors.
- HTTP status codes, headers, JSON:API version, and path are stable API-contract
  trace, but should live in PRD addendum/API references unless the canonical
  PRD intentionally specifies external developer contracts.

## Dependencies and sequencing

- MVP 1 depends on MVP 0 authentication, workspace, contract, restricted
  runtime role, and delivery foundations.
- Membership precedes place/type/asset collaboration; locations and published
  types precede concrete asset creation; assets precede installation,
  lifecycle, and adoption.
- Later dependencies explicitly created here: MVP 2 consumes meters,
  assemblies, lifecycle pause semantics, schedule settings, and due-work
  behavior; MVP 3 adds job replacement, private object storage, photos/logos,
  attachments, and completed-job snapshots; MVP 4 adds maintenance email,
  reminder defaults, subscription preferences, and awareness.
- The source forbids speculative later storage/layers during earlier slices.

## Conflicts and missing decisions

No internal contradiction is explicit. Reconciliation must defer to
`docs/product-requirements.md` if another source differs because this plan says
that document remains authoritative.

Potential gaps to confirm across authoritative sources, without promoting them
to invented requirements:

- The source does not assign globally stable requirement IDs.
- “Arbitrarily nested” states no configured depth/performance limit.
- Site lifecycle statuses are mentioned but not enumerated; location lifecycle
  statuses are likewise not enumerated.
- The exact editable fields and validity rules for asset-type revisions beyond
  the listed definitions are not fully catalogued here.
- Lifecycle amendment behavior for correcting disposal is named but not fully
  specified or placed in a milestone.
- The source does not define invitation rate limits, delivery retry bounds, or
  owner recovery when the sole owner loses access.
- It does not specify bulk operations, import/export, search, filtering, or
  list-size/performance targets for MVP 1.
- It does not define quantitative accessibility conformance, latency,
  availability, or scale targets; these require reconciliation with broader
  requirements rather than assumptions.
- “Full blueprint” review and “consequential target” are UX outcomes but lack
  detailed presentation acceptance criteria, which belong in later UX work.
