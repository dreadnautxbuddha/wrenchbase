# MVP 0 Delivery Runbook

This runbook turns the [MVP 0 implementation plan](mvp-0-implementation-plan.md)
into bounded implementation packages. It controls delivery order and review
stops; it does not replace the product requirements, architecture, API
contract, UI/UX plan, or visual design.

Use this runbook when handing one package at a time to an implementation agent.
Do not ask an agent to implement the whole milestone in one pass.

## Authority and package rules

Before every package, the implementer must read the root instructions and the
nearest application instructions, then read the documents named by that
package. When documents disagree, stop and surface the conflict instead of
silently choosing a new product rule.

Each package must:

- start from the reviewed result of its prerequisite packages;
- stay inside its stated scope and exclusions;
- keep API business rules and persistence authoritative;
- add behavior tests in every affected application;
- update manifests and lockfiles only through the relevant package manager;
- update contract, setup, or operational documentation changed by the package;
- pass the package checks before committing;
- use one cohesive Conventional Commit with a body describing why, what, and
  verification; and
- stop after the commit and return the result for review.

Do not create empty future layers, speculative abstractions, or MVP 1
capabilities. Refactoring outside the package requires a separately reviewed
change. Never weaken a check to make a package pass.

## Review gate

After each package, the implementer reports:

1. the commit hash and subject;
2. the behavior delivered;
3. the tests and checks run with their results;
4. any deliberate deviation from this runbook or its source documents; and
5. any risk or follow-up that belongs to a later package.

The reviewer inspects the diff and verification evidence before starting the
next package. A later package may not be used to excuse a broken intermediate
state unless this runbook explicitly marks the limitation.

## Package 1: Web test foundation and continuous integration

**Prerequisites:** None.

**Outcome:** Browser behavior can be tested locally and the repository's
existing API and web checks run automatically for pushes and pull requests.

### Scope

- Add Vitest, a DOM test environment, Testing Library, user-event support, and
  accessible DOM matchers to the web application.
- Add test setup and scripts for a single run and watch mode. Include the test
  suite in the normal web check without making watch mode part of CI.
- Add one small behavior-focused test around the existing browser entry point
  to prove TypeScript, JSX, DOM matchers, and user interaction work together.
- Add `make web-test` and make the root `check` target run API QA, web static
  checks, and web tests.
- Add a GitHub Actions workflow for pushes to `master` and pull requests. Use
  the repository's container workflow and retain useful logs when a check
  fails.
- Update contributor commands where the public development workflow changes.

### Acceptance

- Tests follow the repository's nested Given/When/Then suite convention.
- A failing web test makes both the web test command and CI fail.
- Existing API tests, linting, and type checking still run.
- CI does not yet install browsers or run the real-stack end-to-end suite.

### Verify

```shell
make web-test
make check
docker compose config --quiet
```

**Commit:** `chore(test): establish web tests and continuous integration`

**Excluded:** Product UI, OIDC, Playwright, and workspace behavior.

## Package 2: Visual and accessibility foundation

**Prerequisites:** Package 1.

**Outcome:** The browser has one centralized implementation of the approved
MVP 0 visual language and a small set of tested presentation primitives.

### Scope

- Implement the semantic color, typography, spacing, radius, shadow, motion,
  and focus tokens from the visual-design specification in the global
  Tailwind layer.
- Configure Nunito Sans with an appropriate system fallback through supported
  Next.js font handling.
- Implement only the shared primitives required by MVP 0: buttons, labeled
  text and select fields, alerts, status badges, content surfaces, and public
  and authenticated shells.
- Give primitives explicit hover, focus, pressed, disabled, busy, help, and
  error behavior where applicable.
- Replace the generated starter presentation with the approved signed-out
  shell and sign-in presentation. Keep the action injectable so real OIDC can
  be connected later without putting authentication logic in the component.
- Add component tests for semantics, keyboard interaction, accessible names,
  described errors, busy state, and reduced-motion-safe behavior.

