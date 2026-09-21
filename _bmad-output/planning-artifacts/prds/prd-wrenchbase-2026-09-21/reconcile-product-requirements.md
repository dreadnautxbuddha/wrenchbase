# Input Reconciliation: `docs/product-requirements.md`

## Reconciliation Verdict

**Partial, with strong coverage.** The draft PRD preserves the source's purpose,
controlled vocabulary, major invariants, all ten acceptance scenarios, and every
MVP non-goal. Four source details need explicit resolution before the PRD can be
declared fully reconciled: Site-address cardinality, Asset Type Meter
cardinality, attribute help text, and the initial maintenance-email subscription
for a Workspace owner. Two lower-severity examples/alternatives are summarized
rather than carried explicitly.

Reconciled destinations:

- `_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/prd.md`
- `_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/addendum.md`

Status meanings:

- **Covered** — the source meaning and material detail are present.
- **Partial** — the main capability is present, but at least one source detail is
  missing, weakened, or contradicted.
- **Missing** — the source capability has no meaningful destination coverage.

## Exact Source-Heading Coverage

### `# Product Requirements` — Covered

- The source's role as the product-behavior baseline is represented by PRD §0,
  **Document Purpose and Authority**.
- PRD §0 explicitly says the source documents remain authoritative during this
  reconciliation checkpoint and that newly assigned `FR-*`, `NFR-*`, `UJ-*`,
  and `SM-*` identifiers did not exist in the sources.
- No source requirement IDs were available to preserve; none were silently
  renumbered or represented as pre-existing.

### `## Status and Authority` — Covered

Destination coverage:

- PRD §0 states that the draft consolidates the vision, product requirements,
  roadmap, and implementation plans without changing their authority before
  approval.
- Addendum introduction preserves the authority of focused technical documents,
  including `docs/architecture.md`, for their own subject matter.
- PRD §6 retains the roadmap's sequencing role through MVP 0–6.

No accidental omission found. The post-approval authority transition is made
explicit in PRD §0 rather than being silently assumed.

### `## Product Purpose` — Covered

Destination coverage:

- PRD §1, **Vision**, preserves the central workflow: translate manuals or
  experience into schedules, record actual work, and expose what needs attention.
- PRD §2.1, **Target Users**, includes individuals, hobbyists, small garages,
  workshops, businesses, and small trusted teams managing vehicles, equipment,
  tools, appliances, and nested components.
- PRD §2.1 and §7 preserve the boundary against customer management,
  customer-owned fleet workflows, booking, billing, and enterprise-CMMS breadth.
- The owner/operator rather than customer-service posture is repeated in PRD
  §2.1 and Jobs To Be Done in §2.2.

### `## Product Vocabulary` — Covered

Destination coverage:

| Source term/rule | Destination |
|---|---|
| Workspace | PRD §3 **Workspace**; FR-2; FR-4 |
| Site | PRD §3 **Site**; FR-6 |
| Location | PRD §3 **Location**; FR-7; FR-8 |
| Asset Type | PRD §3 **Asset Type**; FR-9 |
| Asset | PRD §3 **Asset**; FR-13 |
| Component Role | PRD §3 **Component Role**; FR-12 |
| Installation | PRD §3 **Installation**; FR-14; FR-28 |
| Meter and Reading | PRD §3 **Meter**; FR-11 |
| Maintenance Schedule | PRD §3 **Maintenance Schedule**; FR-17 |
| Requirement | PRD §3 **Requirement**; FR-18 |
| Job and Work Item | PRD §3 **Job**, **Work Item**; FR-21–FR-23 |
| Maintenance Need | PRD §3 **Maintenance Need**; FR-27 |
| Maintainer | PRD §3 **Maintainer**; FR-25; FR-31 |

Controlled-vocabulary verification:

- The required phrase **Maintenance Schedule** is used consistently.
- The prohibition on “maintenance plan” as a synonym is explicit in PRD §3.
- Literal source states and annotations are preserved: `owner`, `member`,
  `draft`, `planned`, `active`, `closed`, `upcoming`, `due_soon`, `due`,
  `overdue`, `history_unknown`, `reading_needed`, `planned`, and
  `needs_review`.
