# Architecture Source Reconciliation

Status: approved coverage; authority links applied 2026-10-01. Source: [`docs/architecture.md`](../../../../docs/architecture.md).
Successor: [`ARCHITECTURE-SPINE.md`](./ARCHITECTURE-SPINE.md).
This record maps every source section and keeps useful detail traceable. The
source document remains in place as the detailed architecture reference.

The approved PRD governs product behavior and scope. Approved [`DESIGN.md`](../../ux-designs/ux-wrenchbase-2026-09-22/DESIGN.md)
and [`EXPERIENCE.md`](../../ux-designs/ux-wrenchbase-2026-09-22/EXPERIENCE.md)
govern visual and interaction decisions. Focused API, offline, security, and
deployment documents retain their subject details. The spine binds cross-unit
invariants; it does not silently replace those authorities.

## Section Coverage

| Source section | Landing | Detail retained or deferred |
| --- | --- | --- |
| Opening statement (lines 3–3) | Minimal seed; Stack | Current API/browser/PostgreSQL container baseline and future React Native client. Exact versions remain in manifests and lockfiles. |
| Repository Layout (lines 5–17) | Minimal seed; Deferred | The existing `api/`, `web/`, `docs/`, Compose and Make layout is summarized in the spine. `mobile/` remains absent until mobile work begins. |
| Application Boundaries (lines 19–29) | AD-2, AD-5, AD-6; retained focused contracts | API ownership and client-neutral contracts land in the spine; each API-owned capability contract documents canonical routes, authorization, resource fields/relationships, commands, and errors for clients to consume. Idempotency for creates, publishes, and multi-record commands carries the union of PRD/addendum and API-contract requirements. Cross-cutting media, paging, attachment, and sync details remain in `docs/api-contract.md` and `docs/offline-sync.md`. UX authority stays in approved UX spines. |
| Identity and Tenancy (lines 31–49) | AD-3, AD-4, AD-10; `docs/security-and-data-lifecycle.md`; PRD addendum §3 | OIDC claims and `(issuer, subject)` identity, session-scoped browser auth state, explicit Workspace scope, capability authorization, concealment, stable Capability API identifiers and owner/member assignments, private signed attachments, and purpose-specific adapters are preserved. The addendum's MVP-specific RLS boundary remains: control-plane tables outside RLS; tenant-domain tables from MVP 1 use RLS with transaction-local Workspace context and a restricted runtime role as defense in depth. Native token persistence and logout/revocation behavior remain unselected because the browser-specific source rules do not specify native credential storage. |
| Backend Architecture (lines 51–101) | AD-1; API AGENTS instructions; minimal seed | Capability-first Clean Architecture, inward dependencies, application-owned ports, Symfony composition, purpose-specific handlers, transactional-outbox invitation delivery, and naming conventions remain. The detailed example tree and naming guidance stay in `docs/architecture.md` and `api/AGENTS.md`; current API code is only Kernel and health route. |
| Frontend Architecture (lines 103–168) | AD-1, AD-2; web AGENTS instructions; minimal seed | Inward dependencies, DTO mapping, client-owned behavior, thin Next.js delivery code, separate server/browser composition, TanStack Query, and no duplicate backend remain. Detailed boundaries stay in `docs/architecture.md` and `web/AGENTS.md`; the existing web code is the starter shell. |
| Domain Storage (lines 170–202) | AD-3, AD-7, AD-8; PRD; schema shape Deferred | Relational ownership, Workspace scope, immutable published revisions, valid placement, acyclic trees, historical snapshots, audit provenance (actor, time, Workspace, action, relevant before/after context), Membership and invitation tenure, no hard deletion for domain records or confirmed Evidence in the MVP, completed-work due semantics, and distinct lifecycle meanings remain. No final table layout is promoted; the detailed invariant list remains here and the PRD remains normative. |
| Configurable Asset Types and Values (lines 204–220) | AD-7, AD-8; PRD `FR-9`–`FR-16` | Typed values, stable definition identity, component roles, recursive creation, canonical units, dated Installation relations, and the distinction between maintainable Components and materials remain in the PRD. No implementation schema is invented. |
| Schedules, Usage, and Time (lines 222–244) | AD-7, AD-8; PRD `FR-17`–`FR-20` | Independent immutable revision streams, typed triggers and recurrence policy, Meter inheritance/correction history, API-owned due calculation, UTC instants, calendar dates, Site time zone, and job snapshots remain in the PRD and focused contracts. Arbitrary formulas remain excluded. |
| Jobs, Reports, and Notifications (lines 246–261) | AD-2, AD-6, AD-8, AD-10; PRD `FR-21`–`FR-31` | Job/Work Item separation, explicit requirement fulfillment, correction by amendment/void, replacement atomicity, cost allocation, participant/location snapshots, notification eligibility and report ownership remain in the PRD; API and security documents hold wire and access details. |
| Frontend State and Offline Scope (lines 263–283) | AD-2, AD-9; `docs/offline-sync.md`; publication-protocol and retry-horizon gaps | TanStack Query/UI state, IndexedDB drafts, stable IDs, sync states, retries, explicit conflicts, intermediate shared server-draft creation, author ownership and handoff, and no closed-browser sync promise are retained. Failed concurrency preconditions retain member input under PRD `FR-34`. The PRD and source architecture allow offline Asset creation from cached existing Asset Types, while the focused offline contract omits its publication path. The API contract says idempotency retention is bounded but neither focused contract binds its replay horizon to how long queued offline work may remain. Product scope follows the PRD; publication details and a compatible retry horizon remain unresolved. |

