# Extraction: `docs/roadmap.md`

## Source role and governing statements

- The roadmap defines one coherent MVP delivered through sequential capability milestones.
- Every milestone must remain independently useful and preserve the rules in
  `docs/product-requirements.md`; the roadmap does not supersede those rules.
- MVP 0 implementation detail belongs to `docs/mvp-0-implementation-plan.md`,
  and execution packaging belongs to `docs/mvp-0-delivery-runbook.md`.
- MVP 1 delivery decisions and internal slices belong to
  `docs/mvp-1-implementation-plan.md`.
- The numbered order is the only sequencing signal stated. Dependencies below
  are therefore either explicit links or conservative capability dependencies,
  not additional requirements.

## Heading-by-heading coverage

### Exact heading: `# Roadmap`

Coverage to preserve in the canonical PRD:

- Treat MVP 0 through MVP 6 as capability milestones of one coherent MVP.
- Preserve independent usefulness at each milestone boundary.
- Preserve product-requirements authority and the explicit links to the MVP 0
  and MVP 1 plans (plus the MVP 0 delivery runbook where delivery detail is
  referenced).

### Exact heading: `## MVP 0: Delivery and Contract Foundation`

Scope:

- Provider-neutral OpenID Connect authentication, workspace onboarding,
  multi-workspace switching, and capability-based tenancy enforcement.
- Versioned JSON:API conventions, semantic errors, cursor pagination,
  optimistic concurrency, and persisted idempotency results.
- Shared-table PostgreSQL tenancy foundations, audit events, and a restricted
  application database role prepared for defense-in-depth row-level security.
- Enforced Symfony and strict TypeScript standards, 120-character source-line
  limits, documented class-property types, architecture dependency checks, and
  equivalent local/CI quality gates.
- Mobile-first workspace navigation, accessibility, complete loading and error
  states, CI checks, and a real-stack browser golden path.

Boundary and sequencing decision: establish delivery, contract, tenancy,
quality, and browser-shell foundations before asset-domain capabilities.

### Exact heading: `## MVP 1: Workspace and Asset Foundation`

Scope:

- Owner-sent invitations and owner/member administration through
  capability-based authorization.
- Expanded workspace settings, sites, and nested locations.
- Versioned asset types with typed attributes, meters, and component roles.
- Concrete assets with recursive installation history, placement, movement,
  retirement, disposal, and restorable trash.

Boundary and sequencing decision: establish workspace membership, location,
asset definition, and asset lifecycle foundations before schedules or work
execution. Internal delivery slices remain governed by the linked MVP 1 plan.

### Exact heading: `## MVP 2: Schedules and Due Work`

Scope:

- Versioned maintenance-schedule alternatives and source citations.
- Requirements with one-time, elapsed, meter, calendar, and manual triggers.
- Rolling and anchored recurrence, initial service phases, overrides, and
  schedule-adoption diffs.
- Meter readings, inherited component usage, baselines, due-work calculation,
  and unknown-history handling.

Boundary and sequencing decision: due-work calculation depends on the asset,
component, typed-meter, and versioning foundations established in MVP 1.

### Exact heading: `## MVP 3: Work Execution`

Scope:

- Planned, active, closed, amended, and voided maintenance jobs.
- Targeted work items, partial completion, assignments, requirement
  completions, and on-site ad-hoc work.
- Maintainers, work locations, costs, attachments, inspection outcomes, and
  follow-up maintenance needs.
- Private object storage with authorized signed attachment uploads/downloads.
- Atomic component replacement and lifecycle reporting.

Boundary and sequencing decision: execution consumes the scheduled/due-work
model while also supporting ad-hoc work; reporting here is limited to component
lifecycle reporting, with broader reporting deferred to MVP 4.

### Exact heading: `## MVP 4: Awareness and Reporting`

Scope:

- Mobile-first due-work dashboard and notification center.
- Per-member email preferences, due transitions, weekly digests, and
  meter-reading reminders.
- Workspace-only asset, component, history, cost, evidence, and compliance
  reports.

Boundary and sequencing decision: awareness and reports are layered on the due
work and execution history from MVP 2 and MVP 3. Report access is explicitly
workspace-only at this milestone.

### Exact heading: `## MVP 5: Offline Resilience`

Scope:

- Recent and pinned offline asset trees.
- Offline job drafts, meter readings, attachments, and replacement proposals.
- Foreground automatic synchronization, outbox controls, idempotency, and
  `needs_review` conflict handling.

Boundary and sequencing decision: offline support is scoped to selected asset
trees and named field workflows, with foreground synchronization and explicit
conflict review; stronger background synchronization remains later scope.

### Exact heading: `## MVP 6: Production Readiness`

Scope:

- Portable production Docker Compose packaging, observability, health checks,
  and tested backup/restore runbooks.
- Release checks and an AWS ECS/Fargate reference deployment.

Boundary and sequencing decision: production packaging, operational readiness,
and the reference deployment close the coherent MVP after product capabilities
and offline resilience.

### Exact heading: `## Later`

Explicitly outside the coherent MVP 0-6 boundary:

- Granular workspace roles and permissions.
- Public/private schedule catalogs, imports, and sharing.
- QR codes, CSV export, PDF reports, and buyer-facing report sharing.
- Parts inventory, purchasing, procurement, and accounting integrations.
- Push notifications, installable PWA support, and stronger background sync.
- Advanced facility locations, maps, capacity, and geofencing.
- Sensor integrations, adaptive-maintenance indicators, and prediction.
- React Native client and broader enterprise CMMS workflows.

## Stable identifiers and traceability

- No formal requirement IDs appear in this source.
- Preserve the milestone labels `MVP 0` through `MVP 6` and the `Later` bucket
  as stable source-level scope identifiers; do not manufacture FR IDs as if
  they originated here.
- Canonical PRD requirements derived from this source should retain a source
  citation to the exact heading above so coverage can be audited.

## Dependencies and ordering

- Explicit authority dependency: all milestones must preserve
  `docs/product-requirements.md`.
- Explicit planning dependencies: MVP 0 points to its implementation plan and
  delivery runbook; MVP 1 points to its implementation plan.
- Conservative capability chain implied by milestone order:
  contract/tenancy foundation -> workspace/assets -> schedules/due work -> work
  execution -> awareness/reporting -> offline resilience -> production
  readiness.
- The roadmap does not state that every bullet inside a milestone must ship in
  the listed order.

## Conflicts and missing decisions

No internal contradiction is explicit in this source. Reconciliation should
surface a conflict only if another authoritative source places a listed item in
a different milestone or changes its boundary.

Potential gaps requiring cross-source confirmation, not assumptions:

- Whether “one coherent MVP” means public release is withheld until MVP 6 or
  whether independently useful milestones may be released earlier.
- Acceptance criteria and completion gates for each milestone are not defined.
- Ordering within each milestone is not defined.
- Ownership, dates, estimates, and release cadence are not defined.
- The boundary between MVP 3 component lifecycle reporting and MVP 4 broader
  reporting needs wording alignment in the canonical PRD, though the listed
  scopes are not inherently inconsistent.
- “Ready for” row-level security in MVP 0 does not say when row-level security
  itself becomes required.
- Offline retention limits, pinning limits, attachment limits, sync retry
  policy, and `needs_review` resolution rules are not specified here.
- The roadmap names an AWS reference deployment but does not state whether AWS
  hosting is normative or illustrative.
