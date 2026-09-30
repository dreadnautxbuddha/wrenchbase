# Wrenchbase PRD Addendum

This addendum preserves settled contract, delivery, and implementation context
from the reconciled inputs. That context is too technical for the canonical
PRD. It does not replace `docs/architecture.md`, `docs/api-contract.md`,
`docs/offline-sync.md`, or other focused technical documents. If this addendum
and a retained focused technical document differ, the focused document controls
its own subject.

## 1. Existing Application Boundaries

- The Symfony API is the source of truth for business rules, authorization,
  validation, persistence, Due Work calculation, notification eligibility, and
  report data.
- Browser-specific presentation and interaction remain in the browser client.
- API contracts serve both the browser and a possible future React Native
  client and do not expose Next.js-specific semantics.
- Core maintenance concepts remain relational. Flexible values do not replace
  typed relationships, lifecycle history, authorization, or Due Work rules.
- Published Asset Type and Maintenance Schedule revisions are immutable;
  historical correction uses explicit append-friendly operations.
- Offline drafts and synchronization presentation belong to the client; the
  API validates and atomically publishes authoritative completed work.

## 2. MVP 0 Contract and Delivery Context

### Authentication and identity

- Browser authentication uses Authorization Code with PKCE (S256). The
  development provider is Keycloak, but application identity remains provider-
  neutral.
- The API validates issuer, audience, expiry, subject, and verified-email claims
  through an identity port rather than a vendor SDK.
- The external identity key is `(issuer, subject)`; synchronized profile fields
  are not identity keys.
- Browser token and request state use session-scoped storage. Authenticated
  server rendering and bearer-token cookies require a separate architecture
  decision.

### API conventions

- The established public API root is `/api/v1` and the wire format is JSON:API
  1.1 with `application/vnd.api+json`.
- MVP 0 routes include `GET /me`, `GET/POST /workspaces`, and
  `GET/PATCH /workspaces/{workspaceId}`.
- Identifiers are application-generated UUIDv7 values serialized as canonical
  lowercase UUID strings.
- Workspace collections use opaque cursor pagination ordered by immutable
  creation instant and UUID. Default page size is 25 and maximum page size is
  100.
- The initial Capability strings are `workspace.read` for owners and Members
  and `workspace.update` for owners.
- Strong, representation-specific ETags include caller-relevant revision state.
  `PATCH` requires `If-Match`; missing, stale, and domain-conflict outcomes map
  to HTTP 428, 412, and 409 respectively.
- Workspace creation requires a frontend-generated UUID in `Idempotency-Key`.
  Completed successful results are retained for 90 days; the same key with a
  different operation or request fingerprint is rejected.
- Errors use stable machine-readable codes, source pointers where appropriate,
  and correlation identifiers.

### Persistence and tenancy

- MVP 0 persistence includes users, external identities, Workspaces,
  Memberships, idempotency records, and audit events in shared PostgreSQL
  tables.
- Repository operations carry explicit Workspace context; authorization occurs
  before resource lookup.
- The runtime database role is distinct from the privileged migration role.
  Control-plane tables do not use row-level security; tenant-domain tables added
  from MVP 1 use row-level security as a defense-in-depth measure, not as the
  primary authorization system.
- Workspace creation, first-owner Membership, its audit event, and successful
  idempotency result commit in one transaction.

### Browser and verification

- Browser infrastructure parses API responses at runtime and maps transport
  DTOs into application read models; presentation code does not import concrete
  HTTP adapters directly.
- Authorization-sensitive controls consume Capabilities supplied by the API.
- Loading, empty, unauthorized, not-found, validation, network, and stale-
  revision states are completion requirements rather than follow-up polish.
- The real-stack MVP 0 golden path covers sign-in, two-Workspace creation and
  switching, stale edits across two tabs, second-user isolation, concealed
  cross-Workspace lookup, and provider logout at a narrow mobile viewport.
- Root Make targets remain the public quality interface, with the full API,
  web, production-build, and end-to-end gates composed by `make check`.
- The MVP 0 delivery runbook remains the execution-package handoff for the
  milestone until its source-link migration is approved.

## 3. MVP 1 Contract and Delivery Context

### Capability strings

The following identifiers are public contract strings and must not be renamed
casually:

