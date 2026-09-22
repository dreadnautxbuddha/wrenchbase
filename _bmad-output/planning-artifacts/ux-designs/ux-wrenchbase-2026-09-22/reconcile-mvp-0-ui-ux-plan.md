---
source: ../../../../docs/mvp-0-ui-ux-plan.md
status: final
updated: 2026-09-22
---

# Reconciliation: MVP 0 UI/UX Plan

## Migration verdict

The plan is the approved MVP 0 behavioral application of the product-wide UX
principles. Its route model, workflows, state behavior, responsive rules,
accessibility rules, and acceptance inventory migrate primarily to
`EXPERIENCE.md`. Its layout constraints and visual-accessibility consequences
migrate to `DESIGN.md`; appearance continues to come from the approved visual-
design source.

The plan is retained after canonical UX approval as guidance and migration
evidence. It may be reconsidered only if a separately approved deletion
checkpoint proves heading-complete coverage. The canonical PRD controls
vocabulary, behavior, and milestone boundaries. No new screen, route,
navigation system, component, or visual direction is inferred.

## Heading-complete mapping

### `# MVP 0 UI/UX Plan`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; retained until separate
source-retirement approval.

Migrate MVP 0 browser information architecture, responsive behavior,
interaction states, and accessibility behavior. Preserve the plan's relationship
to the canonical PRD, PRD addendum, product-wide UX brief, and approved MVP 0
visual design. `EXPERIENCE.md` and `DESIGN.md` remain peer contracts.

**Dropped qualitative detail:** none.

### `## Design objective`

**Classification:** `EXPERIENCE.md`.

Authentication and Workspace context feel trustworthy, obvious, and lightweight
on phone and desktop. A user can determine sign-in state, active Workspace,
available actions, operation outcome or needed attention, and how to switch
Workspace or sign out. MVP 0 is a durable foundation, not a placeholder, but it
does not advertise unavailable Assets, Jobs, Due Work, or notification-center
destinations.

**Dropped qualitative detail:** none.

### `## Planning and review process`

**Classification:** retained focused review method; validation evidence for
both spines.

Retain the seven-stage process: frame workflow; map happy, alternate, and
recovery paths; review low-fidelity hierarchy and content; stress states; review
responsive and accessible behavior; apply visual direction after interaction
stability; record decisions and acceptance criteria. Structural review precedes
appearance; later visual refinement cannot alter routes or application
boundaries.

The process informs the UX review outputs rather than becoming product behavior.

**Dropped qualitative detail:** none.

### `## Scope`

**Classification:** `EXPERIENCE.md`; deferred invitation work; unresolved
conflict UX-OQ-2.

Migrate the named MVP 0 browser experiences: public sign-in; OIDC redirect and
callback; no-Membership onboarding; Workspace creation; Workspace overview;
basic Workspace settings editing; Workspace switching; stale-edit recovery;
Unauthorized, Not found, Validation, and network recovery; and provider logout.

Invitation acceptance and Membership management remain MVP 1. MVP 0 onboarding
may explain owner-sent invitations but cannot present a non-functional
invitation workflow.

**Conflict — UX-OQ-2:** the plan and detailed MVP 0 contract include basic
Workspace settings and stale editing, while the canonical PRD milestone summary
names settings under MVP 1. Do not silently choose a milestone interpretation.

**Dropped qualitative detail:** none.

### `## Route map`

**Classification:** `EXPERIENCE.md`; retained technical boundary; unresolved
conflict UX-OQ-2.

Migrate the complete MVP 0 route contract:

- `/` — signed-out entry; authenticated routing to onboarding, last valid
  Workspace, or first available Workspace.
- `/auth/callback` — completes OIDC callback and permits only a validated in-app
  destination, never an arbitrary external return URL.
- `/onboarding` — authenticated user without a Workspace; explains the two valid
  next steps without an MVP 0 invitation form.
- `/workspaces/new` — Workspace creation.
- `/workspaces/{workspaceId}` — Workspace overview and canonical authenticated
  MVP 0 landing route.
- `/workspaces/{workspaceId}/settings` — edits Workspace name, locale, and
  default currency, subject to UX-OQ-2.

An authenticated user with Memberships is redirected away from onboarding.
They may create another Workspace, and **Create workspace** remains the final
Workspace-switcher action.

Thin Next.js route delivery and application-boundary delegation remain focused
architecture constraints, not user-facing behavior.

**Dropped qualitative detail:** none.

### `## Application shells`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`.

Migrate the public and authenticated shell contracts below. `EXPERIENCE.md`
owns regions, visibility, action placement, and responsive behavior;
`DESIGN.md` owns their visual layout and treatment.

