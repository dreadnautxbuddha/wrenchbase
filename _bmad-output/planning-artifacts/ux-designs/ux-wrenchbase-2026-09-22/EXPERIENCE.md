---
name: Wrenchbase
status: final
approval: approved
approved: 2026-09-22
sources:
  - ../../prds/prd-wrenchbase-2026-09-21/prd.md
  - ../../prds/prd-wrenchbase-2026-09-21/addendum.md
  - ../../../../docs/ux-accessibility.md
  - ../../../../docs/mvp-0-ui-ux-plan.md
  - ../../../../docs/mvp-0-visual-design.md
  - ../../../../docs/architecture.md
  - ../../../../docs/api-contract.md
  - ../../../../docs/offline-sync.md
  - ../../../../docs/security-and-data-lifecycle.md
  - ../../../../docs/mvp-0-delivery-runbook.md
  - ../../../../README.md
updated: 2026-09-22
---

# Wrenchbase — Experience Spine

This approved spine migrates existing interaction decisions. It does not expand
product scope or invent screens. `EXPERIENCE.md` owns how Wrenchbase behaves and
`DESIGN.md` owns how it looks. They are peer contracts and both win over
mockups, wireframes, or imports. The retained source documents remain guidance,
reconciliation evidence, and focused authorities within their documented
boundaries.

## Foundation

Wrenchbase is a mobile-first responsive browser application for individuals,
hobbyists, small garages, workshops, and small teams. Core work begins at a
320-pixel CSS viewport and remains effective on desktop. The browser is the
primary client; a React Native client is planned for the future but is outside
the first-version scope.

The Symfony API is authoritative for business rules, authorization, validation,
persistence, Due Work, notification eligibility, report data, and publication
of synchronized work. The browser owns presentation, interaction, local draft
behavior, and synchronization presentation. Client controls follow returned
Capabilities and never infer permission from role names.

The MVP 0 browser UI uses native controls, React, Tailwind CSS 4, and a small set
of shared primitives; it does not add a third-party component kit. `DESIGN.md`
is the visual identity and token reference. Visual references use its exact
`{path.to.token}` names.

Global rules in this spine apply across the coherent MVP 0–6. Sections labeled
MVP 0 define the approved current application. Later milestone behavior remains
scoped to its PRD milestone and must not appear as empty navigation or invented
screens before implementation.

[OPEN QUESTION UX-OQ-2] The detailed MVP 0 contract, UI/UX plan, and delivery
runbook include basic Workspace locale/currency settings and stale-edit recovery,
while the PRD milestone summary names settings under MVP 1. This draft preserves
the detailed MVP 0 application without silently resolving that milestone wording.

## Information Architecture

### Product-wide navigation model

Every Workspace-scoped route and API request identifies its active Workspace.
Future primary mobile navigation exposes the due-work dashboard, Assets, Jobs,
and notification center. Settings and Workspace management remain reachable but
quieter than field work. These destinations are product-wide commitments, not
MVP 0 navigation: MVP 0 has no bottom navigation and no empty sidebar.

Every consequential action first makes the target Asset, Site, applicable Job
state, and Workspace context visible when those concepts are in scope.
Cross-Workspace identifiers are treated as not found and never reveal another
Workspace.

### MVP 0 route and surface inventory