- Capitalization in the PRD is editorial terminology normalization, not a change
  in meaning.

No vocabulary item is missing.

### `## Workspace, Members, and Settings` — Partial

Covered:

- Workspace ownership, multiple Memberships, Workspace switching, and explicit
  route/API context: PRD §3, FR-2, and FR-4.
- Cross-Workspace isolation and concealed lookup: FR-4, NFR-3, SM-2.
- OpenID Connect authentication and first-sign-in choices: FR-1.
- No automatic personal Workspace, directory, or self-service join requests:
  FR-1.
- Email invitations, single use, expiration, verified-email acceptance,
  revocation, resend, `member` grant, and tenure preservation: FR-3.
- Ownership transfer and last-owner invariant: FR-3.
- `owner`/`member` behavior and Capability-based authorization: FR-4 and
  addendum §3 **Capability strings**.
- Workspace name, photo/logo, locale, currency, unit preferences, due-soon and
  Meter-reading defaults, Sites, and Members: FR-5.
- Mandatory security/account messages: FR-5 and FR-30.

Partial detail:

- The source says the Workspace owner starts subscribed to maintenance email
  and may unsubscribe. FR-30 makes the weekly digest enabled by default and
  maintenance email controllable, but it never explicitly states that the
  initial Workspace owner is subscribed to maintenance email. OQ-2 addresses
  invited non-owner defaults only. This is an accidental omission, not an open
  question in the source.

### `## Sites, Locations, and Asset Placement` — Partial

Covered:

- Site timezone and physical-place model: PRD §3 **Site** and FR-6.
- Arbitrarily deep, ordered, acyclic Location trees within one Site: FR-7.
- Archiving and derived display paths: FR-7.
- Deferred capacity, map, floor-plan, and geofence features: PRD §7.
- Exactly one placement for every active Asset, either a direct Location or one
  parent Installation: FR-8.
- Host-derived Site/Location for installed descendants: FR-8.
- Atomic transition history with no overlap, plus no locationless active Asset:
  FR-8 and FR-14.
- The detached-child outcome invariant is enforced through FR-8's singular
  active placement plus FR-14/FR-15/FR-28 transition behavior.
- Dated movement and Installation history: FR-8, FR-14, FR-37.
- Location-versus-Asset distinction: PRD §3 **Location**, **Asset**, and
  **Component**.

Conflict requiring resolution:

- The source defines a Site as a place “with an address” and says a Site owns
  its address. FR-6 makes the structured postal address optional. If the source
  intended address to be required, FR-6 weakens the contract. The canonical PRD
  must either require an address or record the interpretation that a Site owns
  an address value when supplied but does not require one.

### `## Asset Types and Asset Lifecycles` — Partial

Covered:

- Versioned typed attributes, required/default behavior, all source value
  families, and stable accepted values: FR-9 and FR-10.
- Multiple typed Meters as a capability: FR-11.
- Component Role cardinality and compatibility: FR-12.
- Named Maintenance Schedule alternatives: FR-17.
- No Asset Type inheritance and Component-Role-only relationships: FR-12 and
  PRD §7.
- Arbitrary concrete hierarchy depth with cycle prevention: FR-12 and FR-14.
- Automatic creation for unambiguous required Component Roles and explicit
  resolution for ambiguous Roles: FR-12 and FR-13.
- Ad-hoc typed Components and later explicit mapping to a new Role: FR-12.
- Immutable published revisions and explicit Reconciliation without silent
  Component gain/loss: FR-9 and FR-16.
- Archive-instead-of-delete for used types: FR-9.
- Active, retired, disposed, and restorable-trash lifecycle; Due Work pause;
  subtree history; no hard deletion: FR-15, FR-20, NFR-4.
- Consumables/materials versus child-Asset identity: PRD §3 **Component** and
  FR-23.

Missing or conflicting details:

1. The source says typed attributes can include help text. FR-10 carries type,
   required/default, validation, units, and stable identity, but does not carry
   help text at all. This is an accidental omission.
2. The source says an Asset Type Revision defines “one or more typed meters.”
   FR-11 says Asset Types “can define multiple” Meters and therefore does not
   state a minimum of one. Decide whether meterless Asset Types are valid. If
   they are, the source must be explicitly reconciled rather than silently
   weakened; if not, FR-11 needs the minimum-cardinality rule.