### Acceptance

- Feature presentation can consume semantic tokens and shared variants without
  repeating raw palette values.
- The page reflows at a 320-pixel CSS viewport and does not introduce ordinary
  page-level horizontal scrolling.
- The primary action and editable controls meet the approved target sizes.
- The temporary sign-in action is clearly isolated at the application boundary
  and is not presented as completed authentication.

### Verify

```shell
make web-test
make web-check
```

Perform a focused keyboard, 200 percent zoom, narrow reflow, light appearance,
dark appearance, and reduced-motion review.

**Commit:** `feat(web): establish the accessible visual foundation`

**Excluded:** OIDC behavior, workspace screens, a general-purpose component
library, illustrations, and MVP 1 patterns.

## Package 3: Local OpenID Connect environment

**Prerequisites:** Package 1.

**Outcome:** The development stack provides a repeatable, pinned Keycloak
issuer configured for Wrenchbase browser and API integration.

### Scope

- Add a pinned Keycloak service to the root Compose project with a committed
  development realm import.
- Configure a public browser client for Authorization Code with PKCE S256.
  Disable implicit and direct-access password grants.
- Add two development users with verified email addresses and no secrets that
  could be mistaken for production credentials.
- Map `email` and `email_verified` into access tokens and configure the API
  audience expected by Wrenchbase.
- Add health and dependency behavior so the stack becomes ready predictably.
- Add configurable issuer, audience, client, redirect, and logout settings to
  the documented development environment without coupling API code to
  Keycloak.
- Add a repeatable integration check that proves discovery is available and a
  development access token contains the required claims.

### Acceptance

- Recreating the Compose stack imports the same realm without manual console
  configuration.
- The browser client has no client secret and requires PKCE.
- The access-token check covers audience, subject, verified email, and email.
- No production secret or fixed production URL is committed.

### Verify

```shell
docker compose config --quiet
make up
```

Run the package's OIDC integration check, then confirm the existing health and
repository checks pass.

**Commit:** `chore(auth): add the local OIDC development environment`

**Excluded:** API token acceptance, user provisioning, and browser sign-in.

## Package 4: API authentication and user profile

**Prerequisites:** Packages 1 and 3.

**Outcome:** The API validates provider-neutral bearer tokens, provisions a
Wrenchbase identity safely, and exposes the authenticated profile.

### Scope

- Add the required JWT, cache, internationalization, and PHP extension
  dependencies with their container support.
- Introduce migrations and persistence for users, external identities, and
  audit events using application-generated UUIDv7 identifiers and UTC
  instants.
- Implement the Application-owned identity boundary and an OIDC infrastructure
  adapter using discovery and cached JWKS.
- Validate issuer, audience, expiry, subject, email, and verified-email status.
  Key identities by issuer and subject; synchronize safe profile fields without
  storing tokens.
- Provision or update the local profile and identity-link audit record in a
  transaction that is safe under concurrent first requests.
- Establish the minimal internal JSON:API document and error support needed by
  this package, including stable authentication codes and correlation IDs.
- Implement `GET /api/v1/me` and its CORS behavior.
- Add isolated and HTTP tests for successful validation and provisioning,
  repeat access, claim rejection, invalid tokens, concurrency safety, response
  shape, audit behavior, and secret redaction.

### Acceptance

- API application and domain code do not import a Keycloak SDK.
- A missing or invalid bearer token cannot create or expose a user.
- An unverified email is rejected with a stable safe error.
- Access and refresh tokens never enter application persistence or logs.
- The profile response uses JSON:API 1.1 and exposes only the planned fields.

### Verify

```shell
make api-qa
docker compose config --quiet
```

Run the real-issuer authentication integration test in addition to isolated
token-validation tests.

**Commit:** `feat(auth): add provider-neutral API authentication`

**Excluded:** Workspace persistence, membership authorization, and browser
authentication.

## Package 5: Workspace read and creation API

