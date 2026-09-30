# Reconciliation: `docs/mvp-1-implementation-plan.md`

Compared against:

- `prd.md`
- `addendum.md`

Status meanings: **covered** means the source heading's product or durable
contract meaning is represented at the appropriate level; **partial** means a
specific source decision is absent or materially weakened; **missing** means
the heading has no substantive destination. Implementation mechanics and test
inventory may be summarized in the addendum without becoming PRD requirements.

## Exact source-heading coverage

| Exact source heading | Status | Classification | Primary destination sections and IDs |
|---|---|---|---|
| `# MVP 1 Implementation Plan` | **covered** | Authority and delivery context | PRD §0, §6 **MVP 1**; addendum §3 and §4 **MVP 1 sequence** |
| `## Goal and completion criteria` | **covered** | Product behavior and acceptance | PRD **FR-3–FR-16**, **UJ-2**, §6 **MVP 1**, §8.1; addendum §3 **Browser and acceptance context** |
| `## Delivery slices` | **covered** | Implementation trace | Addendum §4 **MVP 1 sequence** and its cross-slice rule |
| `## Authorization capabilities` | **covered** | Public contract and security behavior | PRD **FR-3**, **FR-4**, **FR-36**; addendum §3 **Capability strings** |
| `## Membership and invitations` | **partial** | Product behavior plus delivery contract | PRD **FR-1**, **FR-3–FR-4**, **FR-35**, **FR-37**; addendum §3 **Invitation delivery**, **Capability strings**, **Relational and tenancy enforcement** |
| `## Workspace settings` | **covered** | Product behavior and milestone deferral | PRD **FR-5**, §6 **MVP 1–MVP 4** |
| `## Sites and nested locations` | **partial** | Product behavior | PRD **FR-6–FR-8**, **FR-34**, **FR-37**, **UJ-2**; addendum §3 **Purpose-specific commands**, **Browser and acceptance context** |
| `## Asset types and revisions` | **partial** | Product behavior and contract | PRD **FR-9**, **FR-16**, **FR-34–FR-35**, **FR-37**, **NFR-4**; addendum §1 and §3 |
| `## Typed attributes` | **covered** | Product behavior | PRD **FR-10**, **FR-13**, **FR-16**, **NFR-6** |
| `## Meter definitions` | **covered** | Product behavior and milestone boundary | PRD **FR-11**, **FR-13**, §6 **MVP 1–MVP 2**, **NFR-6** |
| `## Component roles` | **partial** | Product behavior | PRD **FR-12–FR-16**, **UJ-2**; addendum §3 **Relational and tenancy enforcement** |
| `## Concrete assets and configured values` | **partial** | Product behavior | PRD **FR-10**, **FR-13**, **FR-16**, **FR-34–FR-35** |
| `## Placement and installation history` | **covered** | Product behavior and persistence semantics | PRD **FR-8**, **FR-14**, **FR-28**, **FR-37**, **NFR-4**; addendum §3 **Relational and tenancy enforcement** |
| `## Lifecycle and installed subtrees` | **partial** | Product behavior | PRD **FR-15**, **FR-20**, **FR-34–FR-35**, **FR-37**, **UJ-5**; addendum §3 **Browser and acceptance context** |
| `## Asset-type adoption and reconciliation` | **covered** | Product behavior and public contract | PRD **FR-16**, **FR-34–FR-37**, glossary §3; addendum §3 **Purpose-specific commands** and **Browser and acceptance context** |
| `## API contract` | **covered** | Public contract and technical addendum | PRD **FR-34–FR-36**; addendum §2 **API conventions**, §3 **Purpose-specific commands** |
| `## Persistence and tenancy` | **covered** | Technical addendum and security behavior | PRD **FR-4**, **FR-8–FR-16**, **FR-35**, **NFR-3–NFR-5**; addendum §2 **Persistence and tenancy**, §3 **Relational and tenancy enforcement** |
| `## Browser application` | **covered** | Product interaction plus technical addendum | PRD **UJ-1–UJ-2**, **FR-3**, **FR-6–FR-16**, **FR-34**, **NFR-1–NFR-2**; addendum §3 **Browser and acceptance context** |
| `## Testing and CI` | **covered** | Acceptance and implementation trace | PRD **SM-1–SM-5**, §8.1; addendum §3 **Browser and acceptance context**, §5 **Engineering Verification Context** |
| `## Delivery sequence` | **covered** | Implementation trace | Addendum §4 **MVP 1 sequence** and §5 |

No heading is wholly missing. Six headings are partial because individual
source decisions were compressed out, as detailed below.