### `## Meters, Time, and Baselines` — Covered

Destination coverage:

- Multiple typed Meters, independent and work-time readings, correction
  history, inherited compatible host usage, starting usage, self-managed
  Meters, and no double counting: FR-11.
- Instants in UTC, calendar facts as dates, calendar recurrence in the Asset
  Site's timezone, and canonical measurement behavior: FR-25 and NFR-6.
- Completed Job place/timezone snapshot and viewer-local presentation while
  retaining site-local context: FR-25 and NFR-4.
- No fictional completion for unknown history; known-evidence, perform-now, and
  unknown-history Baseline choices: FR-19.
- Future scheduling while retaining `history_unknown`: FR-19 and FR-20.

No accidental omission found.

### `## Maintenance Schedules and Due Work` — Partial

Covered:

- Named alternatives, one active base schedule, explicit additions/disables/
  overrides, independent Component schedules, and non-duplicating roll-up:
  FR-17.
- Immutable published revisions and atomic Reconciliation: FR-17.
- Stable Requirement identity/completion history, new Requirement Baselines,
  removed Requirement behavior, and retained Asset overrides: FR-17 and FR-19.
- All schedule-source metadata, including optional manual attachment: FR-17.
- Standard action category, custom title/instructions, and one-or-more typed
  Triggers: FR-18.
- Every source Trigger family, rolling/anchored recurrence, initial phases, and
  `first_reached`/`all_reached` policy: FR-18.
- Typed/extensible Trigger model and no generic expression language: FR-18,
  NFR-7, and PRD §7.
- All primary Due Work states, Workspace/Requirement due-soon thresholds,
  immediate overdue behavior, separate data-quality flags, and the `planned`
  annotation: FR-20 and FR-22.
- Stale-Meter behavior, continued time calculation, effective work-time Meter
  Reading, and immediate projection of the next occurrence: FR-20.

Partial detail:

- FR-18 preserves “standard action category” but drops the source examples
  `inspect`, `clean`, `adjust`, `lubricate`, `replace`, and `service`. Because
  the source says “such as,” this is not an exhaustive enum conflict, but the
  canonical PRD currently loses the only concrete category vocabulary supplied
  by the authoritative source.

### `## Jobs, Work Items, and Maintenance Needs` — Covered

Destination coverage:

- Job states, planned/actual ranges, assignment and Work Item override, local
  completion date/time, pre-closure cancellation, and status separation:
  FR-21.
- The source's incomplete cancellation semantics are preserved transparently
  as OQ-1 rather than silently invented.
- Auditable amendments and void-with-reason for closed Jobs: FR-24 and NFR-4.
- Targeted ad-hoc/mapped Work Items; only completed mapped work resets
  Requirements; deferral remains due; carry-forward or Maintenance Need:
  FR-22 and FR-23.
- On-site ad-hoc work with target Asset, materials, Evidence, cost allocation,
  and inspection outcome: FR-23.
- Ad-hoc history is non-fulfilling by default and requires explicit mapping:
  FR-23.
- Site/Location default, Maintainer/custom place, completion snapshot,
  external people/organizations, Members, roles, and affiliation: FR-25.
- Single Job total, allocations without double counting, snapshotted currency,
  and Evidence attachment scopes: FR-26.
- Inspection-created one-off Maintenance Needs, targets, later-work resolution,
  void reason, and no automatic recurring conversion: FR-27.
- Atomic replacement, used-Asset history, removed-Component disposition, and
  parent lifecycle reporting: FR-28 and FR-31.

Lower-severity compression:

- The source explicitly says a later correction **or on-site discovery** after
  closure is recorded through an amendment **or a new Job**. FR-23 says closed
  Jobs are not edited to add discoveries, and FR-24 specifies amendment/void,
  but does not expressly repeat “new Job” as the discovery alternative. The
  ability to create Jobs makes this inferable, but an exact acceptance test
  would benefit from retaining the phrase.

This compression does not change the heading's overall status because the
closed-Job immutability and valid corrective path remain fully specified.

### `## Notifications and Reports` — Covered

Destination coverage:

- Notification center and dashboard authority for Due Work, Meter-reading
  reminders, assignments, and sync problems: FR-29.