**Dropped qualitative detail:** none.

### `### Public shell`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`.

The shell contains the Wrenchbase name, one concise product statement, primary
sign-in action, and authentication status or recovery message. It remains calm
and focused, does not imitate a marketing site, and provides no unavailable
product navigation. Narrow layouts use available width with safe edge spacing;
desktop uses a compact centered column.

**Dropped qualitative detail:** none.

### `### Authenticated shell`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; deferred future navigation;
unresolved question UX-OQ-1.

The shell has a top application bar with Wrenchbase home action, active
Workspace switcher, and account menu containing signed-in identity and
**Sign out**. Main content begins with route-specific heading and context.
Consequential actions remain near the affected resource rather than in a global
toolbar.

Mobile may wrap or compact the top bar but cannot hide the Workspace name.
Desktop retains the top bar and constrained main column. MVP 0 has no bottom
navigation and no empty sidebar. Later navigation can be added only when real
destinations exist and without changing the explicit Workspace route boundary.

**Open question — UX-OQ-1:** no active Workspace exists on authenticated
no-Membership onboarding or some authentication-transition surfaces. Do not
invent a placeholder Workspace or switcher state.

**Dropped qualitative detail:** none.

### `## Sign-in and callback`

**Classification:** `EXPERIENCE.md`; `DESIGN.md` state support.

The signed-out entry has one primary **Sign in** action. Copy says
authentication continues with the configured identity provider; the product
does not request credentials or name a development provider. Redirect start
prevents duplicate submission and is announced. Start failure restores the
action, retains the safe return destination, and gives retryable recovery.

The callback has a stable page title and progress message while tokens and the
Wrenchbase profile are validated. Success redirects immediately. Failure
distinguishes invalid or expired attempts from temporary network failure and
offers **Start again**. Raw provider and token detail is never rendered.

**Dropped qualitative detail:** none.

### `## No-membership onboarding`

**Classification:** `EXPERIENCE.md`; deferred invitation acceptance; unresolved
question UX-OQ-1.

Welcome the signed-in user by display name when available and explain why no
Workspace is visible. Present **Create a workspace** as primary and explain that
an existing Workspace owner must invite the user's verified email address.
Guidance is informational in MVP 0: no Workspace discovery, self-service join
request, or invitation entry field.

**Dropped qualitative detail:** none.

### `## Workspace creation`

**Classification:** `EXPERIENCE.md`; `DESIGN.md` form treatment; unresolved
question UX-OQ-9.

Use this form order and shared control identity: **Workspace name**,
**Locale**, **Default currency**. Locale and currency may begin with browser-
informed suggestions but remain explicit editable choices, never identity or
location inference. Workspace locale is not silently treated as interface
language.

Place primary **Create workspace** at the end; secondary **Cancel** returns to a
safe prior route. Submission keeps values visible, prevents duplicates, and
reuses its idempotency key for safe transport retries. Validation is adjacent
to its field; multiple invalid fields also receive a focusable error summary.
Success navigates to the new overview and is announced.

**Open question — UX-OQ-9:** the safe **Cancel** destination for direct entry
without a prior valid route is unspecified.

**Dropped qualitative detail:** none.

### `## Workspace overview`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; unresolved conflict UX-OQ-2.

The overview establishes Workspace context rather than simulating an empty
dashboard. It shows Workspace name as heading, caller role as secondary context,
a Settings summary with locale and default currency, and **Edit settings** only
when `workspace.update` is returned. A Member without that Capability sees the
values but no disabled or misleading action. No placeholder Assets, Jobs, Due
Work, or notification-center cards appear.

Control visibility is Capability-driven; role display does not authorize an
action.

**Dropped qualitative detail:** none.

### `## Workspace settings`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; unresolved conflict UX-OQ-2.

Reuse the Workspace-creation field order and controls. Heading and breadcrumb
identify the active Workspace. **Save changes** is the only primary action;
**Cancel** returns to overview without submitting. In-app navigation with
unsaved edits asks whether to discard or continue editing. Browser-level
protection is best effort and cannot promise preservation after close.

Success updates overview and switcher from the API's returned representation,
never predicted normalization.

**Dropped qualitative detail:** none.

### `## Stale-edit recovery`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; unresolved conflicts UX-OQ-2
and UX-OQ-3.

On `412 Precondition Failed`, retain every entered value and place an in-page
conflict region before form actions. Explain that the Workspace changed and
nothing from the current form was saved. Load the latest representation and
show only differing fields: **Current value** for the API value and **Your
edit** for the retained value.