**Prerequisites:** Package 4.

**Outcome:** An authenticated user can create, list, and read isolated
workspaces through the documented API contract.

### Scope

- Add workspace, membership, and idempotency-record persistence with UUIDv7
  identifiers, revisions, UTC instants, constraints, and the restricted
  runtime database role foundation.
- Introduce the workspace database-context abstraction without enabling RLS on
  control-plane tables.
- Implement workspace name, locale, and currency validation in the API.
- Implement `GET /api/v1/workspaces`, `POST /api/v1/workspaces`, and
  `GET /api/v1/workspaces/{workspaceId}` with JSON:API documents.
- Return caller-specific role and named capabilities without requiring clients
  to derive permissions from the role.
- Implement deterministic cursor pagination and reject unsupported query
  parameters.
- Authorize before scoped lookup so a workspace unavailable to the caller
  returns the same `404` as a missing workspace.
- Implement persisted create idempotency, fingerprint checks, replay, atomic
  owner membership and audit creation, and the expiry-pruning command.
- Configure the narrow web-origin CORS headers required for these requests.
- Document the workspace capability's routes, resources, validation, errors,
  pagination, capabilities, and idempotency behavior.

### Acceptance

- A creator becomes the first owner in the same transaction as the workspace.
- A matching idempotent replay returns the original successful result; misuse
  returns the planned conflict without creating duplicate data.
- Pagination remains stable when names change and never exposes another user's
  workspaces.
- Tests cover validation boundaries, ownership, capabilities, isolation,
  pagination, unsupported queries, JSON:API media, audit events, replay,
  misuse, and pruning.

### Verify

```shell
make api-qa
```

Apply migrations to a clean database and exercise the endpoints with real
tokens from the local issuer.

**Commit:** `feat(workspaces): add workspace creation and isolated reads`

**Excluded:** Workspace updates, invitations, member administration, sites,
and RLS for future tenant-owned domain tables.

## Package 6: Browser authentication and onboarding

**Prerequisites:** Packages 2, 4, and 5.

**Outcome:** A browser user can sign in through the configured issuer, load the
Wrenchbase session, reach onboarding when they have no workspace, and sign out
through the provider.

### Scope

- Add TanStack Query, Zod, `oidc-client-ts`, and `react-oidc-context` with
  manifest and lockfile updates.
- Configure Authorization Code with PKCE using browser composition and
  environment-provided issuer and client settings.
- Store both OIDC user data and authorization-request state in
  `sessionStorage`; never copy bearer tokens into cookies or `localStorage`.
- Implement the public entry route, callback route, authenticated route gate,
  no-membership onboarding route, account menu, and provider logout.
- Implement Application ports and Infrastructure adapters for profile and
  workspace-list requests, bearer headers, runtime JSON:API parsing, error
  mapping, and exposed correlation information.
- Keep Next.js pages and providers thin and keep browser-only code out of the
  server module graph.
- Handle redirect progress, invalid or expired callback, temporary network
  failure, session expiry, no-membership guidance, and logout recovery as
  specified by the UI/UX plan.
- Add tests for routing decisions, safe return destinations, session storage,
  callback cleanup, profile parsing, onboarding, logout, and accessible focus
  and announcements.

### Acceptance

- Authentication succeeds against the real local issuer without requesting
  credentials inside Wrenchbase.
- An arbitrary external return URL is never accepted.
- An authenticated user with no memberships reaches onboarding without a
  redirect loop.
- No token or meaningful server data is persisted in `localStorage`.
- The signed-out, callback, onboarding, account, and error states use the
  approved shared visual primitives.

### Verify

```shell
make web-test
make web-check
make api-qa
```

Manually verify keyboard-only sign-in and logout against the local Compose
stack at narrow and desktop viewports.

**Commit:** `feat(auth): add browser sign-in and onboarding`

**Excluded:** Workspace creation UI, workspace switching, settings, and stale
edit recovery.