| Route or surface                                        | Entry                                                | Purpose                                                                                                          | Scope rule                                                             |
| ------------------------------------------------------- | ---------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------- |
| Public entry `/`                                        | Direct visit                                         | Show sign-in when signed out; otherwise route to onboarding, last valid Workspace, or first available Workspace. | Public Shell only; no marketing navigation.                            |
| OIDC callback `/auth/callback`                          | Identity-provider return                             | Validate callback, tokens, and Wrenchbase profile, then continue to a validated in-app destination.              | Never accept an arbitrary external return URL.                         |
| No-Membership onboarding `/onboarding`                  | Authenticated user with no Memberships               | Explain why no Workspace is visible and offer Workspace creation or owner-invitation guidance.                   | No discovery, join request, or invitation-entry screen.                |
| Workspace creation `/workspaces/new`                    | Onboarding or final Workspace Switcher action        | Create a Workspace from name, locale, and default currency.                                                      | Authenticated; retry-safe with one idempotency key per submission.     |
| Workspace overview `/workspaces/{workspaceId}`          | Confirmed Workspace selection or successful creation | Establish Workspace context, role context, settings summary, and Capability-permitted action.                    | Canonical MVP 0 authenticated landing route; no empty dashboard cards. |
| Workspace settings `/workspaces/{workspaceId}/settings` | Edit settings from overview                          | Edit name, locale, and default currency with optimistic concurrency.                                             | `workspace.update` Capability required; see UX-OQ-2.                   |
| Workspace Switcher                                      | Every authenticated surface with an active Workspace | Display and change active Workspace; expose Create workspace.                                                    | Update last-selected Workspace only after destination confirmation.    |
| Account Menu                                            | Every authenticated surface                          | Show signed-in identity and Sign out.                                                                            | Provider logout; recoverable failure offers Retry.                     |
| Stale-edit recovery                                     | In-page on Workspace settings                        | Compare retained local values with the latest representation after `412 Precondition Failed`.                    | Not a separate route or generic toast.                                 |

The Authenticated Shell uses a top application bar with the Wrenchbase home
action, Workspace Switcher, and Account Menu. Route content begins with one
descriptive `h1`. Actions remain near the resource they affect rather than in a
global toolbar.

[OPEN QUESTION UX-OQ-1] Sources say every authenticated screen shows an active
Workspace and Workspace Switcher, but authenticated no-Membership onboarding and
authentication-transition surfaces cannot have an active Workspace. Their exact
exception wording remains unresolved.

### Later milestone surface registry

| Milestone | Existing surfaces or concerns                                                                                        | Status in this spine                                                              |
| --------- | -------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------- |
| MVP 1     | Memberships and invitations, Sites and nested Locations, Asset Types, Assets, Component placement and Reconciliation | Product behavior is sourced; detailed IA and screen design are not invented here. |
| MVP 2     | Maintenance Schedule authoring, Baselines, Meter Readings, Due Work                                                  | Product behavior is sourced; detailed IA deferred.                                |
| MVP 3     | Jobs, Work Items, Maintenance Needs, Evidence, Component replacement                                                 | Global Job interaction rules below apply; detailed surfaces deferred.             |
| MVP 4     | Due-work dashboard, notification center, email preferences, reports                                                  | Named future navigation destinations retained; detailed surfaces deferred.        |
| MVP 5     | Cached Asset trees, offline Job drafting, sync review                                                                | Global offline and conflict rules below apply; detailed screens deferred.         |
| MVP 6     | Production readiness                                                                                                 | No additional end-user surface is established by the supplied UX sources.         |

## Voice and Tone

Microcopy is direct, calm, concrete, and encouraging without baby talk. Use
Wrenchbase terminology exactly. Explain authorization, failures, conflicts,
uncertainty, and historical consequences precisely; never put jokes or cartoon
metaphors inside serious states.

| Do                                                                                                  | Don't                                                                                   |
| --------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------- |
| **Sign in**, **Create workspace**, **Edit settings**, **Save changes**, **Try again**, **Sign out** | Enterprise-administration wording when a simpler action is accurate.                    |
| Describe the operation while busy, for example **Creating workspace…**                              | Generic **Working…** when the action can be named.                                      |
| Say what happened, what was preserved, and the next valid action.                                   | Use a generic error or toast as the only record of failure.                             |
| Distinguish **Current value** from **Your edit**.                                                   | Describe a stale edit as catastrophic or imply it was saved.                            |
| Use `needs_review`, notification center, Due Work, Work Item, Requirement, and Capability exactly.  | Substitute source drift such as “needs-review,” “notifications,” or “maintenance plan.” |

