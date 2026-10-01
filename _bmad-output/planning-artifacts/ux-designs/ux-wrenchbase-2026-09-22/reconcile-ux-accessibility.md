---
source: ../../../../docs/ux-accessibility.md
status: final
updated: 2026-09-22
---

# Reconciliation: UX and Accessibility Brief

## Migration verdict

The brief contains product-wide behavioral and accessibility requirements. Its
interaction rules migrate to `EXPERIENCE.md`; its visual-accessibility
constraints migrate to `DESIGN.md`. Later-feature applications remain
milestone-scoped, while global rules such as input preservation, semantic HTML,
focus, non-color communication, and recovery-oriented errors remain global.

The source is retained after canonical UX approval as guidance and migration
evidence. It may be reconsidered only if a separately approved deletion
checkpoint proves heading-complete coverage. No route, screen, protagonist,
navigation control, or component is inferred beyond the supplied sources.

## Heading-complete mapping

### `# UX and Accessibility Brief`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; retained until the separate
source-retirement approval.

Migrate the product-wide context that Wrenchbase is used in garages, workshops,
roadsides, and job sites. Browser workflows therefore prioritize small screens
and intermittent connectivity without reducing desktop usability.

- `EXPERIENCE.md` owns mobile-first behavior, desktop adaptation, intermittent-
  connectivity behavior, and platform interaction.
- `DESIGN.md` owns the responsive visual system and visual accessibility needed
  to support those behaviors.
- The brief establishes no new brand direction, route model, or component
  system.

**Qualitative detail not migrated:** none.

### `## Navigation and Workspace Context`

**Classification:** `EXPERIENCE.md`; deferred later-milestone application;
unresolved conflict UX-OQ-1; retained until separate retirement approval.

Migrate these global and scoped behaviors:

- Authenticated Workspace surfaces keep the active Workspace visible and make
  the Workspace switcher clear.
- The switcher lists only Memberships available to the signed-in user and
  preserves only the last selected Workspace identifier for a later visit.
- A signed-in user with no Memberships receives onboarding that offers
  Workspace creation or explains that an owner must send an invitation.
- Settings and Workspace management remain reachable without competing with
  field work.
- Before a consequential action, the surface makes its target Asset, Site, and
  Job state visible.
- Preserve the future primary mobile navigation destinations: Due Work, Assets,
  Jobs, and the notification center. Do not display unavailable destinations in
  MVP 0; its approved shell keeps the top-bar model without bottom navigation or
  an empty sidebar.

The future navigation destinations are product-wide intent, not authorization
to invent a layout or route. Their applications remain milestone-scoped: Assets
from MVP 1, Due Work from MVP 2, Jobs from MVP 3, and the notification center
from MVP 4.

**Override:** use canonical PRD terminology: `Workspace`, `Membership`, `Asset`,
`Site`, `Job`, `Due Work`, and `notification center`. The source wording
“due-work dashboard,” “assets,” “jobs,” and “notifications” remains evidence,
not canonical replacement vocabulary.

**Open question — UX-OQ-1:** “Every authenticated screen” cannot literally show
an active Workspace on authenticated no-Membership onboarding or an
authentication-transition surface where no active Workspace exists. The user
must decide or approve the applicability boundary; do not invent a placeholder
Workspace.

**Qualitative detail not migrated:** none. Exact future navigation placement and
form are intentionally unspecified and must not be inferred.

### `## Jobs and On-Site Work`

**Classification:** `EXPERIENCE.md`; deferred MVP 3 and MVP 5 applications;
canonical PRD overrides; unresolved question UX-OQ-8; retained until separate
retirement approval.

Migrate these behaviors into later-milestone sections of `EXPERIENCE.md`:

- `draft`, `planned`, and `active` Jobs provide a prominent **Add work** action
  when the returned Capabilities authorize it.
- Adding an ad hoc Work Item can select its target Asset and record materials,
  Evidence, cost allocation, and inspection outcome, then optionally map it to
  a Requirement.
- A `closed` Job is read-only except for explicit amendment or void flows.
- Offline-capable surfaces show cached freshness and draft synchronization
  state.
