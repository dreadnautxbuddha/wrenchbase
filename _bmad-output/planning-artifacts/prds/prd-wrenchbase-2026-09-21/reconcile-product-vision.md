# Reconciliation: `docs/product-vision.md`

Compared against:

- `prd.md`
- `addendum.md`

Status meanings: **covered** means the source heading's normative meaning is
represented; **partial** means at least one source idea is absent or materially
changed; **missing** means the heading has no substantive destination.

## Exact source-heading coverage

| Exact source heading | Status | Primary destination sections and IDs |
|---|---|---|
| `# Product Vision` | **covered** | PRD §1 **Vision**; §2.2 **Jobs To Be Done**; §9 **Risks and Guardrails**; addendum §1 **Existing Application Boundaries** |
| `## Product Promise` | **covered** | PRD **FR-8–FR-20**, **FR-21–FR-33**, **UJ-2–UJ-7**, glossary §3; addendum §1 |
| `## Principles` | **covered** | PRD §1.1 **Product Principles**; **NFR-1–NFR-7**; **SM-2–SM-6**; §9; addendum §1 |
| `## Audience` | **covered** | PRD §2.1 **Target Users**, §2.2, **FR-1–FR-5**, **FR-25**, §7 |
| `## Scope` | **covered** | PRD **FR-1–FR-33**, §6 **MVP Scope and Delivery Milestones**, **UJ-1–UJ-7**; addendum §§2–4 |
| `## Non-Goals For The First Version` | **partial** | PRD §7 **Non-Goals for the MVP**, **FR-18**, **FR-31**, **FR-33**, **NFR-7** |

No exact source heading is wholly missing.

## `# Product Vision` — covered

### What carried forward

- The core definition—mobile-first recurring maintenance for physical
  assets—is explicit in PRD §1.
- The originating loop of following guidance, recording actual work, and
  knowing what needs attention next is retained in PRD §1 and §2.2.
- The cross-category model for vehicles, equipment, tools, appliances, and
  recursively nested Components is retained in PRD §1, **FR-9–FR-16**, and
  **UJ-2**.
- The position between narrow vehicle trackers and heavyweight enterprise
  maintenance systems is explicit in PRD §1 and protected by **NFR-7** and the
  first risk in §9.
- The need to combine detailed modelling with approachability is carried into
  PRD §1, **NFR-7**, **SM-C3**, and §9.

### Dropped or altered qualitative material

- The emotional phrase “keeping a loved scooter or car properly maintained” is
  compressed into a more neutral owner-maintenance statement. The underlying
  job is preserved, but the personal-care tone is weaker.
- The detailed example “NMAX engine, CVT, flyball set, and upgrades” is reduced
  in PRD §1 to broad categories. **UJ-2** and acceptance scenario 3 restore the
  NMAX/CVT example, but the flyball-set example is absent.
- “Gaming chair” is generalized to “chair” in PRD §1. This does not change
  scope but slightly reduces the source's deliberately eclectic product voice.
- “Upgrades” remains prose in PRD §1 but is not defined as a distinct glossary
  term or behavior. The PRD appears to model an upgrade through Asset,
  Component, Installation, replacement, and history requirements instead.

These are qualitative compressions or modelling normalization, not missing
core scope. No vision statement is preserved only in the addendum.

## `## Product Promise` — covered

### Promise-to-destination trace

- Reusable asset blueprints map to **Asset Type** and **Asset Type Revision** in
  glossary §3 and **FR-9–FR-13**.
- Manufacturer or custom schedules map to **FR-17** (named, sourced Schedule
  alternatives), **FR-18** (typed Requirements and Triggers), and the
  manual-led principle in §1.1.
- Concrete assets, Components, Locations, and usage map to **FR-6–FR-16** and
  **FR-11**. “Upgrades” is subsumed by Component/Installation/lifecycle
  behavior rather than retained as a separate concept.
- Planned and completed maintenance, repair, inspection, replacement,
  Maintainers, costs, photos, receipts, and documents map to **FR-21–FR-28**,
  particularly **FR-23**, **FR-25**, **FR-26**, and **FR-28**. The glossary's
  **Evidence** definition includes documents and other files.
- Installed, removed, replaced, moved, retired, and disposed lifecycle meaning
  maps to **FR-8**, **FR-14**, **FR-15**, **FR-28**, **FR-31**, and **UJ-5**.
  The PRD normalizes “removed” to detachment or the removed Component's required
  disposition rather than treating it as a lifecycle state.
- Due-work visibility maps to **FR-19**, **FR-20**, **FR-29**, **UJ-3**, and
  **UJ-7**.

### Terminology alteration

The source presents six apparent states: `upcoming`, `due soon`, `due`,
`overdue`, `unknown`, and `waiting for a fresh meter reading`. The PRD makes a
more precise multi-dimensional contract in **FR-20**:

- primary states: `upcoming`, `due_soon`, `due`, `overdue`;
- data-quality flags: `history_unknown`, `reading_needed`; and
- a separate `planned` annotation.

This alters the source's surface vocabulary but preserves—and strengthens—its
meaning by preventing uncertainty from being collapsed into an urgency state.
**SM-6** and §9 make that behavior testable. The source phrase “waiting for a
fresh meter reading” is represented as `reading_needed`, not retained verbatim.

## `## Principles` — covered

All seven named principles appear in PRD §1.1 with materially equivalent
wording:

- **Mobile-first** is reinforced by **NFR-1**, **NFR-2**, and **SM-5**.
- **Manual-led** is reinforced by **FR-17–FR-20**.
- **Flexible, not vague** is reinforced by **FR-9–FR-18**, **NFR-7**, and
  addendum §1's relational-domain boundary.
