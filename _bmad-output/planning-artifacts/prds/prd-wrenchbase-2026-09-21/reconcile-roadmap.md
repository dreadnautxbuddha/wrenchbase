# Reconciliation: `docs/roadmap.md`

## Verdict

The roadmap's product scope, milestone order, MVP boundary, and Later boundary
are substantively covered by `prd.md`. Contract and delivery details are mostly
preserved in `addendum.md`. Two implementation-trace details are only partial:
the roadmap's explicit MVP 0 delivery-runbook relationship, and two named
engineering standards inside MVP 0. One Later item is semantically covered but
uses narrower wording that should be aligned before source retirement.

Status meanings:

- **Covered** — the complete source meaning is represented in the PRD and/or
  addendum.
- **Partial** — the core outcome is present, but a source detail or boundary is
  not explicitly retained.
- **Missing** — no destination statement preserves the source meaning.

## Exact source-heading coverage

| Exact source heading | Status | Destination coverage | Reconciliation notes |
|---|---|---|---|
| `# Roadmap` | Partial | `prd.md` §0 **Document Purpose and Authority**; §6 **MVP Scope and Delivery Milestones**; OQ-5; A-1. `addendum.md` §2 **MVP 0 Contract and Delivery Context**, §4 **Delivery Sequencing Retained from the Inputs**, §6 **Detailed Extraction Records**. | The coherent MVP 0–6 interpretation, independently useful milestones, dependency order, and continuing source authority are explicit. The MVP 0 and MVP 1 plans are represented through their retained contract/sequence context and extraction records. The roadmap's instruction to execute MVP 0 through bounded packages in `docs/mvp-0-delivery-runbook.md` is not explicitly preserved in the addendum. |
| `## MVP 0: Delivery and Contract Foundation` | Partial | `prd.md` FR-1–FR-5, FR-34–FR-38; NFR-1–NFR-3, NFR-5; §6 **MVP 0**. `addendum.md` §2 and §5. | Identity, onboarding, switching, capability tenancy, versioned API, semantic errors, cursor pagination, concurrency, idempotency, PostgreSQL tenancy, auditing, restricted runtime role, mobile navigation, accessibility, complete states, CI, and real-stack verification are covered. Strict PHP/TypeScript and dependency checks are retained, but the exact 120-character source-line rule and documented class-property-type rule are absent from the addendum. |
| `## MVP 1: Workspace and Asset Foundation` | Covered | `prd.md` FR-3–FR-16; §6 **MVP 1**; UJ-1, UJ-2, UJ-5. `addendum.md` §3 and §4 **MVP 1 sequence**. | Owner invitations/member administration, expanded settings, Sites/Locations, versioned types, typed attributes, Meters, Component Roles, concrete Assets, recursive Installation history, placement/movement, lifecycle, trash/restore, and the linked internal sequence are all represented. |
| `## MVP 2: Schedules and Due Work` | Covered | `prd.md` FR-11, FR-17–FR-20; §6 **MVP 2**; UJ-3. | Schedule alternatives/citations, all named Trigger families, rolling/anchored recurrence, initial phase, overrides, adoption diffs, Meter Readings, inherited usage, Baselines, Due Work, and unknown history are explicit. |
| `## MVP 3: Work Execution` | Covered | `prd.md` FR-21–FR-28, FR-31; §6 **MVP 3**; UJ-4 and UJ-5. | Job lifecycle, amendment/void, targeted Work Items, partial completion, assignment, Requirement fulfillment, ad-hoc work, Maintainers, place, cost, Evidence/attachments, inspection outcomes, Maintenance Needs, private authorized Evidence, atomic replacement, and lifecycle reporting are represented. |
| `## MVP 4: Awareness and Reporting` | Covered | `prd.md` FR-29–FR-31; §6 **MVP 4**; UJ-7. | Mobile-first dashboard/notification center, per-Member preferences, due transitions, digest, Meter reminders, and Workspace-only Asset/Component/history/cost/Evidence/compliance reports are explicit. |
| `## MVP 5: Offline Resilience` | Covered | `prd.md` FR-32–FR-33; §6 **MVP 5**; UJ-6; NFR-5. | Recent/pinned trees, offline Job drafts, Meter Readings, attachments, replacement proposals, foreground/reconnect sync, manual retry/outbox-equivalent controls, idempotency, and `needs_review` conflict handling are covered. The explicit non-promise of closed-browser synchronization preserves the foreground boundary. |
| `## MVP 6: Production Readiness` | Covered | `prd.md` FR-38; §6 **MVP 6**. | Portable packaging, observability, health checks, release checks, tested backup/restore, and AWS ECS/Fargate as a non-mandatory reference deployment are explicit. |
| `## Later` | Partial | `prd.md` §7 **Non-Goals for the MVP**; NFR-7; FR-31 and FR-33 boundary statements. | Every Later category is outside MVP. One wording mismatch remains: the source defers **public and private** schedule catalogs, imports, and sharing, while §7 says “public or shared” catalogs and imports and does not explicitly name private catalogs or schedule sharing. This is probably equivalent intent, but exact retirement-safe traceability is partial. |

