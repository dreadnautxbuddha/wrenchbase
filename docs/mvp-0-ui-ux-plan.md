# MVP 0 UI/UX Plan

This plan defines the information architecture, responsive layout, interaction
states, and accessibility behavior for the browser workflows in the
[MVP 0 implementation plan](mvp-0-implementation-plan.md). The
[UX and accessibility brief](ux-accessibility.md) remains the product-wide
source for experience principles; this document makes those principles
implementable for MVP 0.

The approved [MVP 0 visual design](mvp-0-visual-design.md) applies the sky-blue,
playful, large-type direction to this structure and defines the centralized
presentation and accessibility requirements.

## Design objective

MVP 0 should make authentication and workspace context feel trustworthy,
obvious, and lightweight on a phone or desktop. A user should always understand:

- whether they are signed in;
- which workspace is active;
- what they can do in that workspace;
- whether an operation succeeded, failed, or needs their attention; and
- how to switch workspace or sign out.

The experience is a foundation rather than a placeholder. It should support the
later assets, jobs, due work, and notification areas without displaying empty
navigation for features that do not exist yet.

## Planning and review process

Use short, decision-oriented design sessions rather than attempting one final
mockup:

1. **Frame the workflow.** Confirm the user, goal, entry point, successful
   outcome, and product constraints.
2. **Map the flow.** List screens, decisions, alternate paths, and recovery
   paths before discussing colors or component polish.
3. **Review low-fidelity wireframes.** Evaluate hierarchy, navigation, form
   order, action placement, and content using realistic labels and data.
4. **Stress the states.** Review loading, empty, invalid, unauthorized,
   not-found, network, and concurrency states at the same fidelity as the happy
   path.
5. **Review responsive and accessible behavior.** Check narrow mobile, desktop,
   keyboard order, focus movement, semantics, readable errors, and practical
   touch targets.
6. **Set the visual direction.** Apply typography, spacing, color, iconography,
   and component styling only after the interaction model is stable.
7. **Record decisions and acceptance criteria.** Update this document and the
   relevant tests so implementation does not depend on reconstructing a design
   conversation.

Early sessions should answer structural questions. Later sessions can refine
appearance without changing the route or application boundaries.

## Scope

MVP 0 includes these browser experiences:

- public sign-in;
- OIDC redirect and callback handling;
- no-membership onboarding;
- workspace creation;
- workspace overview;
- basic workspace settings editing;
- workspace switching;
- stale-edit recovery;
- authorization, not-found, validation, and network recovery; and
- provider logout.

Invitation acceptance and member management begin in MVP 1. The MVP 0
onboarding screen may explain that an existing owner must invite the user, but
it must not present a non-functional invitation workflow.

## Route map

Use thin Next.js delivery routes and delegate behavior through the browser
application boundaries defined in the architecture.

- `/` is the public entry point. It shows sign-in when signed out and redirects
  an authenticated user to onboarding, their last valid workspace, or their
  first available workspace.
- `/auth/callback` completes the OIDC callback and returns the user to the
  validated in-app destination. It never accepts an arbitrary external return
  URL.
- `/onboarding` is available to authenticated users without a workspace and
  explains the two valid next steps.
- `/workspaces/new` creates a workspace.
- `/workspaces/{workspaceId}` is the workspace overview and canonical
  authenticated landing route for MVP 0.
- `/workspaces/{workspaceId}/settings` edits the workspace name, locale, and
  default currency.

An authenticated user with memberships is redirected away from onboarding to a
valid workspace. They may still create another workspace through
`/workspaces/new`; the workspace switcher exposes that route as its final
action.

## Application shells

### Public shell

The public shell contains the Wrenchbase name, one concise product statement,
the primary sign-in action, and any authentication status or recovery message.
Keep the surface calm and focused. Do not imitate a marketing site or introduce
navigation to unavailable product areas.

At narrow widths, content fills the available width with safe edge spacing. At
desktop widths, it remains a compact centered column rather than stretching the
sign-in content across the screen.

### Authenticated shell

The authenticated shell has three persistent regions:

1. A top application bar with the Wrenchbase home action;
2. The active workspace switcher; and
3. An account menu containing the signed-in identity and Sign out.

The main content starts with a route-specific heading and supporting context.
Consequential actions stay near the resource they affect rather than moving
into a global toolbar.