**Use current values** replaces the form. **Review my edits** rebases retained
work onto the latest ETag and marks values that would overwrite newer data.
Neither path automatically saves; the user explicitly presses **Save changes**
again. Comparison-load failure preserves the form and offers **Retry
comparison**. A stale conflict is never reduced to a generic toast or blindly
retried.

**Open question — UX-OQ-3:** sources do not say whether **Review my edits**
adopts server-changed fields the user did not edit.

**Dropped qualitative detail:** none.

### `## Workspace switcher and account menu`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; unresolved question UX-OQ-1.

On applicable authenticated Workspace surfaces, the switcher trigger shows the
active Workspace name rather than only an icon. Its menu lists available
Workspaces, identifies the active item without color alone, and ends with
**Create workspace**. Selection navigates to the explicit overview and updates
the last-selected identifier only after destination availability is confirmed.
A missing or revoked selection falls back to another Membership or onboarding
without a redirect loop.

The account menu shows display name, verified email, and **Sign out**. Provider
logout prevents duplicate action; recoverable failure warns that the session
may remain active and offers **Retry**. Menus close with Escape, return focus to
their triggers, support ordinary keyboard navigation, and are mutually
exclusive.

**Dropped qualitative detail:** none.

### `## Page and operation states`

**Classification:** `EXPERIENCE.md`; `DESIGN.md` state presentation;
applicability override; unresolved question UX-OQ-6.

Migrate the named state rules:

- **Loading:** preserve eventual structure and concise status; no indefinite
  blank screen or avoidable layout jump.
- **Empty:** explain the next valid action; do not disguise Unauthorized or
  offline/disconnected conditions as Empty.
- **Validation:** retain safe input, associate field errors, and focus summary
  or first invalid field after submission.
- **Network failure:** explain that the server is unreachable and offer a retry
  that cannot duplicate work.
- **Unauthorized:** explain the denied action and return to a safe Workspace
  route; omit controls already known unavailable through Capabilities.
- **Not found:** use the same experience for missing and cross-Workspace
  resources, without disclosing ownership.
- **Session expired:** preserve non-sensitive input during approved in-page
  renewal; warn about possible loss before a required provider redirect unless
  a separately reviewed session-scoped recovery exists. Never persist tokens or
  meaningful drafts in `localStorage`.
- **Unexpected error:** show copyable correlation context without stack trace or
  internal response.

Inline messages own page and form state. Transient announcements confirm
already-visible results; a toast is never the sole error record.

**Applicability override:** a route receives relevant states, not meaningless
variants of every state. A disconnected state does not imply offline-capable
work. Preserve distinct `409` semantic conflict, `412` stale revision, `422`
validation/domain error, `428` missing precondition, authentication, and network
failure behavior.

**Open question — UX-OQ-6:** the source does not define user-facing recovery for
`428` missing precondition.

**Dropped qualitative detail:** none.

### `## Responsive behavior`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`.

Design and test from a 320-pixel-wide viewport upward. MVP 0 forms stay one
column. Touch targets are approximately 44 pixels in both dimensions; editable
text cannot trigger mobile browser zoom; controls do not require horizontal
scrolling. Wider layouts add surrounding space instead of unnecessary columns.
The overview may place a compact action beside its heading, while reading and
keyboard order remains mobile order. Labels remain above controls.

Long Workspace names truncate only where adjacent accessible text or the opened
switcher exposes the full value. Errors and user content wrap rather than clip.

**Dropped qualitative detail:** none.

### `## Accessibility behavior`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`.

Migrate all requirements: semantic header, navigation, and main landmarks; one
descriptive `h1` and unique title per route; aligned DOM, visual, reading, and
keyboard order; native links, buttons, inputs, and selects before custom
controls; visible focus and focus restoration after menus/dialogs; accessible
field descriptions; announcements for asynchronous save, redirect, and errors
without announcing every loading animation; non-color-only active Workspace,
Validation, and conflict states; reduced-motion support with no decorative auth
or loading motion; and testing of zoom, text enlargement, narrow reflow,
keyboard-only use, and representative screen-reader output.

**Dropped qualitative detail:** none.

### `## Content and visual direction`

**Classification:** `EXPERIENCE.md` voice; `DESIGN.md` presentation.

`EXPERIENCE.md` uses direct, calm language appropriate for a garage, workshop,
or personal Asset collection. Prefer concrete labels such as **Create
workspace**, **Edit settings**, **Try again**, and **Sign out**; avoid enterprise
administration language when a simpler phrase is accurate.

`DESIGN.md` receives appearance from the approved visual-design source, not
from new exploration. Structure remains stable before appearance. Establish
only tokens needed by implemented screens, then evolve with actual product
scope.

**Dropped qualitative detail:** none.

### `## Wireframe review set`

**Classification:** retained review evidence; `.working/` mockup candidates;
unresolved conflict UX-OQ-2.