## `# MVP 1 Implementation Plan` — covered

The source's authority boundary is retained in PRD §0: source requirements
remain authoritative until approval, while implementation/contract material is
preserved in the addendum. The Workspace-and-Asset-foundation purpose maps to
PRD §6 **MVP 1**. Its dependency on MVP 0 is reflected by the milestone order
and addendum §4.

## `## Goal and completion criteria` — covered

The people, places, blueprints, concrete Assets, recursive Components,
placement, lifecycle, type adoption, audit history, two-member collaboration,
and cross-Workspace isolation outcomes are represented by **FR-3–FR-16**,
**FR-37**, **UJ-2**, canonical acceptance scenarios 1–3 and 8, and addendum §3
**Browser and acceptance context**.

The milestone exclusions are preserved in PRD §6 **MVP 1**: Meter Readings,
schedule authoring, Due Work, Jobs, attachments, reports, maintenance email,
and offline authoring occur later. Transactional invitation email remains in
MVP 1 through **FR-3**, **FR-30**, and addendum §3 **Invitation delivery**.
Photo/logo deferral is represented in **FR-5** and the MVP 3 storage dependency.

## `## Delivery slices` — covered

The four broad slices are expanded, not contradicted, by addendum §4's seven-
step **MVP 1 sequence**. Membership precedes Sites, which precede Asset Types,
then Assets, placement, lifecycle, Reconciliation, and end-to-end proof. The
rule that affected API, browser, tests, and audit behavior move together is
preserved immediately after those sequences.

“No empty layers or speculative tables” is not stated verbatim. It is an
implementation-discipline detail rather than product behavior; addendum §3
retains the incremental relational/tenancy posture and §5 retains verification
context.

## `## Authorization capabilities` — covered

- Named capability authorization and the prohibition on role-derived client
  permissions map to **FR-4**.
- Every exact public string is retained in addendum §3 **Capability strings**:
  `workspace.read`, `workspace.update`, `workspace.membership.read`,
  `workspace.membership.manage`, `site.read`, `site.manage`, `assetType.read`,
  `assetType.manage`, `asset.read`, and `asset.manage`.
- Owner/member grants and owner-only Membership management are retained there
  and in **FR-3–FR-4**.
- Authorization before lookup and concealed cross-Workspace `404` behavior map
  to **FR-4**, **NFR-3**, and the MVP 1 golden-path summary in addendum §3.

## `## Membership and invitations` — partial

### Covered product and contract decisions

**FR-3** retains invitation expiry, single use, normalized matching, one pending
invitation per address/Workspace, resend rotation, revocation, verified-email
acceptance, idempotent atomic Membership creation, secret protection,
non-disclosure, ownership transfer, last-owner protection, and historical
tenures. **FR-1** covers sign-in before acceptance. Addendum §3 retains the
purpose-specific mail port, transactional outbox, retryable delivery, and
secret storage. `workspace.membership.read` for both roles and owner-only
management are retained under **Capability strings**.

### Omissions

- The source allows an owner to attach an **optional personal message** to an
  invitation. Neither artifact preserves this user-visible behavior.
- The source retains the **submitted email address separately for display and
  delivery** after normalizing the matching key. The artifacts preserve the
  normalization algorithm but not this dual-value requirement.
- The safe invitation-summary behavior is generalized into non-disclosure in
  **FR-3**; the positive rule that the correctly addressed signed-in user may
  inspect only the minimum summary needed for acceptance is not explicit.

Captured development mail is correctly omitted as replaceable implementation
mechanics. The addendum also intentionally avoids coupling later notification
application logic to invitation delivery.

## `## Workspace settings` — covered

**FR-5** covers name, locale, currency, unit preferences, canonical storage,
and display/input-only conversion. It also preserves the later addition of
due-soon defaults, Meter reminder defaults, email preferences, and photo/logo.
PRD §6 places the dependent capabilities into MVP 2, MVP 3, and MVP 4. No
product-level decision from this heading is lost.

## `## Sites and nested locations` — partial

### Covered product behavior

**FR-6–FR-8** retain Site fields, IANA timezone, structured address behavior,
ordered arbitrary-depth acyclic Location trees, one-Site boundaries, derived
display paths, revision-checked changes, subtree archival restrictions,
restoration rules, Site archival rules, singular Asset placement, inherited
Location, and intelligible historical paths/addresses/timezones. **FR-37**
retains before/after provenance at the appropriate general level.

### Omission

