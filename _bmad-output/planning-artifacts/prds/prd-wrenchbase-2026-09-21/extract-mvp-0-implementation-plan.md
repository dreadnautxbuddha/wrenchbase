# MVP 0 Implementation Plan source extraction

Source: `docs/mvp-0-implementation-plan.md`

Purpose: capture MVP 0 product commitments and delivery trace for canonical
PRD reconciliation. The source states that product requirements remain
authoritative for domain behavior; implementation choices below are therefore
kept as addendum/trace context unless they express observable product behavior
or an explicit contract.

## Heading-by-heading coverage checklist

- [x] `# MVP 0 Implementation Plan`
- [x] `## Goal and completion criteria`
- [x] `## Authentication and identity`
- [x] `## API contract`
- [x] `## Concurrency and idempotency`
- [x] `## Persistence and tenancy`
- [x] `## Browser application`
- [x] `## Testing and CI`
- [x] `## Delivery sequence`

## `# MVP 0 Implementation Plan`

### Authority and purpose

- The plan is the first implementation slice derived from product requirements,
  architecture, and roadmap.
- `docs/product-requirements.md` remains authoritative for domain behavior.
- This source records MVP 0 delivery decisions and completion requirements; it
  must not silently override the authoritative product requirements.

### Declared source dependencies

- `docs/mvp-0-ui-ux-plan.md` defines browser information architecture,
  responsive layouts, interaction states, and accessibility behavior.
- `docs/mvp-0-visual-design.md` defines approved styling tokens, shared
  component treatment, and the accessibility standard; these are described as
  MVP 0 implementation and completion requirements.
- `docs/mvp-0-engineering-standards-plan.md` defines the engineering rules,
  architecture checks, documentation requirements, and local/CI gates that
  precede continued workspace capability development.
- `docs/mvp-0-delivery-runbook.md` divides the plan into bounded delivery
  packages with verification and review stops.

These dependencies are trace references only in this extraction; their contents
were not imported.

## `## Goal and completion criteria`

### Product requirements suitable for the canonical PRD

- MVP 0 is a runnable, mobile-first walking skeleton.
- An authenticated user can create and edit workspaces and switch between them.
- A user's workspace data is isolated from other users.
- Explicitly excluded from MVP 0: invitations, sites, locations, assets,
  schedules, jobs, attachments, offline synchronization, email, and production
  hosting hardening.

### Completion and trace context

- The end-to-end technical path is `Keycloak -> Next.js -> Symfony API ->
  PostgreSQL`.
- API, browser, and end-to-end checks run in GitHub Actions through the
  repository container workflow.

The named technologies and CI environment are implementation/verification
choices, not canonical product requirements.

## `## Authentication and identity`

### Product or externally observable contract decisions

- Authentication requires a provider-verified email.
- The stable external identity is the pair `(issuer, subject)`, allowing the API
  to remain identity-provider-neutral.
- The application synchronizes verified email, display name, and optional
  avatar from the external identity.
- The application does not retain access or refresh tokens in its database.
- Sign-in requests the `openid`, `profile`, and `email` scopes and supports
  provider logout.

### Implementation addendum / trace context

- Development identity provider: a pinned Keycloak Compose service with an
  imported `wrenchbase` realm and two verified test users.
- Browser flow: Authorization Code with PKCE (S256); implicit and direct-access
  grants disabled; `oidc-client-ts` and `react-oidc-context`; user and request
  state in `sessionStorage`; token renewal; callback parameters removed.
- API validation: Symfony `OidcTokenHandler`, discovery, cached JWKS, and
  issuer/audience/expiry validation.
- Access-token claim mapping includes `email` and `email_verified`; provisioning
  must not depend on ID-token-only claims.
- Listed backend dependencies and PHP extensions are implementation decisions,
  not PRD scope.

## `## API contract`

### Product and stable contract decisions

- MVP 0 exposes the authenticated user and workspace collection/detail/create/
  update capabilities under a versioned API.
- The user representation contains display name, verified email, and an optional
  avatar URL.
- Workspace data contains name, locale, and default currency, plus opaque
  revision metadata and caller-specific role/capability information.
- Initial capabilities are:
  - `workspace.read` for owners and members;
  - `workspace.update` for owners.
- Clients use explicit capability strings rather than deriving authorization
  from role names.
- Any authenticated user can create a workspace at any time; the creator becomes
  its first owner.
- Workspace creation requires:
  - a trimmed name of 1–100 grapheme clusters;
  - a canonical BCP 47 locale; and
  - an uppercase ISO 4217 currency.
- Domain identifiers are opaque UUIDs serialized as canonical lowercase UUID
  strings.
- Workspace collections use cursor pagination, default page size 25 and maximum
  100, with stable ordering. Cursors are opaque to clients.
- MVP 0 does not support includes, sparse fieldsets, arbitrary filters, or
  arbitrary sorting; unsupported query parameters are rejected rather than
  silently ignored.
- API errors expose stable machine-readable codes for authentication,
  verified-email, validation, authorization, media/query support, stale
  revision, and idempotency failures; field errors identify their source and
  responses provide correlation identifiers.