The interface never asks for credentials directly and never names the
development identity provider in product copy. Correlation IDs are copyable
support context, not the main explanation, and stack traces or raw token details
are never shown.

## Component Patterns

Formal component names are identical to `DESIGN.md` Components. Visual
specifications live there; this table owns behavior.

| Component                  | Behavioral specification                                                                                                                                                                                                               |
| -------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Primary Button             | At most one per surface or decision point. Prevent duplicate activation while busy, keep its label width stable, describe the operation, and announce asynchronous outcome when the visible update is insufficient.                    |
| Secondary Button           | Performs a valid alternate action such as Cancel or Use current values without competing with Primary Button.                                                                                                                          |
| Ghost Button               | Handles low-emphasis actions that remain discoverable by keyboard and touch; never hides a consequential action behind icon recognition.                                                                                               |
| Destructive Button         | Requires a precise destructive or lifecycle label and exposes consequences before confirmation where the source requires it; it never substitutes visual alarm for explanation.                                                        |
| Labeled Text Field         | Label above input; accessible name required; help precedes error; safe input survives validation, network, session, stale, and conflict failures whenever specified.                                                                   |
| Labeled Select Field       | Same contract as Labeled Text Field; browser-informed locale or currency suggestions remain explicit editable choices, not authoritative inference.                                                                                    |
| Page Alert                 | Inline, persistent page or operation state with heading, explanation, and a specific next action; never use a transient toast as the only error record.                                                                                |
| Field Alert                | Programmatically associated with its field and included in failed-submission focus handling.                                                                                                                                           |
| Public Shell               | Contains Wrenchbase name, one concise product statement, sign-in action, and authentication status or recovery message only.                                                                                                           |
| Authenticated Shell        | Provides home action, explicit active Workspace context, Workspace Switcher, Account Menu, route heading, and main content. No unavailable destinations.                                                                               |
| Workspace Switcher         | Trigger names the active Workspace. Menu lists available Memberships, identifies the active item without color alone, ends with Create workspace, closes with Escape, restores focus, and confirms a destination before persisting it. |
| Account Menu               | Shows display name, verified email, and Sign out. It closes with Escape, restores focus, and closes the Workspace Switcher when opened.                                                                                                |
| Content Surface            | Groups content that needs a boundary or interaction target. Workspace overview uses one settings surface, not a separate card per setting.                                                                                             |
| Status Badge               | Communicates a short status or selection through readable text, not color alone. Later sync and Due Work states retain their exact independent meanings.                                                                               |
| Conflict Comparison Region | Appears in-page before form actions, retains local input, compares only differing fields, identifies Current value and Your edit programmatically, and requires deliberate resubmission.                                               |

Presentation primitives are created only when used across more than one MVP 0
workflow. Feature-specific behavior stays with its feature and does not create a
competing shared system.

## State Patterns

### Global page and operation states

| State            | Required behavior                                                                                                                                                                                   |
| ---------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Loading          | Preserve eventual structure where practical, provide concise status, avoid indefinite blank pages or layout jumps, and do not announce every animation.                                             |
| Empty            | Explain the next valid action. Never disguise unauthorized or offline state as empty.                                                                                                               |
| Validation       | Retain safe input, associate Field Alert content with fields, and focus the summary or first invalid field after submission. Multiple field failures use a focusable summary.                       |
| Network failure  | Explain that the server could not be reached and offer idempotent Retry without duplicate work. Preserve safe input.                                                                                |
| Unauthorized     | Explain that the account cannot act and return to a safe Workspace route. Hide unavailable controls when returned Capabilities already establish that fact.                                         |
| Not found        | Use the same surface for missing and cross-Workspace resources and reveal no ownership information.                                                                                                 |
| Session expired  | Preserve non-sensitive input during in-page renewal. Before a required provider redirect, warn honestly that unsaved input may be lost unless an approved session-scoped recovery mechanism exists. |
| Unexpected error | Show a safe explanation and copyable correlation ID; expose no stack trace or internal response.                                                                                                    |
| Success          | Update from the returned representation, announce the result when needed, and avoid predicting server normalization.                                                                                |
| Offline          | Show cached freshness and applicable draft sync state. Explain which work remains available; do not claim that unsupported work will be preserved.                                                  |
| Conflict         | Distinguish stale precondition, domain conflict, validation, and missing precondition. Preserve work and require explicit review rather than blind retry.                                           |