## Package 7: Workspace creation, overview, and switching

**Prerequisites:** Package 6.

**Outcome:** An authenticated user can create a workspace, see its overview,
and switch between explicit workspace routes.

### Scope

- Implement `/workspaces/new` and `/workspaces/{workspaceId}` using thin Next.js
  delivery routes and the approved application boundaries.
- Build the accessible creation form in the specified name, locale, currency
  order with browser-informed but editable suggestions.
- Generate a UUID idempotency key at the application boundary and reuse it for
  transport retries of the same submission.
- Add Application use cases and Infrastructure adapters for workspace create
  and read operations, JSON:API parsing, validation errors, and capabilities.
- Implement the authenticated shell's workspace switcher and confirmed
  last-selected workspace behavior. Store only that workspace UUID in
  `localStorage`.
- Render the workspace overview, role context, settings summary, and only the
  controls supported by returned capabilities and implemented routes.
- Cover loading, empty, validation, unauthorized, not-found, network, long
  content, and unexpected-correlation-ID states.
- Add tests for field behavior, retry-key reuse, switching, revoked-selection
  fallback, explicit routes, capability-driven controls, error mapping,
  keyboard interaction, and focus movement.

### Acceptance

- Successful creation navigates to the explicit route returned by the API.
- A duplicate transport attempt cannot create a second workspace.
- Workspace choice changes only after the selected destination is confirmed
  available.
- Missing and cross-workspace identifiers have indistinguishable browser
  treatment.
- The workflows remain usable at 320 pixels, 200 percent zoom, by keyboard,
  and with representative screen-reader output.

### Verify

```shell
make web-test
make web-check
make api-qa
```

Exercise creation and switching against the real local stack with both
development users.

**Commit:** `feat(workspaces): add workspace onboarding and switching`

**Excluded:** Workspace editing, invitations, membership management, and asset
navigation.

## Package 8: Workspace update and concurrency API

**Prerequisites:** Package 5.

**Outcome:** Authorized owners can update workspace settings with
representation-specific optimistic concurrency and complete audit history.

### Scope

- Implement `PATCH /api/v1/workspaces/{workspaceId}` for name, locale, and
  default currency using the same validated domain concepts as creation.
- Return an opaque revision and strong ETag derived from workspace revision,
  caller membership revision, and actor identity.
- Require `If-Match`; distinguish missing preconditions, stale
  representations, domain conflicts, validation failures, unauthorized
  callers, and unavailable resources with the planned status and stable code.
- Authorize before lookup, then use the workspace revision as the persistence
  compare-and-swap value.
- Record successful updates in the audit table and return the normalized
  resulting representation.
- Expose `ETag`, `Location`, and correlation headers through the narrow CORS
  policy.
- Update the workspace capability documentation with the request, response,
  revision, error, and authorization contract.

### Acceptance

- A member without `workspace.update` cannot mutate a workspace.
- Strong ETags differ when caller-specific representation inputs differ.
- Concurrent requests cannot silently overwrite one another.
- `428`, `412`, and `409` retain their distinct meanings.
- API tests cover owner success, member rejection, missing and stale
  preconditions, caller-specific ETags, compare-and-swap races, normalization,
  isolation, JSON:API documents, and audit events.

### Verify

```shell
make api-qa
```

Exercise two real-token update requests against the same starting ETag and
confirm exactly one succeeds.

**Commit:** `feat(workspaces): add optimistic workspace updates`

**Excluded:** Browser settings UI, automatic conflict merging, invitations,
and membership administration.

## Package 9: Workspace settings and stale-edit recovery

**Prerequisites:** Packages 7 and 8.

**Outcome:** Authorized owners can edit workspace settings, and stale edits are
preserved for explicit comparison and resubmission.

### Scope

- Implement `/workspaces/{workspaceId}/settings` with the creation form's
  shared field controls and ordering.
- Show the Edit settings action only when the representation includes
  `workspace.update`.