### Implementation addendum / trace context

- Transport format is JSON:API 1.1 with
  `application/vnd.api+json`, implemented using a small internal document/error
  layer.
- Named routes are `GET /me`, `GET/POST /workspaces`, and
  `GET/PATCH /workspaces/{workspaceId}` under `/api/v1`.
- UUID version 7 is application-generated and stored in PostgreSQL's native
  `uuid` type.
- Stable ordering uses immutable creation instant followed by UUID.

The canonical PRD should preserve externally observable contract decisions and
stable capability names, but may place wire-format and storage choices in an
architecture/API-contract addendum.

## `## Concurrency and idempotency`

### Product or externally observable contract decisions

- Workspace editing uses optimistic concurrency and rejects missing or stale
  revision preconditions.
- A stale edit preserves the user's entered values and offers a way to reload
  current server state.
- Workspace creation is idempotent across client retries: repeating the same
  operation with the same idempotency key and payload replays the successful
  result; reusing the key for another operation or payload is rejected.
- Valid domain-state conflicts remain distinguishable from stale-revision and
  missing-precondition failures.

### Stable protocol decisions

- Workspace representations carry an opaque revision and a strong,
  representation-specific `ETag`.
- `PATCH` requires `If-Match`; missing, stale, and domain-conflict outcomes use
  HTTP `428`, `412`, and `409`, respectively.
- `POST /workspaces` requires a frontend-generated UUID in `Idempotency-Key`.
- Successful idempotency records expire after 90 days.

### Implementation addendum / trace context

- ETags include workspace revision, membership revision, and actor identity to
  avoid reuse across caller-specific representations.
- Workspace creation, owner membership, audit records, and completed
  idempotency result commit in one transaction.
- Stored idempotency details include actor, optional workspace, key, operation,
  SHA-256 request fingerprint, successful status/body, completion time, and
  expiry. Validation and transient infrastructure failures are not retained as
  completed results.
- A cron-ready command prunes expired idempotency records.
- Workspace revision provides the persistence compare-and-swap value after
  authorization and ETag validation.

## `## Persistence and tenancy`

### Product and security requirements

- Workspace data is tenant-isolated.
- A valid identifier belonging to another workspace is concealed with a `404`
  response rather than revealing its existence.
- Identity linkage, workspace creation/updates, and membership events are
  auditable.
- Bearer tokens are never persisted in the application database.
- Future tenant-owned records must be scoped to a workspace and must not permit
  cross-workspace references.

### Implementation addendum / trace context

- MVP 0 tables are `users`, `external_identities`, `workspaces`,
  `workspace_memberships`, `idempotency_records`, and `audit_events`.
- Persistence uses UTC instants, application-generated UUIDv7 identifiers, and
  shared PostgreSQL tables with explicit workspace scoping and composite
  integrity constraints.
- Repository methods require workspace context and authorization precedes
  resource lookup.
- MVP 0 introduces a workspace database-context abstraction and separates the
  privileged migration role from the restricted runtime role.
- Control-plane tables do not use Row-Level Security. RLS is deferred to MVP 1
  tenant-owned domain tables as defense in depth, using transaction-local
  workspace context rather than as the authorization system.

## `## Browser application`

### Product requirements suitable for the canonical PRD

- The browser provides public sign-in and identity-provider callback handling.
- A signed-in user with no memberships receives an onboarding flow.
- Users can create a workspace, edit its basic settings, visit an explicit
  workspace route, and switch workspaces.
- The UI handles loading, empty, unauthorized, not-found, validation, network,
  and stale-revision states.
- Users can log out through the identity provider.
- Authorization-sensitive controls follow capabilities supplied by the API.
- Only the last selected workspace identifier is retained across browser
  sessions; meaningful server data, drafts, and tokens are not stored in
  `localStorage`.
- When an update is stale, entered values remain available and the user can
  reload current state.

### Implementation addendum / trace context

- Named libraries include TanStack Query, Zod, Vitest, Testing Library,
  `oidc-client-ts`, and `react-oidc-context`.
- HTTP, OIDC, and JSON:API parsing use application boundaries and infrastructure
  adapters; Next.js delivery files remain thin.
- Authenticated routes are client-composed because browser tokens reside only in
  `sessionStorage`; authenticated Server Component prefetching and bearer-token
  cookies are excluded pending a separate architecture decision.
- The HTTP adapter supplies auth/JSON:API headers, response validation, error
  mapping, ETag handling, and retry-key reuse.
- CORS is narrowly configured for the web origin and required/exposed headers.

## `## Testing and CI`

### Completion evidence relevant to product acceptance

- Authentication/provisioning coverage includes token validation, verified
  email, and access-token email claim mapping.
- Workspace acceptance coverage includes ownership/capabilities, tenant
  isolation, owner/member authorization, revisions, idempotency, caller-specific
  representations, unsupported queries, API documents, and audit events.
- Browser coverage includes authentication routing, onboarding, switching,
  capability-driven controls, parsing, retry behavior, stale-edit recovery, and
  keyboard-accessible forms.