[OPEN QUESTION UX-OQ-6] The API distinguishes a missing precondition (`428`)
from stale state (`412`) and semantic conflict (`409`), but the supplied sources
do not define the user-facing recovery for `428`.

Each MVP 0 route implements Loading, Network failure, Unauthorized, Not found,
Session expired, and Unexpected error where the state can occur. Forms also
implement Validation and Success. Public authentication surfaces replace
inapplicable Workspace states with the authentication-specific states below.

### MVP 0 surface-specific states

| Surface                  | Required specific states                                                                                                                                                                                                                              |
| ------------------------ | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Public entry             | Signed out; redirect starting with duplicate action disabled; retryable redirect-start failure; already authenticated routing.                                                                                                                        |
| OIDC callback            | Validating progress with stable title; success redirect; invalid or expired attempt with Start again; temporary network failure with recovery; no raw provider details.                                                                               |
| No-Membership onboarding | Signed-in welcome; display name when available; Create a workspace primary action; informational owner-invitation guidance. This is not an empty Workspace list.                                                                                      |
| Workspace creation       | Browser-informed locale/currency suggestions; busy submission; single-field and multi-field validation; retry with the same idempotency key; success navigation and announcement; Cancel to prior valid route. Direct-entry fallback remains UX-OQ-9. |
| Workspace overview       | Settings summary; update Capability present or absent; role as secondary context; no placeholder Assets, Jobs, Due Work, or notification cards.                                                                                                       |
| Workspace settings       | Clean, dirty, busy, validation, successful normalized return, dirty in-app navigation choice, honest best-effort browser exit protection, and stale edit.                                                                                             |
| Workspace Switcher       | Active item, long name, one or many Memberships, missing/revoked last selection fallback, destination failure without changing saved selection.                                                                                                       |
| Account Menu             | Ready, logout busy, logout success, recoverable failure that warns the session may remain active and offers Retry.                                                                                                                                    |
| Stale-edit recovery      | Latest representation loading; comparison ready; Use current values; Review my edits; Retry comparison after load failure; deliberate second Save changes.                                                                                            |

### Stale-edit recovery

A `412 Precondition Failed` keeps every entered value and states that the
Workspace changed elsewhere and nothing from this form was saved. Load the
latest representation and show only changed fields in Conflict Comparison
Region. **Use current values** replaces the form. **Review my edits** rebases the
retained form to the latest ETag, marks values that would overwrite newer data,
and never resubmits automatically. The user presses **Save changes** again.

[OPEN QUESTION UX-OQ-3] Sources do not say whether Review my edits adopts
server-changed fields that the user did not edit. Do not invent a merge rule.

### Later offline and synchronization states (MVP 5)

Recently used and explicitly pinned Asset trees may be read offline. Offline
Jobs may contain Meter Readings, attachments, Work Items, and Component
replacement proposals. Offline Asset creation is limited to cached existing
Asset Types; Asset Type and Maintenance Schedule authoring stay online-only;
large attachments download only on request.

| Sync state     | Experience contract                                                                                                  |
| -------------- | -------------------------------------------------------------------------------------------------------------------- |
| `pending`      | Remains findable and queued for a later attempt.                                                                     |
| `syncing`      | Identifies an active synchronization attempt; detailed progress and interruption behavior remain UX-OQ-8.            |
| `synced`       | Confirms successful server synchronization.                                                                          |
| `failed`       | Retains draft and Evidence, remains findable, explains retry, and offers Retry.                                      |
| `needs_review` | Retains all content and Evidence, shows current API state and conflict code, and requires explicit human resolution. |