- The source explicitly says **creating a Site does not invent a default
  Location** and that a Member must choose or create a Location before creating
  a directly placed active Asset. **FR-13** requires an initial active Location
  or Installation, but neither artifact explicitly forbids automatic default-
  Location creation. That leaves room for behavior the source ruled out.

The exact Site address field list and Location persistence fields are
appropriately summarized rather than promoted as separate PRD requirements;
their semantics remain represented by **FR-6–FR-7**.

## `## Asset types and revisions` — partial

### Covered product behavior

**FR-9** retains stable Workspace-owned Asset Types, one mutable draft, one
current published revision, permanent immutability after publication, clone-on-
revision, delete-only-never-published/unreferenced behavior, archive/restore,
historical readability, published-only Asset creation, stable definition
identities, and no title-based matching. **FR-34–FR-35** cover revisions and
idempotent publication; **FR-37** and **NFR-4** preserve history.

### Omissions

- The source explicitly blocks an archived Asset Type from starting or
  publishing a revision until restoration. **FR-9** exposes archive/restore but
  does not state this prohibition.
- The source says publication increments a **positive revision number**. The
  PRD preserves immutable revisions and opaque concurrency metadata but not the
  positive-number contract. This is a minor contract omission, not a product-
  scope conflict.

The more consequential dependency restriction for archiving a type used by
automatic-child creation is recorded under Component Roles below.

## `## Typed attributes` — covered

**FR-10** retains stable identity/key, all seven types, ordered stable choice
options, required/default behavior, exact decimals, canonical units, validation
of duplicate keys and incompatible identity reuse, materialized defaults, and
historically retained values. **FR-13** covers validation at creation and
**FR-16** handles later adoption. Help text and sibling position are lower-level
schema details whose omission does not change the behavior contract.

## `## Meter definitions` — covered

**FR-11** preserves the Meter identity, key, label, dimension, canonical unit,
precision, order, compatible presentation changes, and dimensional integrity.
**FR-13** covers instantiated Meters. PRD §6 correctly defers Meter Readings and
inherited usage to MVP 2. The exact publication error wording is implementation
trace rather than a missing product decision.

## `## Component roles` — partial

### Covered product behavior

**FR-12** preserves identity/key/label, cardinality, compatibility by stable
Asset Type, automatic children for a positive minimum with one compatible type,
snapshotting, explicit resolution of ambiguous required roles, infinite-
recursion rejection, optional compatibility cycles, concrete acyclicity,
ad-hoc Components, and explicit later mapping without label matching.
**FR-13** preserves atomic recursive Asset creation.

### Omissions

- The source requires generated child names to use the Role label plus an
  ordinal when needed and allows later editing. Neither artifact defines this
  naming/editability behavior.
- The source rejects archiving an Asset Type while a current published revision
  depends on it for automatic-child creation. Neither **FR-9** nor **FR-12**
  preserves this dependency guard.

## `## Concrete assets and configured values` — partial

**FR-10** and **FR-13** retain stable identity, lifecycle, accepted Asset Type
Revision, configured values, instantiated Meters, initial placement, atomic
required-child creation, validation, materialized defaults, absence of unknown
optional values, and required-value collection. **FR-16** preserves removed
values historically after adoption.

The source explicitly says an Asset has an **editable name**. The PRD defines
Asset identity and creation but never explicitly grants Asset rename behavior.
This is a genuine user-facing omission.

## `## Placement and installation history` — covered

**FR-8** and **FR-14** preserve singular current placement, dated placement and
Installation history, atomic close/open transitions, chronology, same-Workspace
compatibility, capacity, acyclicity, detachment/installation semantics, and
assembly movement. Manual installation/detachment remains distinct from
completed maintenance in **FR-14**; purpose-specific replacement is deferred to
**FR-28**. **FR-37** and **NFR-4** preserve provenance.

“History records rather than columns” is persistence design and is adequately
represented by addendum §3's relational-history guarantees without entering
the PRD body.

## `## Lifecycle and installed subtrees` — partial

### Covered product behavior

**FR-15** retains all four states, prior-state trash restoration, audited
reason/effective time/actor, closed incoming placement, retained descendant
Installations, operational pause, selected non-overlapping subtree detach and
rehoming, atomic validation, restoration placement, non-restorable disposal,
and audited correction. **FR-20** pauses Due Work/reminders. Addendum §3 retains
consequence-first lifecycle UI and the golden-path pause/rehoming proof.

### Omission

- The source specifies that a Component inside an **already paused subtree must
  be detached through one atomic command before it can resume independently**,
  and that the same command must give it active placement or transition it to
  retired/disposed. **FR-15** defines rehoming during the host transition but
  does not explicitly cover later extraction from an already paused assembly.