- Drafts in `pending`, `failed`, or `needs_review` remain easy to find.
- Conflict surfaces describe what changed, offer only choices allowed by the
  offline-sync contract, never silently discard Evidence, and never silently
  merge lifecycle changes.

**Override — Capability authorization:** the source says any Workspace Member
can add an ad hoc item. The PRD controls: eligibility does not let the client
infer authorization from `owner` or `member`; control visibility follows the
returned Capability.

**Override — Due Work effect:** the source says only an explicit Requirement
link affects Due Work. FR-20 and FR-22 provide the precise rule: planning may
add a `planned` annotation, while only a completed Work Item explicitly
fulfilling a Requirement resets its Due Work.

**Override — terminology and literals:** use `ad hoc`, `Work Item`, `Evidence`,
`Requirement`, `Due Work`, and `needs_review`. Sync literals are client sync
states, never Job lifecycle states.

**Assumption:** no new named protagonist is introduced. Later Job and offline
applications refer to the relevant canonical PRD journeys by identifier until
their detailed UX surfaces are specified.

**Open question — UX-OQ-8:** the source names cached freshness and only some
draft states. User-visible behavior remains unspecified for `syncing`, `synced`,
interrupted partial progress, authorization failure during sync, stale cache
freshness, and cleanup of synchronized outbox records.

**Qualitative detail not migrated:** none. Exact routes, layouts, component
names, and conflict choices remain governed by later UX work and the retained
offline-sync contract.

### `## Accessible Interaction`

**Classification:** `EXPERIENCE.md`; `DESIGN.md`; applicability override;
retained until separate retirement approval.

Migrate globally to `EXPERIENCE.md`:

- Prefer semantic HTML.
- Controls have accessible labels; help and error messages are connected to
  their fields.
- Dialogs have an accessible name, move focus appropriately, contain focus as
  required by their modality, and restore focus on close.
- Forms retain entered values after validation and network errors.
- Each route has an applicability-based contract for loading, empty, error,
  Unauthorized, and offline/disconnected states.
- Loading preserves layout where practical; Empty explains the next useful
  action; Error identifies whether recovery needs retry, sign-in, Workspace
  switching, or manual conflict review.
- Critical workflows are verified with keyboard and representative screen-
  reader behavior at narrow mobile and desktop viewports.

Migrate globally to `DESIGN.md`:

- Keyboard focus remains visible.
- Due Work states, sync states, Validation, and Job status never rely on color
  alone.
- Touch targets remain practical with gloves or limited dexterity.
- Responsive presentation supports both narrow mobile and desktop without
  changing semantic or keyboard order.

**Applicability override:** “Each route” does not require meaningless variants
of every state and does not imply that every route supports offline work. Each
route receives the states relevant to its operations. An online-only route may
show an offline-unavailable or disconnected state without claiming offline
capability.

**Assumption:** “practical with gloves or limited dexterity” remains a
qualitative usability constraint. Exact target sizes come from the approved
visual design and canonical accessibility requirements rather than being
invented here.

**Qualitative detail not migrated:** none.

## Overrides and assumptions summary

- Canonical PRD vocabulary and literals replace non-canonical source spellings.
- Capability authorization controls action visibility even where the source
  describes an action as available to any Member.
- FR-20 and FR-22 govern the precise relationship between a planned or completed
  Work Item, its Requirement mapping, and Due Work.
- Future primary mobile navigation is preserved but absent from MVP 0.
- Offline Asset creation from cached existing Asset Types remains required by
  FR-32 even though this brief discusses offline Job work only.
- State coverage is applicability-based; disconnected presentation does not
  confer offline capability.
- No new named protagonist or missing screen is introduced.

## Open questions

- **UX-OQ-1:** define the active-Workspace/switcher applicability boundary for
  authenticated no-Membership and authentication-transition surfaces.
- **UX-OQ-8:** complete the user-facing sync-state and recovery contract for
  states and transitions not specified by the source.

## Dropped-detail audit

No qualitative UX or accessibility detail is intentionally dropped. Future
navigation, Job, Evidence, conflict, and offline applications remain deferred
only where the source does not define sufficient route, screen, or interaction
detail. The focused source remains retained through approval, and any later
retirement requires a separate heading-complete deletion checkpoint.