## Milestone boundary verification

### Overall MVP boundary

- **Covered:** `prd.md` §6 states that “first version” and “MVP” mean the
  coherent capability set delivered through MVP 0–6.
- **Covered:** §6 states that each milestone remains independently useful and
  that order is a dependency sequence.
- **Open, not conflicting:** OQ-5 correctly preserves the roadmap's missing
  release decision: it does not infer whether public release waits for MVP 6.

### MVP 0 boundary

- **Included:** identity, Workspace onboarding/switching, tenancy/API
  foundations, quality shell, mobile browser foundation, and verification.
- **Excluded at this milestone:** Assets, schedules, Jobs, attachments,
  offline synchronization, maintenance email, and production hardening are
  explicitly stated in `prd.md` §6.
- **Trace gap:** the bounded-package execution role of the MVP 0 delivery
  runbook is not retained in `addendum.md`.

### MVP 1 boundary

- **Included:** membership, places, types, concrete Assets, Installations,
  placement/lifecycle, and Asset Type Reconciliation.
- **Excluded at this milestone:** Meter Readings, schedules, Due Work, Jobs,
  attachments, reports, maintenance email preferences, and offline authoring
  are explicit in `prd.md` §6.

### MVP 2 boundary

- **Included:** schedule and Requirement authoring, all Trigger types,
  recurrence, adoption, Baselines, readings/usage, Due Work, and uncertainty.
- **Sequencing preserved:** these capabilities follow the MVP 1 Asset/Type/
  Meter foundations and precede Job execution.

### MVP 3 boundary

- **Included:** execution records, partial/ad-hoc work, people/place/cost,
  private Evidence, inspections/follow-up Needs, replacement, and Component
  reporting.
- **Boundary preserved:** manual install/detach from MVP 1 remains lifecycle
  history; purpose-specific job replacement begins here (FR-14, FR-28).

### MVP 4 boundary

- **Included:** dashboard, notification center, email preferences/delivery,
  digest/reminders, and Workspace-only reports.
- **Boundary preserved:** public/buyer-facing reporting and export remain Later
  under §7.

### MVP 5 boundary

- **Included:** bounded offline read/draft workflows and foreground
  synchronization with explicit review.
- **Boundary preserved:** stronger/closed-browser background sync remains Later
  under §7 and FR-33.

### MVP 6 boundary

- **Included:** production packaging, operations, recovery, release checks,
  and reference deployment.
- **Boundary preserved:** AWS is explicitly illustrative, not mandatory
  hosting (FR-38).

## `Later` item verification

| Roadmap Later item | Status | Destination |
|---|---|---|
| Granular Workspace roles and permissions | Covered | `prd.md` §7: “Enterprise CMMS breadth or granular custom roles and permissions”; FR-4 preserves extensibility only. |
| Public and private schedule catalogs, imports, and sharing | Partial | `prd.md` §7: “Public or shared Maintenance Schedule catalogs and imports.” Private catalogs and schedule sharing are not named exactly. |
| QR codes, CSV export, PDF reports, and buyer-facing report sharing | Covered | `prd.md` §7 and FR-31. |
| Parts inventory, purchasing, procurement, and accounting integrations | Covered | `prd.md` §7. |
| Push notifications, installable PWA support, and stronger background sync | Covered | `prd.md` §7; FR-33 states the foreground-only boundary. |
| Advanced facility locations, maps, capacity, and geofencing | Covered | `prd.md` §7: advanced facility maps, capacity management, floor plans, and geofencing; advanced location behavior is excluded by the same facility-scope boundary. |
| Sensor integrations, adaptive maintenance indicators, and prediction | Covered | `prd.md` §7. |
| React Native client and broader enterprise CMMS workflows | Covered | `prd.md` §7 and NFR-7; FR-36 only keeps the API client-neutral. |

## Genuine gaps and conflicts

### Gaps

1. **MVP 0 delivery-runbook relationship is not retained.** The roadmap says
   MVP 0 is executed through bounded packages in
   `docs/mvp-0-delivery-runbook.md`; neither `prd.md` nor `addendum.md` records
   that handoff. This belongs in addendum/trace context, not as a product FR.
2. **Two roadmap-named MVP 0 engineering rules are absent.** The addendum
   preserves strict PHP/TypeScript checks and dependency checks but not the
   120-character source-line limit or documented class-property types. These
   are implementation standards and should be retained only if still intended.
3. **Schedule catalog Later wording is incomplete.** `prd.md` §7 does not
   explicitly preserve private catalogs or sharing. Aligning the wording with
   the roadmap would remove ambiguity before deleting the source.

### Conflicts

No genuine roadmap-versus-PRD/addendum product conflict was found. The PRD's
interpretation that MVP means MVP 0–6 matches the roadmap and is transparently
logged as A-1. OQ-5 correctly preserves the unresolved public-release policy
rather than inventing one.
