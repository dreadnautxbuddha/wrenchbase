# Reconciliation: `docs/mvp-0-implementation-plan.md`

## Verdict

MVP 0's product behavior, public API contract, tenancy model, delivery outcome,
and milestone boundary are covered across `prd.md` and `addendum.md`. The source
also contains low-level implementation and engineering-standard decisions; a
meaningful subset is intentionally summarized rather than preserved exactly.
Those omissions are trace/addendum gaps, not missing product requirements.
No genuine behavioral conflict was found.

Status meanings:

- **Covered** — the source meaning is represented at the appropriate product,
  contract, or addendum level.
- **Partial** — core meaning is present, but one or more source details are not
  explicitly retained.
- **Missing** — no destination statement preserves the source meaning.

## Exact source-heading coverage

### Exact heading: `# MVP 0 Implementation Plan` — Partial

**Product behavior:**

- `prd.md` §0 states that the canonical PRD consolidates the product
  requirements, roadmap, and MVP 0–1 implementation plans while sources remain
  authoritative through approval.
- `prd.md` §6 preserves MVP 0 as the delivery and contract foundation.

**Contract/delivery trace:**

- `addendum.md` §2 preserves MVP 0 authentication, API, tenancy, browser, and
  verification decisions.
- `addendum.md` §4 preserves the MVP 0 delivery sequence.
- `addendum.md` §6 points to the heading-complete MVP 0 extraction record.

**Omissions:**

- The source says the MVP 0 UI/UX plan, approved visual design, engineering
  standards plan, and delivery runbook are implementation/completion inputs.
  Those four explicit document relationships are not recorded in the PRD or
  addendum.
- The addendum preserves resulting UX/accessibility, engineering, and sequence
  decisions, but not that the delivery runbook divides work into bounded
  packages with verification/review stops.

### Exact heading: `## Goal and completion criteria` — Covered

**Product behavior:**

- `prd.md` UJ-1, FR-1–FR-5, FR-34–FR-37, §6 **MVP 0**, NFR-2, NFR-3, and
  SM-1/SM-2 cover sign-in, Workspace creation/editing/switching, user isolation,
  mobile-first behavior, contract guarantees, and real-stack proof.
- `prd.md` §6 preserves the MVP 0 boundary: Assets, schedules, Jobs,
  attachments, offline synchronization, maintenance email, and production
  hardening are excluded at this milestone.

**Implementation trace:**

- `addendum.md` §2 records the Keycloak/browser/API/PostgreSQL path in its
  component-specific subsections and the real-stack golden path.
- `addendum.md` §5 preserves local/CI container verification.

**Note:** the source says no “email” in MVP 0, while §6 says no “maintenance
email.” This is not a conflict: invitation email begins in MVP 1 and neither
artifact puts email delivery in MVP 0.

### Exact heading: `## Authentication and identity` — Partial

**Product behavior:**

- `prd.md` FR-1 requires provider-neutral OIDC, provider-verified email,
  issuer/subject identity, profile synchronization, provider logout, and no
  persisted access/refresh tokens.
- `prd.md` FR-2 and NFR-3 cover client storage and security boundaries.

**Contract detail:**

- `addendum.md` §2 **Authentication and identity** preserves Authorization Code
  with PKCE S256, Keycloak as development provider, provider neutrality,
  issuer/audience/expiry/subject/verified-email validation, identity key
  `(issuer, subject)`, no token persistence, browser session storage, and the
  separate-decision boundary for server-side sessions or bearer cookies.

**Implementation trace omissions:**

- Imported `wrenchbase` realm and two verified development users.
- Disabled implicit/password grants, requested OIDC scopes, token renewal,
  callback-parameter cleanup, and separate user/request state stores.
- Mapping email claims into access tokens and the integration test requiring
  access-token rather than ID-token-only provisioning.
- The exact `oidc-client-ts` / `react-oidc-context` browser choice.
- Symfony `OidcTokenHandler`, discovery/cached JWKS details, and the exact
  package/extension additions (`web-token/jwt-library`, `symfony/cache`,
  `symfony/intl`, `ext-intl`, `ext-gmp`).

These are implementation/addendum candidates, not PRD requirements.

### Exact heading: `## API contract` — Partial

**Product behavior:**