- Capture and pass ETags through the read and update Application boundaries;
  use the normalized returned representation after success.
- Protect in-app navigation when the form is dirty and provide an honest
  best-effort browser-exit warning.
- On `412`, retain every entered value, load the latest representation, and
  display only differing current and local values in the conflict region.
- Implement Use current values, Review my edits, and Retry comparison exactly
  as specified. Never retry or resubmit a conflict automatically.
- Handle validation, unauthorized, not-found, network, session-expired, and
  unexpected-error states without losing safe input.
- Add tests for capability visibility, ETag forwarding, successful
  normalization, dirty navigation, conflict comparison, failed comparison,
  deliberate resubmission, focus movement, announcements, and keyboard use.

### Acceptance

- A stale edit never overwrites a newer value without a second explicit Save.
- Choosing current values replaces the form; reviewing edits rebases without
  submitting.
- The conflict UI does not rely on color and identifies current versus local
  values programmatically.
- The settings flow passes the approved mobile, zoom/reflow, keyboard, focus,
  contrast, and representative screen-reader checks.

### Verify

```shell
make web-test
make web-check
make api-qa
```

Manually produce a stale update in two browser tabs and verify both recovery
choices against the real stack.

**Commit:** `feat(workspaces): add accessible workspace settings`

**Excluded:** Automatic field merging, offline editing, invitations, and
expanded MVP 1 workspace settings.

## Package 10: Real-stack golden path and milestone hardening

**Prerequisites:** Packages 1 through 9.

**Outcome:** One automated browser path proves the complete MVP 0 stack and all
documented completion criteria are verified.

### Scope

- Add Playwright with serial Chromium execution against the real Compose stack.
- Automate the implementation plan's complete golden path: first-user sign-in,
  two workspace creations, switching, editing, two-tab stale recovery,
  second-user private workspace creation, first-user isolation checks through
  both browser and API, and provider logout.
- Run the primary path at a narrow mobile viewport. Retain traces, screenshots,
  and the HTML report on failure without retaining tokens or secrets.
- Add `make e2e`; include the end-to-end suite in the final root `check`
  workflow and GitHub Actions job with deterministic service readiness.
- Verify clean-database migrations, idempotency pruning, health endpoints,
  configuration validation, and repeat execution from a fresh stack.
- Complete and record the manual accessibility review for keyboard operation,
  focus, 200 percent zoom, 320-pixel reflow, light and dark contrast, reduced
  motion, and representative screen-reader output.
- Reconcile README, contribution, deployment, API capability, and environment
  documentation with the implemented commands and configuration.

### Acceptance

- The golden path uses real Keycloak, Next.js, Symfony, and PostgreSQL services
  rather than mocked network boundaries.
- Cross-workspace access remains indistinguishable from missing data.
- Failure artifacts are useful and redact authentication material.
- `make check` is the complete MVP 0 local and CI gate.
- The implementation plan, UI/UX plan, visual design, API contract, and shipped
  behavior agree.

### Verify

```shell
make down
make up
make check
```

Run the final checks twice from a clean database to expose ordering,
idempotency, or state-leak failures.

**Commit:** `test(e2e): cover the authenticated workspace golden path`

**Excluded:** Production deployment hardening, backup restoration, invitations,
assets, offline behavior, and every MVP 1 or later capability.

## Handoff prompt

Use a prompt shaped like this for each implementation session:

```text
Implement Package <number>: <title> from docs/mvp-0-delivery-runbook.md.

Read AGENTS.md, the nearest application AGENTS.md files, and every source
document referenced by that package. Inspect the current worktree and confirm
the prerequisite packages are present. Implement only this package, including
its tests and documentation. Run every listed verification command, create the
specified cohesive commit with a detailed body, then stop and report the commit,
checks, deviations, risks, and later-package follow-ups. Do not begin the next
package.
```

The reviewer may add a narrow correction to the prompt after inspecting the
previous package, but should not broaden two packages into one implementation
turn.