The complete supported review inventory is mobile and desktop versions of:

1. Sign-in.
2. No-Membership onboarding.
3. Workspace creation.
4. Workspace overview with switcher open.
5. Workspace settings.
6. Workspace settings after a stale edit.

Review happy path and the most consequential recovery state for each. Use
realistic Workspace names, locale, currency, identity, and long text rather
than placeholder Latin. Any generated render remains illustrative in
`.working/`; it cannot establish a requirement and requires explicit approval
before promotion. Settings mockups remain subject to UX-OQ-2.

**Dropped qualitative detail:** none.

### `## UX acceptance checklist`

**Classification:** `EXPERIENCE.md` validation; retained focused review and test
evidence; `DESIGN.md` visual-accessibility validation.

Retain all acceptance outcomes: every screen and recovery state has a route
owner; active Workspace remains visible on applicable authenticated Workspace
surfaces; no later Capability is advertised; create and update preserve input;
stale edits require comparison and resubmission; privileged controls follow
Capabilities; 320-pixel layout avoids horizontal scrolling; keyboard focus is
sensible; screen-reader labels and asynchronous announcements are specified;
and Playwright/Vitest scenarios can be derived from the contract.

Visual refinements may continue only when they do not change the interaction
contract.

**Dropped qualitative detail:** none.

## Route, screen, and surface inventory

### Routes

- `/`
- `/auth/callback`
- `/onboarding`
- `/workspaces/new`
- `/workspaces/{workspaceId}`
- `/workspaces/{workspaceId}/settings` — subject to UX-OQ-2

### Screens and surfaces

- Public shell and signed-out Sign-in.
- OIDC callback.
- No-Membership onboarding.
- Authenticated shell.
- Workspace creation.
- Workspace overview.
- Workspace settings — subject to UX-OQ-2.
- Workspace settings stale-edit conflict region — subject to UX-OQ-2 and
  UX-OQ-3.
- Workspace switcher and open menu.
- Account menu.
- Unsaved-edit navigation decision.
- Route-owned applicable state presentations.

### Named components and controls

- top application bar; Wrenchbase home action; active Workspace switcher;
  account menu; route-specific heading; breadcrumb; Settings summary.
- Workspace form controls: **Workspace name**, **Locale**, **Default currency**.
- field help/error, focusable error summary, in-page conflict region, comparison
  row, and copyable correlation context.
- **Sign in**, **Start again**, **Create a workspace**, **Create workspace**,
  **Cancel**, **Edit settings**, **Save changes**, **Use current values**,
  **Review my edits**, **Retry comparison**, **Try again**, **Sign out**, and
  **Retry**.

## State inventory

- Loading, Empty, Validation, Network failure, Unauthorized, Not found, Session
  expired, Unexpected error, Success announcement, semantic conflict, stale
  revision, missing precondition, and disconnected/offline-unavailable where
  applicable.
- Sign-in redirect starting and redirect-start failure.
- Callback validation progress, immediate success redirect, invalid/expired
  attempt, and temporary network failure.
- Workspace creation initial/suggested, submitting, invalid, retryable, and
  successful states.
- Workspace settings pristine, dirty, unsaved-navigation, submitting,
  successful, stale-comparison loading, stale-comparison failure, rebased review,
  use-current, and explicit resubmission states.
- Workspace switching open/closed, active item, destination confirmation, and
  missing/revoked fallback states.
- Provider logout in progress, success, and recoverable failure.

## Overrides, assumptions, and open questions

- Canonical PRD vocabulary and literals replace non-canonical source casing or
  shorthand while approved UI labels remain as written.
- Capability authorization, not displayed role, controls action visibility.
- State coverage is applicability-based and does not confer offline capability.
- UJ-1 anchors the MVP 0 flow; no new protagonist is invented.
- Workspace locale is not assumed to be interface language; UX-OQ-5 remains the
  broader localization decision.
- **UX-OQ-1:** active Workspace and switcher applicability when none exists.
- **UX-OQ-2:** MVP 0 boundary for basic Workspace settings and stale editing.
- **UX-OQ-3:** untouched-field behavior during **Review my edits**.
- **UX-OQ-6:** user-facing missing-precondition recovery.
- **UX-OQ-9:** safe direct-entry **Cancel** destination for Workspace creation.

## Dropped-detail audit

No qualitative UX, route, screen, state, responsive, accessibility, content, or
review detail is intentionally dropped. Next.js delivery mechanics and test
implementation remain in focused technical documents. Future navigation is
deferred until its destinations exist. Settings-related material remains
preserved but unresolved under UX-OQ-2 rather than being silently assigned to a
milestone.