On mobile, the top bar wraps or compacts without hiding the workspace name. Do
not add bottom navigation in MVP 0 because due work, assets, jobs, and
notifications do not exist yet. On desktop, retain the top-bar model and use a
constrained main column. Do not add an otherwise empty sidebar.

MVP 1 can add local navigation when sites, asset types, and assets create enough
destinations to justify it. Later primary mobile navigation can be introduced
without changing the explicit workspace route boundary.

## Sign-in and callback

The signed-out entry screen uses one primary action: **Sign in**. Supporting
copy explains that authentication continues with the configured identity
provider. Do not request credentials directly or name a development provider in
product copy.

After selection, disable repeated submission and announce that the redirect is
starting. If the redirect cannot start, restore the action and show a retryable
error without discarding a safe return destination.

The callback screen shows a stable page title and progress message while tokens
and the Wrenchbase profile are validated. Success redirects immediately.
Failure distinguishes an expired or invalid attempt from a temporary network
problem and offers Start again. It never renders raw provider or token details.

## No-membership onboarding

The onboarding screen welcomes the signed-in user by display name when
available and explains why no workspace is visible. It presents:

- **Create a workspace** as the primary action; and
- guidance that an existing workspace owner must invite the user's verified
  email address.

The guidance is informational in MVP 0. Do not offer workspace discovery,
self-service join requests, or invitation entry fields.

## Workspace creation

The creation form asks for fields in this order:

1. Workspace name;
2. Locale; and
3. Default currency.

Locale and currency start from browser-informed suggestions but remain explicit
editable choices. Suggestions are presentation defaults, not authoritative
identity or location inference.

Keep the primary Create workspace action at the end of the form. A secondary
Cancel action returns to the prior valid route. During submission, keep all
entered values visible, prevent duplicate submission, and use the same
idempotency key for safe transport retries.

Validation appears next to its field and in a focusable error summary when more
than one field is invalid. On successful creation, navigate to the new
workspace overview and announce the result.

## Workspace overview

The workspace overview establishes context rather than inventing an empty
dashboard. It contains:

- the workspace name as the page heading;
- the caller's role as secondary context;
- a Settings summary with locale and default currency; and
- an Edit settings action only when `workspace.update` is present.

A member without update capability sees the same current settings without a
disabled or misleading Edit action. The page does not show placeholder cards
for assets, jobs, due work, or notifications.

## Workspace settings

The settings screen uses the same field order and controls as workspace
creation. The heading and breadcrumb make the active workspace clear before the
user edits it.

Save changes is the only primary action. Cancel returns to the overview without
submitting. If the form has unsaved edits, navigation within the app asks the
user to discard or continue editing. Browser-level protection is best effort
and must not claim to preserve data after the page is closed.

After success, update the overview and workspace switcher from the returned
representation rather than predicting server normalization.

## Stale-edit recovery

When a save receives `412 Precondition Failed`, keep every entered value and
show an in-page conflict region before the form actions. Explain that the
workspace changed elsewhere and that nothing from the current form was saved.

Load the latest representation and compare only fields that differ:

- **Current value** is the latest API value;
- **Your edit** is the retained form value; and
- unchanged fields remain out of the comparison.

The user can choose **Use current values**, which replaces the form, or
**Review my edits**, which rebases the retained form onto the latest ETag and
marks values that would overwrite newer data. Review never resubmits
automatically. The user must press Save changes again after considering the
differences.

If the latest representation cannot be loaded, preserve the form and offer
Retry comparison. Do not reduce a concurrency conflict to a generic toast or
blindly retry the original request.

## Workspace switcher and account menu

The workspace switcher is available on every authenticated screen. Its trigger
shows the active workspace name, not only an icon. The menu lists available
workspaces, identifies the active one without color alone, and ends with Create
workspace.

Selecting a workspace navigates to its explicit overview route and updates the
last-selected workspace only after the destination is confirmed available. A
missing or revoked last-selected workspace falls back to another membership or
onboarding without a redirect loop.

The account menu shows display name and verified email, then Sign out. Logout
uses the provider flow. While logout is in progress, prevent duplicate action;
on a recoverable failure, explain that the session may still be active and
offer Retry.