- Per-Member optional maintenance-email control: FR-30.
- Immediate due-state transition alerts and weekly unresolved-work digest,
  enabled by default and configurable/disableable: FR-30.
- Workspace-only reports covering identity, configuration, Component/Location
  lifecycle, service timeline, schedule compliance, Due Work, costs,
  Maintainers, and Evidence: FR-31.
- Public links, buyer-facing reports, PDF, and CSV exports excluded: FR-31 and
  PRD §7.

The initial-owner subscription omission belongs to `## Workspace, Members, and
Settings` because that is where the source defines it; otherwise this heading
is fully covered.

### `## Offline Behavior` — Covered

Destination coverage:

- Recent and pinned Asset-tree caching for offline reading and Job drafting,
  on-demand large attachments, cached-type-only Asset creation, and online-only
  Asset Type/Schedule authoring: FR-32.
- Offline Meter Readings, attachments, Work Items, and replacement proposals:
  FR-32.
- Durable local drafts with client IDs: FR-32.
- Synchronization on reconnect/open/foreground/online save plus **Sync now** and
  **Retry**: FR-33.
- No closed-browser synchronization promise: FR-33 and PRD §7.
- Shared server draft on first upload and author-only editing until handoff:
  FR-33.
- Upload-before-atomic-publication behavior for locally completed Jobs: FR-33.
- Retryable transient failures, `needs_review` semantic conflicts, preservation
  of draft and Evidence, explicit resolution choices, and no guessing: FR-33.
- Duplicate-Job prevention on repeated synchronization: FR-33 and FR-35.

No accidental omission found. The PRD's phrase “marks it ready for completion”
in UJ-6 and “locally completed Job” in FR-33 avoids inventing a new persisted
Job status while OQ-1 remains separate.

### `## MVP Acceptance Scenarios` — Covered

All ten source scenarios appear, in the same order and with the same outcome,
in PRD §8.1. Detailed traceability:

| # | Source outcome | Canonical destination |
|---|---|---|
| 1 | Owner invitation, Sites/Locations, shared maintenance, owner-only Membership | §8.1 #1; FR-3–FR-7 |
| 2 | Multi-Workspace switching and isolation; create or accept invite | §8.1 #2; FR-1, FR-2, FR-4 |
| 3 | `2024 Yamaha NMAX`, recursive CVT, required Components | §8.1 #3; FR-9–FR-13 |
| 4 | 35,000 km unknown brake-fluid Baseline; next 10,000 km without fictional history | §8.1 #4; FR-11, FR-19, FR-20 |
| 5 | 25,000 km oil change projects 30,000 km; deferred CVT work remains due/planned | §8.1 #5; FR-11, FR-20–FR-22 |
| 6 | Closed Job carries unfinished work without resetting Requirements | §8.1 #6; FR-21, FR-22 |
| 7 | Unplanned repair stays ad hoc unless explicitly linked | §8.1 #7; FR-23 |
| 8 | Engine replacement preserves old/new lifecycle and parent report | §8.1 #8; FR-14, FR-15, FR-28, FR-31 |
| 9 | Three-month Trigger revision retains completion and recalculates earliest due | §8.1 #9; FR-17–FR-20 |
| 10 | Offline upload and reviewable replacement conflict preserve photos/receipts | §8.1 #10; FR-28, FR-32, FR-33 |

Verification result: **10/10 covered; 0 missing; 0 materially changed.**

### `## Non-Goals` — Covered

Every source non-goal appears in PRD §7, sometimes grouped with adjacent terms:

| Source non-goal | Canonical destination |
|---|---|
| Customer management | §7 customer accounts/customer-owned fleet management; §2.1 |
| Bookings | §7 booking |
| Billing | §7 billing |
| Procurement | §7 procurement/purchasing |
| Inventory management | §7 parts inventory |
| Accounting integrations | §7 accounting integrations |
| Public schedule catalogs | §7 public/shared Maintenance Schedule catalogs and imports |
| Asset Type inheritance | §7 Asset Type inheritance |
| Arbitrary rule formulas | §7 arbitrary Trigger formulas; FR-18 |
| Sensor-driven maintenance prediction | §7 sensor integrations/adaptive indicators/prediction |
| Advanced facility modeling | §7 maps/capacity/floor plans/geofencing |
| Granular custom roles | §7 granular custom roles and permissions |
| Public report links | §7 public report links |
| PDF export | §7 PDF reports |
| CSV export | §7 CSV export |
| Web push | §7 web push notifications |
| Guaranteed closed-browser background sync | §7 guaranteed background synchronization while browser closed |