Synchronization attempts on reconnect, application open, foreground return,
and online save; Members can choose **Sync now** or **Retry**. The product does
not promise synchronization while closed. First successful upload creates a
shared server draft whose author remains editor until explicit handoff.
Publication waits until attachments and every dependent item are confirmed;
marking complete offline is a local publish request, not a server lifecycle
state. Replays are idempotent.

Semantic conflict resolution never guesses. A Member may retarget stale
Component work, correct a conflicting Meter Reading, map work to a current
Requirement, or preserve it as ad hoc history. The client never silently changes
replacement, Maintenance Schedule, Meter, or lifecycle state.

The focused offline-sync document omits PRD-authorized offline Asset creation,
so the PRD rule above controls. Detailed screens and several state transitions
remain deferred rather than invented.

[OPEN QUESTION UX-OQ-7] The API and security sources name an MVP image/PDF
allow-list and reference attachment-size defaults, while the PRD defines
Evidence more broadly and leaves quantitative attachment limits open. Do not
present those formats or sizes as an approved product boundary yet.

[OPEN QUESTION UX-OQ-8] The sources do not complete user-visible behavior for
`pending`, `syncing`, `synced`, interrupted partial progress, authorization
failure during synchronization, stale cache freshness, or cleanup of
synchronized outbox records.

## Interaction Primitives

- **Touch and pointer:** every action works without fine pointer accuracy or
  hover. Primary targets are at least 48 by 48 pixels; compact secondary targets
  are at least 44 by 44 pixels. No core workflow depends on drag-and-drop.
- **Keyboard:** logical focus follows reading order. Native links, buttons,
  inputs, and selects come first. Escape closes menus and dialogs and restores
  focus to the trigger. No keyboard trap is permitted.
- **Focus after navigation:** each route exposes one descriptive `h1` and a
  unique document title; route changes place focus predictably at the new page
  context.
- **Focus after errors:** failed multi-field submission focuses a summary;
  otherwise focus the first invalid field. Comparison failure keeps the form and
  makes Retry comparison reachable.
- **Menus:** large rows, ordinary arrow/Tab behavior as appropriate to native
  semantics, one open menu at a time, active item identified by label or check.
- **Forms:** labels stay above controls; creation and settings order is name,
  locale, default currency. Primary submit appears after all fields. Cancel is
  secondary and never submits.
- **Consequences:** move, install, detach, Reconciliation, lifecycle, and Asset
  Type publication views in later milestones expose consequences before
  confirmation. Tree controls provide explicit keyboard/touch move actions;
  drag-and-drop is never the only path.
- **Announcements:** announce redirect start, asynchronous save, success,
  failure, and other outcomes not discoverable from the visible change. Do not
  narrate every loading animation.

## Accessibility Floor

WCAG 2.2 AA is a completion requirement for the responsive browser experience.

- Use semantic header, navigation, and main landmarks; native headings, links,
  buttons, labels, inputs, and selects precede custom interaction code.
- Give every control an accessible name and programmatically associate help and
  error text. Dialogs have an accessible name and manage focus.
- Keep DOM, reading, visual, and keyboard order aligned at every viewport.
- Provide visible focus using `{colors.focus-light}` or `{colors.focus-dark}`
  with the unresolved contrasting offset from UX-OQ-4.
- Preserve meaning without color, motion, hover, fine pointer accuracy, or icon
  recognition. Status Badge and conflict states always include text.
- Support 200% text zoom and reflow at a 320-pixel CSS viewport without ordinary
  page-level horizontal scrolling.
- Keep long Workspace names, errors, translations, and user content available
  without clipping. Visual truncation is allowed only when the complete value is
  adjacent or available in the opened Workspace Switcher.
- Honor operating-system reduced-motion and color-scheme preferences. Remove
  non-essential motion and avoid decorative movement during authentication or
  loading.
- Announce asynchronous outcomes when a visual update alone would be missed by
  assistive technology.