Menus close with Escape, return focus to their trigger, and support ordinary
keyboard navigation. Opening one menu closes the other.

## Page and operation states

Every route deliberately handles these states:

- **Loading:** preserve the eventual page structure with a concise status;
  avoid indefinite blank screens or layout jumps.
- **Empty:** explain the next valid action. Do not use an empty state when the
  user is actually unauthorized or offline.
- **Validation:** retain all safe input, associate messages with fields, and
  focus the summary or first invalid field after submission.
- **Network failure:** explain that the server could not be reached and offer a
  retry that does not create duplicate work.
- **Unauthorized:** explain that the account cannot perform the action and
  return to a safe workspace route. Do not present an owner-only control before
  the API rejects it when capabilities already show it is unavailable.
- **Not found:** use the same page for a missing and cross-workspace resource,
  without revealing whether another workspace owns the identifier.
- **Session expired:** preserve non-sensitive form input while an in-page token
  renewal remains possible. If recovery requires a full provider redirect,
  clearly warn that unsaved input may be lost unless a separately reviewed,
  session-scoped recovery mechanism exists. Never persist tokens or meaningful
  drafts in `localStorage`.
- **Unexpected error:** show the correlation ID as copyable support context,
  without exposing a stack trace or internal response.

Use inline messages for page and form states. Reserve transient announcements
for confirming an action whose result is already visible; do not make a toast
the only record of an error.

## Responsive behavior

Design and test from a 320-pixel-wide viewport upward. Forms remain one column
at all MVP 0 widths. Touch targets are approximately 44 pixels in both
dimensions, editable text does not trigger mobile browser zoom, and controls do
not require horizontal scrolling.

At wider widths, increase surrounding space rather than creating unnecessary
columns. The overview may place a compact action beside its heading when space
allows, but reading and keyboard order remain the same as mobile. Form labels
stay above their controls.

Long workspace names truncate visually only where the full value is available
through adjacent accessible text or the opened switcher. Error text and user
content wrap instead of clipping the layout.

## Accessibility behavior

- Use semantic landmarks for header, navigation, and main content.
- Give each route one descriptive `h1` and a unique document title.
- Keep DOM and visual order aligned; responsive layout must not create a
  different keyboard sequence.
- Use native links, buttons, inputs, and selects before custom controls.
- Keep visible focus indicators and restore focus after menus and dialogs.
- Connect help and error text to its field with accessible descriptions.
- Announce asynchronous save, redirect, and error outcomes without announcing
  every loading animation.
- Do not use color alone for active workspace, validation, or conflict states.
- Respect reduced-motion preferences and avoid decorative motion during
  authentication or loading.
- Test zoom, text enlargement, narrow reflow, keyboard-only operation, and
  representative screen-reader output.

## Content and visual direction

Use direct, calm language suitable for a garage, workshop, or personal asset
collection. Prefer concrete actions such as Create workspace, Edit settings,
Try again, and Sign out. Avoid enterprise administration language when a
simpler phrase is accurate.

Low-fidelity review does not settle brand colors, typography, illustration, or
component styling. Record those decisions separately in the visual-design
proposal, and establish only the tokens required by implemented screens before
evolving the system with the product.

## Wireframe review set

Review mobile and desktop versions of:

1. Sign-in;
2. No-membership onboarding;
3. Workspace creation;
4. Workspace overview with switcher open;
5. Workspace settings; and
6. Workspace settings after a stale edit.

For each view, review the happy path and the most consequential recovery state.
Use realistic workspace names, locale values, currency values, identity data,
and long text rather than placeholder Latin text.

## UX acceptance checklist

MVP 0 UX is ready for implementation when:

- every screen and recovery state has an owner in the route map;
- the active workspace remains visible throughout authenticated workflows;
- no control advertises an unavailable MVP 1 or later capability;
- create and update forms preserve input across expected failures;
- stale edits require explicit comparison and resubmission;
- owner-only controls follow returned capabilities;
- the mobile layout works at 320 pixels without horizontal scrolling;
- all workflows are operable by keyboard with sensible focus movement;
- screen-reader labels and asynchronous announcements are specified; and
- Playwright and Vitest scenarios can be derived directly from the plan.

After this review, MVP 0 implementation can begin. Visual refinements that do
not change these interaction contracts can continue alongside implementation.