Verification result: **16/16 source exclusions covered; 0 missing.** The PRD
also adds sourced non-goals from other inputs (QR codes, installable PWA
packaging, and a React Native client in the first version); those additions do
not conflict with this source.

## Detailed Product-Rule Audit

### Historical meaning and immutability — Covered

- Published Asset Type and Schedule revisions remain immutable: FR-9, FR-17.
- Reconciliation is explicit and atomic: FR-16, FR-17, FR-35.
- Completion, placement, Installation, lifecycle, place, timezone, currency,
  cost, and Evidence history remain explainable: FR-8, FR-15, FR-24–FR-28,
  FR-31, FR-37, NFR-4.
- Domain records and Evidence are not hard-deleted in MVP: FR-15.

### Due-work honesty — Covered

- Planning does not clear Due Work; only completed mapped Work Items do: FR-20,
  FR-22.
- Unknown history is never turned into fictional completion: FR-19.
- Stale readings never imply safety, while time-based rules continue: FR-20.
- Retirement/disposal/inactive retained hosts pause future calculations and
  reminders without erasing history: FR-20.

### Atomicity and recovery — Covered

- Component replacement and disposition: FR-28.
- Asset creation, placement, and required Components: FR-13.
- Asset/Schedule Reconciliation: FR-16, FR-17.
- Offline Job publication: FR-33.
- Retry-safe multi-record commands: FR-35 and NFR-5.

### Role and authorization semantics — Covered with one default gap

- Named Capabilities, owner/member behavior, and client consumption: FR-4;
  addendum §3.
- Workspace isolation and not-found concealment: FR-4 and NFR-3.
- Owner email initial-subscription behavior is the only missing role-adjacent
  rule from this source.

## Genuine Gaps, Conflicts, and Accidental Omissions

### Must resolve before final approval

1. **Site address cardinality conflict.** The source describes every Site as
   having/owning an address; FR-6 makes address optional. Resolve the intended
   product contract explicitly.
2. **Meter minimum conflict/omission.** The source says every Asset Type Revision
   defines one or more typed Meters; FR-11 allows multiple but does not require
   one. Decide whether meterless types are valid.
3. **Attribute help text omitted.** The source permits help text on typed fields;
   FR-10 does not preserve that capability.
4. **Initial owner maintenance-email subscription omitted.** The source sets the
   Workspace owner subscribed by default with opt-out; FR-30 only states the
   weekly-digest default and leaves invited-Member defaults open.

### Should retain or explicitly accept as compression

5. **Action category examples omitted.** FR-18 preserves the standard category
   concept but not the source vocabulary examples `inspect`, `clean`, `adjust`,
   `lubricate`, `replace`, and `service`.
6. **Closed-Job discovery alternative compressed.** FR-23/FR-24 preserve
   immutability and amendments but do not explicitly state that a new Job is an
   allowed way to record a post-closure on-site discovery.

### Source gaps correctly surfaced, not reconciliation failures

- OQ-1 correctly preserves the source's unresolved Job-cancellation semantics.
- OQ-2 correctly preserves the unspecified email defaults for invited
  non-owner Members; it does not cover the source's already-set owner default.
- OQ-3 and OQ-4 transparently record underspecified trash and Maintenance Need
  behavior.

## Final Counts

- Exact source headings reconciled: **14/14**, including the document title.
- Heading status: **10 Covered, 4 Partial, 0 Missing**.
- Source acceptance scenarios: **10/10 Covered**.
- Source non-goals: **16/16 Covered**.
- Controlled source vocabulary terms: **15/15 Covered**, plus the prohibited
  “maintenance plan” synonym rule.
- Stable source requirement IDs: **0 found; 0 changed**.
- Must-resolve source discrepancies: **4**.
- Lower-severity explicit-detail compressions: **2**.
