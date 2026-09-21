# Wrenchbase Source Reconciliation

## Status Legend

- **Covered — PRD:** Product behavior is represented in `prd.md`.
- **Covered — addendum:** Contract or delivery context is represented in
  `addendum.md`.
- **Covered — trace:** Detail intentionally excluded from the canonical product
  narrative remains in the named `extract-*.md` record.

Every heading from the five user-designated sources is accounted for below.
Coverage does not change source authority until the deletion checkpoint is
explicitly approved.

## 1. `docs/product-vision.md`

- `# Product Vision` — **Covered — PRD:** §1 states the mobile-first,
  asset-category-neutral thesis and the position between narrow vehicle tools
  and enterprise systems.
- `## Product Promise` — **Covered — PRD:** §1, UJ-2 through UJ-7, and FR-9
  through FR-33 cover reusable definitions, concrete Assets, work history,
  lifecycle, evidence, and honest Due Work.
- `## Principles` — **Covered — PRD:** §1.1 and NFR-1 through NFR-7 preserve all
  seven principles.
- `## Audience` — **Covered — PRD:** §2.1 and §7 define the four audiences and
  exclude customer-facing garage operations.
- `## Scope` — **Covered — PRD:** FR-1 through FR-38 and §6 cover every named MVP
  capability.
- `## Non-Goals For The First Version` — **Covered — PRD:** §7 preserves the
  exclusions, including template sharing and closed-browser sync.

Full evidence: `reconcile-product-vision.md`.

## 2. `docs/product-requirements.md`

- `# Product Requirements` — **Covered — PRD:** §0 adopts its product-behavior
  role at approval time, and §4 records the new canonical ID policy.
- `## Status and Authority` — **Covered — PRD:** §0 and this report preserve the
  pre-approval authority boundary and retained architecture role.
- `## Product Purpose` — **Covered — PRD:** §1 and §2 preserve the central
  schedule → work → next-due loop, audience, Asset breadth, and CMMS boundary.
- `## Product Vocabulary` — **Covered — PRD:** §3 defines all source terms and
  retains the prohibition on “maintenance plan” as a synonym.
- `## Workspace, Members, and Settings` — **Covered — PRD:** FR-1 through FR-5
  and FR-30 cover tenancy, onboarding, invitations, roles, Capabilities,
  settings, and subscriptions.
- `## Sites, Locations, and Asset Placement` — **Covered — PRD:** FR-6 through
  FR-8 cover Site address/timezone, recursive Locations, singular placement,
  removal outcomes, and dated history.
- `## Asset Types and Asset Lifecycles` — **Covered — PRD:** FR-9 through FR-16
  cover versioning, typed definitions, recursive Components, Reconciliation,
  lifecycle, trash, and the material-versus-Asset boundary.
- `## Meters, Time, and Baselines` — **Covered — PRD:** FR-11, FR-19, FR-20,
  FR-25, and NFR-6 cover readings, inheritance, correction, time semantics, and
  unknown history.
- `## Maintenance Schedules and Due Work` — **Covered — PRD:** FR-17 through
  FR-20 cover alternatives, revision adoption, sources, typed Triggers,
  recurrence, Due Work, stale readings, and next-occurrence projection.
- `## Jobs, Work Items, and Maintenance Needs` — **Covered — PRD:** FR-21
  through FR-28 cover lifecycle, assignment, fulfillment, partial work, ad-hoc
  history, correction, place, participants, costs, Evidence, needs, and
  replacement.
- `## Notifications and Reports` — **Covered — PRD:** FR-29 through FR-31 cover
  the authoritative notification center, email, digest, and Workspace reports.
- `## Offline Behavior` — **Covered — PRD:** FR-32 and FR-33 cover cache scope,
  local persistence, synchronization, publication, conflicts, and idempotency.
- `## MVP Acceptance Scenarios` — **Covered — PRD:** §8.1 preserves all ten
  scenarios in source order.
- `## Non-Goals` — **Covered — PRD:** §7 preserves all sixteen exclusions and
  adds roadmap-only later items without weakening the source.

Full evidence: `reconcile-product-requirements.md`.

## 3. `docs/roadmap.md`

- `# Roadmap` — **Covered — PRD:** §6 preserves one coherent MVP, milestone
  order, and independent usefulness.
- `## MVP 0: Delivery and Contract Foundation` — **Covered — PRD/addendum:** §6
  retains the product boundary; addendum §2 preserves contract and delivery
  context.