- `workspace.read`
- `workspace.update`
- `workspace.membership.read`
- `workspace.membership.manage`
- `site.read`
- `site.manage`
- `assetType.read`
- `assetType.manage`
- `asset.read`
- `asset.manage`

Owners and Members receive the read/manage Capabilities for Sites, Asset Types,
and Assets. Owners additionally receive `workspace.update` and
`workspace.membership.manage`.

### Invitation delivery

- Invitation creation and the request to deliver it commit atomically through a
  transactional outbox; provider availability does not control the request's
  success.
- Delivery uses a purpose-specific mail port and a retryable worker.
- Invitation secrets are random, single-use, rotated on resend, and stored only
  in non-plaintext form.

### Relational and tenancy enforcement

- Tenant-domain rows have a non-null Workspace scope and use composite
  constraints or foreign keys to prevent cross-Workspace references.
- PostgreSQL row-level security applies to MVP 1 tenant-domain tables through
  transaction-local Workspace context and the restricted runtime role.
- Local invariants use database constraints where practical. Graph, subtree,
  recursive creation, lifecycle, and Reconciliation invariants are validated in
  locked domain transactions.
- Historical invitations, tenures, placements, Installations, lifecycle events,
  audit information, and Reconciliations remain available for the behaviors in
  the PRD.

### Purpose-specific commands

- Creates and multi-record commands require idempotency; state-dependent
  mutations require a current-version precondition.
- Compound invitation, ownership, tree, publication, placement, Installation,
  lifecycle, and Reconciliation commands return the resulting read model and
  are atomic.
- Collections default to immutable creation-time and UUID cursor order unless a
  capability declares another immutable order. Tree or sibling order is data,
  not a cursor key.
- Asset Type adoption maps stale preconditions to 412, valid semantic conflicts
  to 409, and invalid requested values to 422.

### Browser and acceptance context

- Tree controls must be keyboard accessible and expose explicit move actions
  compatible with touch and assistive technology; drag-and-drop is never the
  only path.
- Forms retain entered values after validation, network, conflict, and stale-
  version failures.
- Asset Type publication shows the complete blueprint before confirmation.
- Move, install, detach, adoption, and lifecycle views expose consequences
  before confirmation, including retained history and paused descendants.
- MVP 1's real-stack proof covers invitation acceptance and Workspace switching,
  Site and Location trees, recursive assembly creation, movement, ad hoc
  Component adoption, lifecycle pause and rehoming, ownership transfer, and
  cross-Workspace concealment.

## 4. Delivery Sequencing Retained from the Inputs

### MVP 0 sequence

1. Define the walking skeleton.
2. Establish web tests and GitHub Actions.
3. Add provider-neutral OIDC authentication.
4. Enforce engineering standards.
5. Deliver Workspace onboarding and tenancy.
6. Cover the authenticated Workspace golden path.

### MVP 1 sequence

1. Membership and invitations.
2. Sites and nested Locations.
3. Versioned Asset Type authoring.
4. Asset creation and placement.
5. Installation and lifecycle.
6. Explicit Asset Type Reconciliation.
7. End-to-end golden path.

Each delivery slice updates the API contract, browser behavior, tests, and
audit behavior together when the slice affects them. Implementation and its
directly related tests remain one cohesive change.

## 5. Engineering Verification Context

- API and browser code follow capability-first Clean Architecture boundaries.
- Strict PHP and TypeScript checks, dependency-boundary checks, formatting,
  static analysis, unit/integration tests, production build, and real-stack
  browser tests run through repository container commands locally and in CI.
- Source-code standards include a 120-character line limit and documented class
  property types where required by the language-specific project rules.
- End-to-end browser tests use the real Compose stack, serial Chromium, and
  retain failure traces, screenshots, and HTML reports.
- Migration and row-level-security integration coverage is required before MVP
  1 tenant tables ship.
- Client-visible contract changes update every affected client and the shared
  contract documentation in the same change.

## 6. Detailed Extraction Records

The heading-complete extraction records remain the audit trail for source facts
that were summarized into the PRD or this addendum:

- `extract-product-vision.md`
- `extract-product-requirements.md`
- `extract-roadmap.md`
- `extract-mvp-0-implementation-plan.md`
- `extract-mvp-1-implementation-plan.md`