The ability to dispose or trash an entire retained assembly is broadly implied
by applying lifecycle commands to the root, but is not independently stated.

## `## Asset-type adoption and reconciliation` — covered

**FR-16** preserves explicit preview/apply, stable-identity diff categories,
required decisions, explicit mapping, no automatic destructive action,
atomicity, previous/adopted revision provenance, accepted diff, and stale-
preview rejection. Addendum §3 preserves HTTP outcomes `412`, `409`, and `422`,
current-version preconditions, atomic purpose-specific commands, and
consequence-first browser presentation.

## `## API contract` — covered

**FR-34–FR-36** carry optimistic concurrency, preserved input, retry safety,
atomic compound commands, client-neutral versioning, cursor pagination, stable
errors, and purpose-specific commands. Addendum §2 preserves `/api/v1`,
JSON:API 1.1, ETags, `If-Match`, `Idempotency-Key`, cursor conventions, and
error behavior; addendum §3 extends these rules to MVP 1, including resulting
read models and exact Reconciliation status mapping.

Per-slice endpoint/resource examples are intentionally left in shared API
documentation rather than duplicated in the PRD/addendum. This matches the
source's own delegation.

## `## Persistence and tenancy` — covered

The product/security consequences are in **FR-4**, **FR-8–FR-16**,
**FR-35**, **NFR-3**, **NFR-4**, and **NFR-5**. Addendum §2 and §3 preserve
explicit Workspace scope, composite relational enforcement, tenant-table RLS,
restricted runtime role, control-plane/RLS boundary, database constraints,
locked domain transactions, and historical records.

The source deliberately leaves exact tables to each capability's
implementation. Its expected concept list is compressed in the addendum rather
than made canonical product scope; no product behavior is lost.

## `## Browser application` — covered

The workflows map to **FR-3**, **FR-6–FR-16**, **UJ-1–UJ-2**, and canonical
acceptance scenarios 1–3 and 8. **FR-34** preserves form input through
validation/conflict/stale paths. **NFR-1–NFR-2** cover keyboard, touch,
mobile-first layout, and no drag-only dependency. Addendum §3 explicitly
preserves blueprint review, consequence-first movement/lifecycle views,
retained-history/paused-descendant explanation, accessible trees, explicit move
actions, and the MVP 1 browser proof.

Named libraries, client composition, port/adapter layout, DTO visibility, and
thin Next.js delivery files are correctly retained only as architecture or
implementation context, not promoted into product requirements.

## `## Testing and CI` — covered

PRD **SM-1–SM-5** and §8.1 turn the source's real-stack outcomes into canonical
acceptance measures. Addendum §3 summarizes the complete MVP 1 golden path,
including invitation, shared Workspace, nested places, recursive Assets,
ad-hoc Component adoption, movement, Reconciliation, lifecycle pause/rehoming,
ownership transfer, and cross-Workspace concealment. Addendum §5 retains real-
stack Chromium execution, mobile viewport, artifacts on failure, quality gates,
and migration/RLS integration coverage.

The exhaustive unit/integration test-case inventory is implementation trace and
is appropriately summarized rather than copied. No product acceptance outcome
from the numbered golden path is missing.

## `## Delivery sequence` — covered

All seven steps are preserved, in order and with equivalent labels, in addendum
§4 **MVP 1 sequence**. The rule that implementation and tests stay cohesive and
that client-visible contracts update shared documentation is preserved in
addendum §§4–5.

## Genuine gaps and conflicts

No direct contradiction was found between this source and the PRD/addendum.
The following source decisions are genuinely absent or under-specified:

1. **Invitation details:** optional personal message, preservation of the
   submitted display/delivery address, and the positive minimum safe-summary
   contract are not fully represented.
2. **No implicit default Location:** initial placement is required, but the
   explicit ban on creating a default Location with a Site is absent.
3. **Asset Type dependency guards:** restore-before-revise/publish and blocking
   archival while automatic-child dependencies exist are not stated.
4. **Generated Component and Asset naming:** automatic-child naming rules and
   general Asset rename behavior are absent.
5. **Paused-subtree extraction:** later independent resumption of a Component
   from an already paused subtree lacks the source's required atomic detach-and-
   place-or-deactivate rule.

The positive numeric revision rule is also omitted, but is lower-risk contract
detail. Development mail capture, exact storage tables, specific libraries,
adapter structure, full test matrices, and commit granularity are intentionally
treated as implementation trace rather than canonical PRD content.