The source architecture remains a detailed companion. Its examples and finer
domain statements are not deleted or rewritten by this migration.

## Conflicts and Open Seams

| Issue | Exact locations | Reconciliation |
| --- | --- | --- |
| MVP 0 Workspace settings scope differs between the PRD milestone summary and approved UX detail | PRD `§6`, `prd.md:912–927` (settings are listed in MVP 1 at 922–924); approved `EXPERIENCE.md:54–57` records detailed MVP 0 settings and leaves `UX-OQ-2` open | PRD governs product scope. The architecture spine does not assign settings to a milestone or settle the UX question; retain `UX-OQ-2` for PRD/UX reconciliation before affected stories. |
| Focused offline contract omits publication protocol for PRD-approved offline Asset creation | PRD `FR-32`, `prd.md:748–758` (explicit at 755); source `docs/architecture.md:270–275`; focused `docs/offline-sync.md:1–6` (opening scope excludes Asset creation); approved `EXPERIENCE.md:211–240` (especially 238–240) | This is a focused-contract omission, not unresolved product scope: PRD and UX agree offline Asset creation from cached existing Asset Types is in scope. The endpoint, outbox dependencies, and publication semantics remain unresolved. Reconcile `docs/offline-sync.md` before MVP 5 implementation; no contract edit is included in this migration. |
| Attachment details are more specific than approved product bounds | PRD `§10 OQ-6`, `prd.md:1090–1093`; `docs/api-contract.md:75–86`; `docs/security-and-data-lifecycle.md:19–30`; approved `EXPERIENCE.md:242–245` | Keep API authorization, private storage, metadata validation, and immutability. Do not elevate the focused contract's format list or 25 MiB/250 MiB reference limits into product-wide bounds until PRD/UX owners resolve the open question. |
| Browser server composition/auth storage remains open | PRD addendum `§2`, `addendum.md:27–38` | Preserve session-scoped browser token/request state. Authenticated server rendering and bearer-token cookies need a separate architecture decision before server-rendered authenticated API access. |
| Future native-client token persistence and logout behavior are unspecified | PRD addendum `§2`, `addendum.md:27–38` (browser auth only); source `docs/architecture.md:31–49` (identity and browser session guidance); AD-4 | Preserve OIDC Authorization Code with PKCE and provider-neutral identity. Decide native token at-rest storage and logout/revocation behavior before native authentication; do not transfer browser session rules to native by assumption. |
| UI recovery interaction for missing `If-Match` is unspecified | PRD `FR-34`, `prd.md:785–796`; `docs/api-contract.md:44–68`; approved `EXPERIENCE.md:172–176` and `434–436` (`UX-OQ-6`) | The PRD fixes that failed preconditions preserve the member's entered work. Preserve distinct API status semantics (`428`, `412`, `409`); leave the precise missing-precondition recovery interaction under UX-OQ-6 and do not merge the paths. |
| Offline retry horizon does not align explicitly with bounded idempotency retention | `docs/api-contract.md:70–75`; `docs/offline-sync.md:10–18,20–45`; PRD addendum `§2` (90-day Workspace-create result at lines 56–60) | The API contract requires bounded key retention and offline work can remain queued for later retry, but no general duration or shared replay horizon is chosen. Preserve idempotency and retained local work; reconcile the supported retry horizon with server replay behavior in the focused contracts before implementing long-lived offline publication. Do not invent a duration in this migration. |
| Idempotency scope spans API and product requirements | PRD `FR-35`, `prd.md:798–810`; PRD addendum `§3`, `addendum.md:138–143`; `docs/api-contract.md:70–75` | The PRD/addendum require creates and multi-record commands to be idempotent; the focused API contract explicitly requires creates and publishes. Preserve all three command classes as covered by `AD-6`; do not narrow the contract to one list's wording. |
| Dependency patch drift and upstream security notices are outside this architecture migration | `web/package-lock.json` locks Next.js `16.3.4`; official [advisory GHSA-vcvr-r3jv-pc5j](https://github.com/vercel/next.js/security/advisories/GHSA-vcvr-r3jv-pc5j) lists affected versions `>=16.2.0 <16.3.6`. Exploitation requires Node `next/og` `ImageResponse` with attacker-controlled SVG content, attributes, or styles; a source scan found no `next/og` or `ImageResponse` use in the current `web/` code. Assess package exposure separately before adding an affected path. The official [September security announcement](https://nextjs.org/blog/upcoming-nextjs-security-release-september-2026) says the release became available on 2026-09-30 with patched versions `16.3.8` and `15.5.27`; it notes `16.3.7` was released on 2026-09-29 with bug fixes only. `api/composer.lock` pins Symfony FrameworkBundle `8.1.6`, while [Symfony 8.1.8](https://symfony.com/blog/symfony-8-1-8-released) was released on 2026-09-29. Web locks React `19.2.8` and TypeScript `5.9.3`; official [React versions](https://react.dev/versions) list `19.3` as latest, and [TypeScript](https://www.typescriptlang.org/) says `7.0` is available. | These are repository lockfile facts, not a request to change the selected stack. Do not update manifests or locks here. Handle security exposure and version drift separately under dependency/security maintenance. |

No new architecture decision is proposed. The sole draft classification
assumption is initiative altitude for this system-wide scope; it is called out
in the spine for approval.

## Repository Reality Check

The API has `Kernel.php` and a health controller; the browser remains the
generated Next.js starter. There are no implemented capability modules,
authentication, tenant repositories, attachment adapters, offline store, or
native client to claim as existing conventions. The spine therefore marks
approved source decisions as adopted while its structural seed separates the
implemented skeleton from planned conventions.

The stack family is checked against `api/composer.json`, `api/composer.lock`,
`web/package.json`, `web/package-lock.json`, both application Dockerfiles,
Compose files, and `docs/deployment.md`. Official release sources checked for
version currency: [PHP releases](https://www.php.net/releases/), [Symfony 8.1.8](https://symfony.com/blog/symfony-8-1-8-released),
[Next.js advisory](https://github.com/vercel/next.js/security/advisories/GHSA-vcvr-r3jv-pc5j), [Next.js security announcement](https://nextjs.org/blog/upcoming-nextjs-security-release-september-2026), [Next.js 16.3.7 release](https://github.com/vercel/next.js/releases/tag/v16.3.7), [React versions](https://react.dev/versions), [TypeScript](https://www.typescriptlang.org/),
and [PostgreSQL version support](https://www.postgresql.org/support/versioning/).
No selected stack or dependency is changed.

## Approved Authority and Link Changes — Applied 2026-10-01

The user approved these documentation link and authority edits. The source
document remains in place; the architecture spine governs cross-unit invariants.

### `AGENTS.md`

Replace the Required Context architecture bullet with:

```markdown
- Read the [architecture spine](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) for cross-unit invariants and the [detailed architecture reference](docs/architecture.md) plus its [source reconciliation](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/source-reconciliation.md) for section-level coverage before changing application boundaries, domain structure, persistence, client state, or offline behavior.
```

### `api/AGENTS.md`

Replace the opening architecture sentence with the following and keep the
contribution standards sentence:

```markdown
Read the [architecture spine](../_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) for shared invariants and the [backend architecture reference](../docs/architecture.md#backend-architecture) for API detail before changing application structure or dependencies. Follow the repository [contribution standards](../CONTRIBUTING.md) for tests, quality checks, documentation, and commits.
```

### `web/AGENTS.md`

Replace the opening architecture sentence with the following and keep the
contribution standards sentence:

```markdown
Read the [architecture spine](../_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) for shared invariants and the [frontend architecture reference](../docs/architecture.md#frontend-architecture) for browser detail before changing client responsibilities, server-state handling, or offline behavior. Follow the repository [contribution standards](../CONTRIBUTING.md) for tests, quality checks, documentation, and commits.
```

### `README.md`

Replace the Documentation and Project Status paragraphs with:

```markdown
The [canonical PRD](_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/prd.md) is authoritative for product behavior. The [architecture spine](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) governs cross-unit invariants; [docs/architecture.md](docs/architecture.md) remains the detailed architecture reference, with section coverage in the [source reconciliation](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/source-reconciliation.md). Read the [API contract](docs/api-contract.md) before changing a client-visible endpoint, the [offline synchronization contract](docs/offline-sync.md) before changing queued work, and the [security and data lifecycle policy](docs/security-and-data-lifecycle.md) before changing identity, tenancy, or attachments.

Use the [deployment guide](docs/deployment.md) for portable production and AWS reference operations, and the [UX and accessibility brief](docs/ux-accessibility.md) for browser workflows.
```

```markdown
See the [canonical PRD](_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/prd.md) and [architecture spine](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) for current direction. The [detailed architecture reference](docs/architecture.md) and [source reconciliation](_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/source-reconciliation.md) retain the source coverage.
```

### `docs/architecture.md`

Add this authority note after its opening paragraph:

```markdown
The [architecture spine](../_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/ARCHITECTURE-SPINE.md) governs cross-unit invariants. This document remains the detailed architecture reference; its section coverage is recorded in the [source reconciliation](../_bmad-output/planning-artifacts/architecture/architecture-wrenchbase-2026-09-30/source-reconciliation.md).
```

These edits make the short spine authoritative for shared architecture while
retaining the existing source document and its details.