- `prd.md` FR-1–FR-5 and FR-36 cover profile/Workspace behavior, Capability
  authorization, validation, client-neutral versioning, opaque cursor
  pagination, unsupported-query rejection, stable errors, and correlation.
- `prd.md` FR-2 preserves exact Workspace validation: 1–100 trimmed grapheme
  clusters, canonical BCP 47 locale, uppercase ISO 4217 currency, and first
  owner creation.

**Contract detail:**

- `addendum.md` §2 **API conventions** preserves `/api/v1`, JSON:API 1.1 media
  type, the five MVP 0 endpoints, UUIDv7/canonical lowercase UUID identifiers,
  pagination order and size limits, initial Capability strings, ETags,
  idempotency, errors, and correlation IDs.

**Omissions:**

- The internal JSON:API document/error layer and explicit decision not to add
  an unverified framework bundle are not retained.
- Exact `/me` and Workspace response field lists are distributed across FR-1,
  FR-2, and the glossary but not preserved as one contract statement.
- The source specifically excludes `include`, sparse fieldsets, arbitrary
  filtering, and arbitrary sorting; FR-36 only generalizes these as unsupported
  query features that must be rejected.
- The full source enumeration of error categories and exact JSON Pointer/header
  placement is summarized rather than exhaustively restated.

### Exact heading: `## Concurrency and idempotency` — Partial

**Product behavior and public contract:**

- `prd.md` FR-34 requires opaque revisions, stale/missing-precondition
  distinction, retained form values, and deliberate reload/resubmit.
- `prd.md` FR-35 requires retry-safe creates/multi-record commands, successful
  replay, rejection of key reuse with changed operation/payload, and atomic
  compound commands.
- `addendum.md` §2 **API conventions** preserves caller-specific strong ETags,
  exact `428`/`412`/`409` mappings, frontend-generated UUID idempotency keys,
  90-day successful-result retention, and changed-request rejection.
- `addendum.md` §2 **Persistence and tenancy** preserves the atomic Workspace,
  first-owner Membership, audit event, and idempotency-result transaction.

**Implementation trace omissions:**

- Exact ETag input tuple and the persistence compare-and-swap sequencing.
- Exact idempotency record fields, SHA-256 fingerprint algorithm, and uniqueness
  per actor/key.
- The explicit rule not to retain validation or transient infrastructure
  failures as completed results.
- The cron-ready expired-record pruning command.

### Exact heading: `## Persistence and tenancy` — Covered

**Product behavior:**

- `prd.md` FR-4 and NFR-3 cover explicit Workspace ownership, impossible
  cross-Workspace relationships, capability authorization, and concealed
  cross-Workspace lookup.
- `prd.md` FR-37 covers auditability; FR-1/NFR-3 cover token non-persistence.

**Contract/implementation trace:**

- `addendum.md` §2 **Persistence and tenancy** names the MVP 0 persisted
  concepts, explicit Workspace context, authorization-before-lookup,
  restricted runtime versus migration roles, control-plane RLS boundary, and
  MVP 1 tenant-domain RLS as defense in depth.
- `addendum.md` §3 **Relational and tenancy enforcement** preserves non-null
  scope, composite constraints/foreign keys, transaction-local context, and
  control-plane separation.
- `addendum.md` §2 **API conventions** preserves application-generated UUIDv7.

All source-level product and architectural decisions are present, although
exact migration names remain appropriately outside the PRD narrative.

### Exact heading: `## Browser application` — Partial

**Product behavior:**

- `prd.md` UJ-1, FR-1, FR-2, FR-4, FR-34, NFR-1, and NFR-2 cover sign-in,
  callback outcome, onboarding, Workspace create/edit/switch, explicit routes,
  capability-driven controls, logout, complete states, stale-edit recovery,
  keyboard accessibility, and mobile-first behavior.
- FR-2 limits cross-session local persistence to the last Workspace ID and
  excludes server data, drafts, and tokens from `localStorage`.

**Contract/implementation trace:**

- `addendum.md` §2 **Authentication and identity** preserves session-scoped
  token/request state and the explicit future-decision boundary for SSR or
  cookie-based bearer sessions.
- `addendum.md` §2 **Browser and verification** preserves runtime response
  parsing, DTO-to-read-model mapping, application boundaries, capability-driven
  controls, all required UI states, and the real-stack golden path.

**Implementation trace omissions:**