- `## MVP 1: Workspace and Asset Foundation` — **Covered — PRD/addendum:** §6
  retains the product boundary; addendum §3–§4 preserves contract and sequence.
- `## MVP 2: Schedules and Due Work` — **Covered — PRD:** §6, FR-17 through
  FR-20.
- `## MVP 3: Work Execution` — **Covered — PRD:** §6, FR-21 through FR-28.
- `## MVP 4: Awareness and Reporting` — **Covered — PRD:** §6, FR-29 through
  FR-31.
- `## MVP 5: Offline Resilience` — **Covered — PRD:** §6, FR-32 and FR-33.
- `## MVP 6: Production Readiness` — **Covered — PRD:** §6 and FR-38.
- `## Later` — **Covered — PRD:** §7 preserves every later-scope category,
  including private/public catalogs, sharing, QR codes, PWA, sensors, native
  mobile, and enterprise CMMS.

Full evidence: `reconcile-roadmap.md`.

## 4. `docs/mvp-0-implementation-plan.md`

- `# MVP 0 Implementation Plan` — **Covered — PRD/addendum:** §6 defines the
  milestone; addendum §2 and §4 retain its delivery role.
- `## Goal and completion criteria` — **Covered — PRD/addendum:** §6 preserves
  the walking-skeleton outcome and exclusions; addendum §2 retains the real-
  stack completion path.
- `## Authentication and identity` — **Covered — PRD/addendum:** FR-1 and
  addendum §2 preserve observable identity behavior and protocol context.
- `## API contract` — **Covered — PRD/addendum:** FR-2, FR-4, FR-34 through
  FR-36, and addendum §2 preserve the client contract.
- `## Concurrency and idempotency` — **Covered — PRD/addendum:** FR-34, FR-35,
  and addendum §2 preserve stale-edit recovery and protocol mechanics.
- `## Persistence and tenancy` — **Covered — PRD/addendum:** FR-4, FR-37,
  NFR-3, and addendum §2 preserve security and persistence boundaries.
- `## Browser application` — **Covered — PRD/addendum:** UJ-1, FR-1 through
  FR-5, FR-34, NFR-1, NFR-2, and addendum §2 preserve the browser outcomes.
- `## Testing and CI` — **Covered — addendum/trace:** addendum §2 and §5 retain
  verification commitments; tool- and wiring-level detail remains in
  `extract-mvp-0-implementation-plan.md`.
- `## Delivery sequence` — **Covered — addendum:** addendum §4 preserves the
  ordered sequence without presenting it as product priority.

Full evidence: `reconcile-mvp-0-implementation-plan.md`.

## 5. `docs/mvp-1-implementation-plan.md`

- `# MVP 1 Implementation Plan` — **Covered — PRD/addendum:** §6 and addendum
  §3–§4 preserve its role and dependency on MVP 0.
- `## Goal and completion criteria` — **Covered — PRD/addendum:** §6 and the
  Asset/Membership FRs preserve scope and outcomes; addendum §3 preserves the
  real-stack proof context.
- `## Delivery slices` — **Covered — addendum:** §4 retains the four dependency-
  ordered slices and later detailed sequence.
- `## Authorization capabilities` — **Covered — PRD/addendum:** FR-4 preserves
  behavior; addendum §3 lists every exact Capability string.
- `## Membership and invitations` — **Covered — PRD/addendum:** FR-3 and FR-30
  preserve product behavior; addendum §3 preserves delivery mechanics.
- `## Workspace settings` — **Covered — PRD:** FR-5 and §6 retain preferences
  and the milestone placement of deferred settings.
- `## Sites and nested locations` — **Covered — PRD:** FR-6 through FR-8 cover
  creation, address/timezone, nesting, order, reparenting, archive, restore,
  concurrency, and history.
- `## Asset types and revisions` — **Covered — PRD:** FR-9 and FR-16 cover
  draft/publish/revise/archive/restore, stable definitions, and adoption.
- `## Typed attributes` — **Covered — PRD:** FR-10.
- `## Meter definitions` — **Covered — PRD:** FR-11 and the MVP 1/MVP 2 boundary
  in §6.