- **History-preserving** is reinforced by **FR-8**, **FR-9**, **FR-15–FR-17**,
  **FR-24**, **FR-28**, **FR-31**, **FR-37**, **NFR-4**, and **SM-3**.
- **Useful before complex** is reinforced by **NFR-7**, **SM-C3**, and §9.
- **Honest about uncertainty** is reinforced by **FR-19**, **FR-20**, **SM-6**,
  and §9.
- **Offline where it matters** is reinforced by **FR-32**, **FR-33**, **UJ-6**,
  **SM-4**, **NFR-5**, and addendum §1.

No principle was dropped or materially reversed. The canonical PRD adds
testable detail without broadening any principle beyond the source boundary.

## `## Audience` — covered

### What carried forward

- All four audience groups appear in PRD §2.1: individual owners, DIY mechanics
  and hobbyists, small garages/workshops/businesses managing their own or
  operated assets, and small trusted Workspace teams.
- PRD §2.1 keeps the first-version boundary that garages do not manage customer
  accounts, customer-owned fleets, bookings, or billing.
- External shops and mechanics remain representable as **Maintainers** through
  glossary §3 and **FR-25**.
- Workspace ownership of the records for Assets it owns or operates is explicit
  in PRD §2.1 and supported by **FR-4**.

### Alterations

- The PRD explicitly adds “customer-owned fleets” to the exclusion. This
  clarifies rather than contradicts the source's no-customer-management rule.
- “Household assets” is expanded in PRD §2.1 to name tools and appliances, which
  are already present in the source's opening vision.

No audience group or garage/customer boundary is missing.

## `## Scope` — covered

Every explicit MVP scope item has a destination:

| Source scope item | Destination |
|---|---|
| shared workspaces | **FR-1–FR-5**, **UJ-1**, MVP 0–1 |
| sites and locations | **FR-6–FR-8**, **UJ-2**, MVP 1 |
| versioned asset types | **FR-9–FR-16**, MVP 1 |
| recursive asset hierarchies | **FR-12–FR-15**, **UJ-2**, MVP 1 |
| typed meters | **FR-11**, **FR-18**, **FR-20**, MVP 1–2 |
| maintenance schedules | **FR-17–FR-20**, MVP 2 |
| due work | **FR-19**, **FR-20**, **FR-29**, MVP 2 and 4 |
| planned and completed jobs | **FR-21–FR-28**, **UJ-4**, MVP 3 |
| component replacement history | **FR-28**, **FR-31**, **UJ-5**, MVP 3–4 |
| evidence | **FR-26**, **FR-32–FR-33**, MVP 3 and 5 |
| notifications | **FR-29–FR-30**, MVP 4 |
| workspace reports | **FR-31**, MVP 4 |
| scoped offline job drafting | **FR-32–FR-33**, **UJ-6**, MVP 5 |

PRD §6 explicitly reconciles “MVP” and “first version” as the coherent MVP 0–6
capability set, recorded as interpretation **A-1**. The detailed behavior that
the source delegates to `docs/product-requirements.md` is represented throughout
**FR-1–FR-38** and the canonical acceptance scenarios.

The addendum preserves technical and delivery boundaries for this scope in §1
and milestone contract/delivery trace in §§2–4; it does not substitute for any
missing product-scope statement.

## `## Non-Goals For The First Version` — partial

### Preserved exclusions

- Customer management, booking, and billing → PRD §7 item 1.
- Procurement, inventory management, and accounting integrations → §7 item 2.
- Enterprise CMMS workflows → §7 item 3 and **NFR-7**.
- Asset Type inheritance and arbitrary rule formulas → §7 item 5 and
  **FR-18**.
- Advanced facility maps, capacity management, and geofencing → §7 item 9.
- Granular custom permissions → §7 item 3.
- Public reports, PDF/CSV export, and web push notifications → §7 items 6–7 and
  **FR-31**.
- Guaranteed background synchronization while the browser is closed → §7 item
  8 and **FR-33**.

### Partial or altered exclusion

- The source excludes “public schedule catalogs or template sharing.” PRD §7
  instead excludes “public or shared Maintenance Schedule catalogs and
  imports.” Public/shared catalogs are covered, but **template sharing is not
  stated explicitly**, and “imports” is newly substituted. If template sharing
  includes direct/private sharing outside a catalog, the PRD text may have
  narrowed the source non-goal.

### Added non-goals

PRD §7 additionally excludes sensor integrations/adaptive prediction, QR codes,
installable PWA packaging, and a first-version React Native client. Those do not
conflict with this source, but they originate elsewhere and should not be
attributed to `docs/product-vision.md`.

## Material gaps and reconciliation findings

1. **Template-sharing exclusion is not exact.** “Template sharing” from the
   source became “catalogs and imports” in PRD §7. Confirm that all schedule
   template sharing—not only catalogs/imports—remains outside the MVP, or amend
   the PRD wording before approval.
2. **Upgrade semantics are implicit.** The source promises tracking “upgrades,”
   while the PRD relies on Asset/Component/Installation/replacement behavior and
   never defines Upgrade. Confirm that this is intentional modelling, not a
   dropped distinct behavior.
3. **Due-state terminology is deliberately changed.** “Unknown” and “waiting
   for a fresh meter reading” are represented as `history_unknown` and
   `reading_needed` flags, not primary states. This is coherent and better
   specified, but should be accepted as a terminology reconciliation.
4. **Some product voice was compressed.** The “loved scooter or car,” flyball
   set, and gaming-chair examples are absent or generalized. No functional
   requirement is lost, but the PRD is less explicit about the personal and
   eclectic character of the product.

Apart from these findings, the vision's audience, scope, non-enterprise
positioning, product principles, lifecycle promise, history preservation,
honest uncertainty, and offline boundary are covered in the canonical PRD and
supported where appropriate by the addendum.