- Exact dependencies: TanStack Query, Zod, Vitest, Testing Library,
  `oidc-client-ts`, and `react-oidc-context`.
- Exact HTTP adapter responsibilities, including header attachment, ETag
  propagation, one-key retry reuse, and presentation-state mapping.
- Exact narrow CORS allow/expose configuration and named exposed headers.
- Explicit callback URL cleanup is not retained.

### Exact heading: `## Testing and CI` — Partial

**Product/acceptance coverage:**

- `prd.md` SM-1, SM-2, SM-5 and canonical scenarios 1–2 cover the real-stack
  MVP 0 outcomes, Workspace isolation, narrow viewport, and accessibility.
- `addendum.md` §2 **Browser and verification** preserves the complete golden-
  path subject matter and `make check` as the root quality gate.
- `addendum.md` §5 preserves strict PHP/TypeScript checks, dependency checks,
  formatting, static analysis, unit/integration tests, production build,
  real-stack browser testing, container parity, serial Chromium, and retained
  failure artifacts.

**Implementation/engineering omissions:**

- Symfony's published standard, PHPStan maximum level, PHPUnit
  Given/When/Then naming, and the hard 120-character PHP line limit.
- Deterministic JS/TS formatting details, hard 120-character line limit,
  type-aware strict lint categories, and the exact class-property typing/JSDoc
  policy.
- Exact API and web test inventories are summarized by the golden path rather
  than retained case by case.
- The pre-commit-versus-Playwright boundary, exact `make web-test` / `make e2e`
  target additions, and GitHub Actions triggers for pull requests and pushes to
  `master` are not explicit.

These omissions matter only if the addendum is expected to replace the focused
engineering standards and runbook documents.

### Exact heading: `## Delivery sequence` — Partial

**Delivery trace:**

- `addendum.md` §4 **MVP 0 sequence** preserves all six steps in order:
  walking skeleton; tests/Actions; provider-neutral OIDC; engineering
  standards; Workspace onboarding/tenancy; authenticated golden path.
- The addendum's closing rule preserves coordinated API/browser/tests/audit
  changes; §5 preserves client and shared-contract updates in the same change.

**Omissions:**

- The exact suggested Conventional Commit subjects are not retained.
- The source's per-commit requirement to pass relevant checks is implied by
  addendum §5 but not tied explicitly to every delivery commit.

## Product behavior coverage summary

The canonical PRD fully represents MVP 0's user-visible and business behavior:
provider-neutral sign-in, verified identity, Workspace onboarding/editing/
switching, first-owner creation, Capability authorization, tenant concealment,
validation, revision conflicts, retry-safe creation, mobile/accessibility
outcomes, and the milestone exclusions. No product-behavior gap was found.

## Contract coverage summary

The addendum retains the important stable contract: OIDC flow and identity key,
API root and JSON:API version, endpoint set, UUIDv7, pagination bounds,
Capability strings, caller-specific ETags, error mappings, 90-day idempotency,
atomic Workspace creation, explicit tenancy, and RLS boundary. Some detailed
wire behavior is generalized, chiefly unsupported query names, error placement,
and idempotency record mechanics.

## Genuine gaps and conflicts

### Gaps

1. **Supporting-document authority/handoffs are absent.** The UI/UX plan,
   approved visual design, engineering standards plan, and bounded-package
   delivery runbook are not named as MVP 0 completion inputs. This is a source-
   retirement and inbound-link risk, not a product gap.
2. **Engineering policy is incompletely preserved.** The exact 120-character
   rules, maximum-level PHPStan, PHPUnit test naming, and class-property
   type/JSDoc policy are omitted from the addendum.
3. **Authentication implementation decisions are summarized.** Exact browser
   libraries/storage configuration, Keycloak realm/claim setup, Symfony token
   handler and package/extension requirements are absent.
4. **Idempotency operational details are summarized.** The exact stored fields,
   SHA-256 fingerprint, non-retention of unsuccessful results, and pruning
   command are absent.
5. **Browser/CI wiring is summarized.** Exact CORS/adapter responsibilities,
   test inventories, Make target additions, and Actions trigger details are not
   retained.

### Conflicts

No genuine conflict was found. The addendum's identity-port boundary is
compatible with the source's Symfony OIDC handler choice: the framework handler
can sit behind the application boundary. The PRD's “maintenance email” wording
does not move any email delivery into MVP 0.