- The real-stack end-to-end golden path verifies:
  1. sign-in;
  2. creation of two workspaces and switching via explicit routes;
  3. editing and stale-revision handling across two tabs;
  4. a second user's private workspace;
  5. cross-user concealment with `404`; and
  6. provider logout.
- The primary end-to-end path runs at a narrow mobile viewport.

### Implementation addendum / trace context

- Engineering foundation hardening precedes continued workspace capability
  development.
- Backend gates cover published Symfony style, strict types, maximum-level
  PHPStan, Clean Architecture dependency direction, test naming, and a
  120-character PHP line limit.
- JavaScript/TypeScript gates cover deterministic formatting, a 120-character
  line limit, strict type-aware linting, promise/control-flow safety, naming,
  import boundaries, and specified JSDoc conventions.
- Root Make targets are the public quality interface. API, web, production
  build, and end-to-end gates compose `make check`; pre-commit omits Playwright.
- Playwright uses the real Compose stack and serial Chromium, retaining traces,
  screenshots, and HTML reports on failure.
- GitHub Actions runs on pull requests and pushes to `master`.

These engineering standards verify the slice but should not become product
requirements in the canonical PRD.

## `## Delivery sequence`

### Ordered implementation trace

1. `docs(project): define the MVP 0 walking skeleton`
2. `chore(test): establish web tests and GitHub Actions`
3. `feat(auth): add provider-neutral OIDC authentication`
4. `chore(project): enforce engineering standards`
5. `feat(workspaces): deliver workspace onboarding and tenancy`
6. `test(e2e): cover the authenticated workspace golden path`

Each change includes its related tests, passes relevant checks, and updates
affected client and contract together. This sequence is implementation history/
planning trace, not PRD feature priority.

## Stable identifiers

- No formal product requirement IDs appear in this source.
- Stable strings that must not be casually renamed during reconciliation are:
  - capabilities `workspace.read` and `workspace.update`;
  - API error-code categories described above;
  - `Idempotency-Key` and `If-Match` request contracts;
  - workspace fields `name`, `locale`, and `defaultCurrency`; and
  - pagination parameters `page[after]` and `page[size]`.
- Route paths and HTTP status codes are stable API-contract trace, not product
  requirement IDs.

## Dependencies and sequencing constraints

- Authoritative product requirements govern domain behavior over this plan.
- The referenced UI/UX and visual-design plans govern MVP 0 browser completion.
- Engineering-foundation hardening must precede further workspace capability
  development.
- Authentication and a verified external identity precede workspace operations.
- Authorization and caller-specific revision validation precede persistence
  updates.
- MVP 0 establishes the workspace database context; RLS for tenant domain data
  begins when MVP 1 introduces sites, locations, and assets.
- The end-to-end acceptance path depends on the complete real Compose stack.

## Conflicts and missing decisions for reconciliation

No internal contradiction is explicit in this source. Check the authoritative
sources for these possible gaps or scope-boundary issues:

- **MVP numbering:** MVP 0 explicitly excludes assets, schedules, and jobs, so
  it proves platform/workspace foundations rather than the full maintenance
  value loop. The canonical PRD must distinguish MVP 0 from the broader
  first-version/MVP scope without treating exclusions as permanent non-goals.
- **Members without invitations:** member read capability is defined, while
  invitations are excluded from MVP 0. This is compatible as future-facing
  authorization design, but the source does not define how non-owner
  memberships originate during this slice.
- **Workspace creation volume/lifecycle:** any authenticated user may create
  workspaces “at any time,” but limits, deletion, archival, ownership transfer,
  and last-owner behavior are not decided here.
- **Profile synchronization:** verified email, display name, and avatar are
  synchronized, but conflict/update timing and user-editability are not stated.
- **Locale/currency semantics:** validation is specified, but defaulting,
  mutability effects, and historical interpretation are not stated here.
- **Audit visibility/retention:** events to record are named, but who can view
  them, retention, and product-facing audit behavior are not defined here.
- **Idempotency expiry:** the 90-day retention is explicit, but post-expiry
  replay behavior is only implicit and should remain contract/addendum detail
  unless another source elevates it.
- **API versus PRD ownership:** JSON:API shapes, routes, status codes, storage,
  libraries, CI gates, and delivery commits are sufficiently detailed for
  implementation trace. They should not be promoted into canonical product
  requirements unless corroborated by the authoritative requirements.

## Canonical PRD coverage obligations from this source

The reconciled PRD should retain, at the appropriate release level:

- MVP 0's mobile-first authenticated workspace walking skeleton and explicit
  exclusions;
- verified external identity and provider-neutral identity semantics;
- workspace create/edit/switch/onboarding behavior and fields;
- owner/member capabilities and the rule that clients consume capabilities;
- strict cross-workspace isolation and non-disclosing `404` behavior;
- optimistic concurrency with user-preserving stale-edit recovery;
- retry-safe workspace creation;
- auditability of identity, workspace, and membership changes; and
- the narrow-mobile real-stack acceptance journey.

Implementation technologies, dependency lists, storage mechanics, code-quality
rules, CI wiring, and commit sequence belong in trace/addenda rather than the
canonical body unless another authoritative source makes them product-level
constraints.