- `## Component roles` — **Covered — PRD:** FR-12.
- `## Concrete assets and configured values` — **Covered — PRD:** FR-13.
- `## Placement and installation history` — **Covered — PRD:** FR-8 and FR-14.
- `## Lifecycle and installed subtrees` — **Covered — PRD:** FR-15.
- `## Asset-type adoption and reconciliation` — **Covered — PRD/addendum:**
  FR-16 preserves behavior; addendum §3 retains protocol outcome mapping.
- `## API contract` — **Covered — PRD/addendum:** FR-34 through FR-36 and
  addendum §3.
- `## Persistence and tenancy` — **Covered — PRD/addendum:** FR-4, FR-37,
  NFR-3, and addendum §3.
- `## Browser application` — **Covered — PRD/addendum:** UJ-1, UJ-2, FR-3,
  FR-6 through FR-16, NFR-1, NFR-2, and addendum §3.
- `## Testing and CI` — **Covered — addendum/trace:** addendum §3 and §5 retain
  acceptance intent; detailed matrices remain in
  `extract-mvp-1-implementation-plan.md`.
- `## Delivery sequence` — **Covered — addendum:** addendum §4.

Full evidence: `reconcile-mvp-1-implementation-plan.md`.

## 6. Resolved Reconciliation Decisions

- **Requirement IDs:** No source contained formal requirement IDs. New stable
  IDs FR-1 through FR-38 were assigned once and mapped above.
- **Due-state vocabulary:** The vision's user-facing `unknown` and “waiting for
  a fresh meter reading” are represented as `history_unknown` and
  `reading_needed` flags alongside, not instead of, the primary due state.
- **Offline completion terminology:** “Marked complete offline” is a local
  close/publication request; the server reaches `closed` only after complete
  upload and atomic validation.
- **Site address conflict:** Product Requirements describes a Site as having an
  address while the MVP 1 plan calls the structured address optional. The
  canonical PRD follows the higher-authority Product Requirements and requires
  the structured address without inventing unknown subfields.
- **Row-level security timing:** The roadmap's “prepared for” language is
  reconciled with the MVP 1 decision to apply row-level security to tenant-
  domain tables introduced in that milestone.
- **Workspace photo/logo timing:** The setting remains in coherent MVP scope but
  is scheduled for MVP 3 when private object storage exists.

## 7. Unresolved Conflicts and Gaps

No unresolved conflict changes the coherent MVP boundary. Seven decisions remain
open and are recorded with owners and phase gates in PRD §10:

1. Job cancellation semantics.
2. Default maintenance-email subscriptions for invited non-owner Members.
3. Trash retention and purge policy.
4. Canonical Maintenance Need status literals and planned-work relationship.
5. Which independently useful milestones may be released publicly before MVP 6.
6. Quantitative latency, availability, scale, attachment, cache, retry, and
   delivery targets.
7. Product-usefulness targets for Maintenance Schedule setup and next-action
   comprehension.

## 8. Inbound Links Requiring Update After Deletion Approval

The following retained files link to one or more proposed source deletions and
must be updated in the same later deletion change:

- `AGENTS.md` lines 14–15 — links to `docs/product-vision.md` and
  `docs/product-requirements.md`; replace with the canonical PRD and retain the
  architecture instruction.
- `README.md` lines 67 and 82–84 — links to product requirements, product
  vision, and roadmap; replace the planning links with the canonical PRD.
- `docs/architecture.md` line 175 — links to product requirements; point the
  normative behavior reference to the canonical PRD.
- `docs/api-contract.md` line 3 — links to product requirements; point product
  behavior authority to the canonical PRD.
- `docs/offline-sync.md` line 5 — links to product requirements; point offline
  product-scope authority to the canonical PRD.
- `docs/mvp-0-ui-ux-plan.md` line 5 — links to the MVP 0 implementation plan;
  point milestone scope to PRD §6 and contract/delivery context to the addendum.
- `docs/mvp-0-delivery-runbook.md` line 3 — links to the MVP 0 implementation
  plan; point the runbook's governing scope to PRD §6 and retained delivery
  context to the addendum.

Links only among files proposed for deletion do not require migration because
their source and target would be removed together.

## 9. Deletion Approval Checkpoint

Exact source files proposed for deletion after explicit approval:

1. `docs/product-vision.md`
2. `docs/product-requirements.md`
3. `docs/roadmap.md`
4. `docs/mvp-0-implementation-plan.md`
5. `docs/mvp-1-implementation-plan.md`

No source file has been deleted in this run.
