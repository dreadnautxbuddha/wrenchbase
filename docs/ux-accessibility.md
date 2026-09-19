# UX and Accessibility Brief

Wrenchbase is used in garages, workshops, roadsides, and job sites. Browser
workflows therefore prioritize a small-screen, intermittent-connectivity
experience without reducing desktop usability.

## Navigation and Workspace Context

Every authenticated screen shows the active workspace and provides a clear
workspace switcher. The switcher lists only memberships available to the signed
in user and preserves the last active workspace for the next visit. A new user
with no memberships sees onboarding that offers workspace creation or explains
that an owner must send an invitation.

Primary mobile navigation exposes the due-work dashboard, assets, jobs, and
notifications. Settings and workspace management remain reachable but do not
compete with field work. Screens must make the target asset, site, and job state
visible before the user takes a consequential action.

## Jobs and On-Site Work

Draft, planned, and active jobs provide a prominent Add work action. Any
workspace member can add an ad-hoc item, select its target asset, add materials,
evidence, cost allocation, and inspection outcome, then optionally link it to a
requirement. The UI explains that only an explicit requirement link affects due
work. A closed job is read-only except for the amendment or void flows.

Offline-capable screens show cached freshness and the draft sync state. Pending,
failed, and needs-review drafts remain easy to find. Conflict screens describe
what changed and offer the explicit choices allowed by the offline-sync contract;
they never silently discard evidence or merge lifecycle changes.

## Accessible Interaction

Use semantic HTML first, visible keyboard focus, labeled controls, and error
messages connected to their fields. Dialogs manage focus and have an accessible
name. Do not rely on color alone for due states, sync states, validation, or job
status. Touch targets remain practical with gloves or limited dexterity, and
forms retain entered values after validation or network errors.

Each route has deliberate loading, empty, error, unauthorized, and offline
states. Loading states preserve layout where practical; empty states explain the
next useful action; errors identify whether retry, sign-in, workspace switching,
or manual conflict review is needed. Test critical workflows with keyboard and
screen-reader behavior as well as narrow mobile and desktop viewports.