- Manually check keyboard, 200% zoom, narrow reflow, light/dark contrast,
  reduced motion, and representative screen-reader output for sign-in,
  onboarding, Workspace, and stale-edit flows. Automated checks supplement but
  do not replace these reviews.

Visual contrast, component appearance, and target dimensions are specified in
`DESIGN.md`. Contrast must hold in default, hover, focus, disabled, busy,
validation, and conflict states.

## Responsive & Platform

| Context                                  | Behavior                                                                                                                                             |
| ---------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------- |
| 320-pixel CSS viewport and narrow mobile | Safe 16-pixel edge spacing, one-column forms, top bar wraps or compacts without hiding the Workspace name, content wraps, no horizontal page scroll. |
| Larger mobile and desktop                | Increase outer spacing to 24–32 pixels; keep a constrained main column and the same top-bar model. Do not create needless columns.                   |
| Wide Workspace overview                  | A compact action may sit beside its heading when space allows; reading and keyboard order remain identical to mobile.                                |
| Public Shell on desktop                  | Compact centered column; sign-in content does not stretch across the viewport.                                                                       |
| Authenticated Shell on desktop           | Retains top bar and constrained content; no empty sidebar.                                                                                           |
| Future React Native                      | API contracts remain client-neutral, but no native UI, route, or component behavior is specified by this migration.                                  |

Editable text and controls must not trigger mobile browser zoom. Touch use must
remain practical with gloves or limited dexterity. Desktop adaptation adds
space, not an expert-only compact mode.

## Localization

Workspace locale is Workspace data; it is not automatically the interface
language. Locale and default currency suggestions may use browser context but
remain explicit editable choices. Workspace names use 1–100 trimmed grapheme
clusters, locale uses canonical BCP 47, and currency uses uppercase ISO 4217.

All user-facing MVP 0 copy—including authentication, loading, empty,
validation, network, authorization, not-found, session, unexpected-error, and
stale-edit messages—belongs behind stable semantic translation keys. Typed safe
interpolation covers Workspace names, display names, correlation IDs, and other
dynamic values. Every supported catalog must be complete and preserve accessible
names, live announcements, error association, 320-pixel reflow, and 200% zoom.

[OPEN QUESTION UX-OQ-5] Supported MVP 0 interface languages, language selection,
and fallback order are not decided. Do not infer interface language from the
Workspace locale or claim partially translated support.

## Inspiration & Anti-patterns

This migration introduces no external reference product or new design
direction. Existing source constraints reject:

- marketing-site navigation in the Public Shell;
- empty MVP 0 navigation for later features;
- desktop-only dense administration layouts;
- icon-only consequential actions, color-only states, and hover-only meaning;
- automatic stale-edit resubmission or hidden conflict merging;
- generic toast-only failures;
- guaranteed background sync while the browser is closed;
- points, streaks, achievements, confetti, mascots, decorative rewards, and
  engagement mechanics unrelated to completed maintenance work.

## Key Flows

### UJ-1. Maya establishes a private maintenance Workspace

1. Maya opens `/` while signed out. Public Shell presents **Sign in** as the one
   Primary Button and explains that authentication continues with the configured
   identity provider.
2. She activates **Sign in**. Duplicate activation is disabled and redirect
   progress is announced. The callback validates the provider response and her
   Wrenchbase profile without exposing token details.
3. With no Memberships, Maya reaches `/onboarding`. The page welcomes her by
   display name when available, offers **Create a workspace**, and explains that
   an existing owner must invite her verified email for another Workspace.
4. Maya opens `/workspaces/new` and enters Workspace name, locale, and default
   currency in that order. Browser-informed suggestions remain editable. The
   submission keeps all values visible and reuses one idempotency key for safe
   transport retry.
5. Success navigates to `/workspaces/{workspaceId}`. The returned representation
   supplies the Workspace heading, her role, settings summary, and
   `workspace.update` Capability. The active Workspace is visible in Workspace
   Switcher.
6. Maya creates a second Workspace from the final Workspace Switcher action,
   then switches between explicit Workspace routes. The last-selected identifier
   changes only after the selected destination is confirmed.
7. Maya opens Workspace settings, edits locale and currency, and saves. The
   overview and Workspace Switcher update from the returned representation.
8. In a second tab, the same Workspace has changed. Maya's next save returns
   `412 Precondition Failed`; Conflict Comparison Region preserves her form and
   shows only differing **Current value** and **Your edit** values.
9. **Climax:** Maya chooses **Review my edits**, deliberately presses **Save
   changes** again, and returns to an overview whose active Workspace and saved
   settings match the authoritative response—without data from her other
   Workspace appearing.

Failure paths: redirect-start failure restores **Sign in** and offers retry;
invalid or expired callback offers **Start again**; network failures retain safe
input and retry idempotently; missing or cross-Workspace IDs share the same Not
found surface; a revoked last selection falls back to another Membership or
onboarding without a redirect loop; failed conflict comparison keeps the form
and offers **Retry comparison**.

### Deferred canonical journeys

The following PRD journeys remain canonical by reference. This migration does
not invent detailed screens or repeat their product requirements before their
UX surfaces are specified.

| Journey                                                       | Milestone application | UX status                                                                                                               |
| ------------------------------------------------------------- | --------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| UJ-2. Luis models a scooter and its CVT assembly.             | MVP 1                 | Deferred; global Capability, consequence-preview, history, tree, keyboard, touch, and responsive rules already apply.   |
| UJ-3. Priya starts trustworthy tracking for a used Asset.     | MVP 2                 | Deferred; unknown history and stale Meter Reading must remain explicit, never falsely safe.                             |
| UJ-4. Luis completes service without erasing unfinished work. | MVP 3                 | Deferred; only a completed Work Item explicitly fulfilling a Requirement resets Due Work. Planning adds only `planned`. |
| UJ-5. Maya replaces a Component and retains both histories.   | MVP 3                 | Deferred; replacement consequences and retained history require explicit review.                                        |
| UJ-6. Ava finishes field work after losing connectivity.      | MVP 5                 | Deferred screen design; offline state and conflict contracts in this spine apply.                                       |
| UJ-7. Priya reviews what needs attention.                     | MVP 4                 | Deferred; due-work dashboard and notification center remain named future destinations.                                  |

## Open Questions

The approval accepts these as explicit migration gaps. They do not block the
canonical status of this migration, but they must remain visible inputs to a
later full `bmad-ux` Update workflow and be resolved before affected milestone
implementation.

- [OPEN QUESTION UX-OQ-1] Define the active Workspace and Workspace Switcher
  exception for authenticated no-Membership onboarding and authentication
  transition surfaces.
- [OPEN QUESTION UX-OQ-2] Reconcile detailed MVP 0 settings/stale-edit scope with
  the PRD milestone-summary wording.
- [OPEN QUESTION UX-OQ-3] Define how Review my edits treats server-changed fields
  that the Member did not edit.
- [OPEN QUESTION UX-OQ-4] Supply the missing visual token values listed in
  `DESIGN.md`; no behavioral pattern may work around them with feature-local
  values.
- [OPEN QUESTION UX-OQ-5] Decide supported interface languages, selection, and
  fallback order independently of Workspace locale.
- [OPEN QUESTION UX-OQ-6] Define user-facing recovery for a missing required
  precondition (`428`) without collapsing it into stale edit or semantic
  conflict.
- [OPEN QUESTION UX-OQ-7] Decide whether the Evidence format allow-list and
  reference attachment limits are approved product constraints.
- [OPEN QUESTION UX-OQ-8] Complete the user-visible synchronization-state,
  interrupted-progress, cache-freshness, authorization-failure, and cleanup
  behavior.
- [OPEN QUESTION UX-OQ-9] Define the safe Cancel destination when Workspace
  creation is entered directly and no prior valid route exists.
