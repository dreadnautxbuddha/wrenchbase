# Product Requirements

## Status and Authority

This document is the normative source for Wrenchbase product behavior. The
[product vision](product-vision.md) explains the problem and principles, the
[architecture](architecture.md) defines technical boundaries, and the
[roadmap](roadmap.md) orders delivery. When those documents are less specific,
this document controls product decisions.

## Product Purpose

Wrenchbase helps people and small organizations maintain assets they own or
operate. Its central workflow is to translate an owner manual or practical
experience into a maintenance schedule, record the work that actually happened,
and make the next required work visible at the right time.

The product is for individuals, hobbyists, small garages, workshops, and small
teams managing their own vehicles, equipment, tools, appliances, and nested
components. A garage workspace manages its own assets; Wrenchbase is not a
customer-management, booking, billing, or full CMMS system.

## Product Vocabulary

- A **workspace** owns all product data and has one or more members.
- A **site** is a physical place with an address and IANA timezone. A site can
  contain a nested **location** tree such as a building, bay, room, or shelf.
- An **asset type** is a reusable, versioned blueprint. It may be broad, such as
  `Keyboard`, or model-specific, such as `2024 Yamaha NMAX`.
- An **asset** is a concrete thing managed by a workspace. It is created from an
  asset type revision and has its own identity and history.
- A **component role** describes where a compatible child asset can be installed
  in a parent asset. It is a blueprint relationship, not an asset itself.
- An **installation** records a child asset occupying a parent component role
  over time.
- A **meter** records a typed unit of usage, such as distance, runtime, or
  cycles. A **reading** is a dated observation of that meter.
- A **maintenance schedule** is a versioned set of maintenance requirements
  offered by an asset type. A concrete asset activates one base schedule and may
  have explicit additions, disables, and overrides.
- A **requirement** describes one maintenance action and its trigger rules.
- A **job** is a planned or completed service event containing one or more
  **work items**.
- A **maintenance need** is a one-off item discovered during work, such as a
  repair identified by an inspection.
- A **maintainer** is an external person or organization that performed or
  hosted work. A workspace member may also be recorded as a job participant.

Use **maintenance schedule** throughout the product. Do not use "maintenance
plan" as a synonym.

## Workspace, Members, and Settings

Every record belongs to one workspace. A user may belong to multiple
workspaces and can switch their active workspace without signing in again. The
active workspace is always explicit in the client route and API request; a
member must never see or modify data from another workspace by mistake.

Authentication uses an OpenID Connect provider. On a first sign-in, a user with
no memberships can either create a workspace or ask an existing workspace owner
outside Wrenchbase to invite the email address verified by the provider.
Wrenchbase does not create a personal workspace automatically and does not
provide a workspace directory or self-service join requests in the MVP.

Owners invite members by email. Invitations are single-use, expire, and grant
the `member` role only after the invitee signs in with the invited email
address. An owner may revoke a pending invitation. Ownership can be transferred
only to an existing member; the last owner cannot leave or be removed.

The MVP provides two roles:

- `owner` can manage workspace settings and membership, as well as all
  maintenance data.
- `member` can manage all maintenance data but not workspace membership.

The API authorizes named capabilities rather than scattering literal role
checks. This keeps the MVP simple while allowing future roles such as read-only
or asset-type editor without changing data ownership.

Workspace settings include name, photo or logo, locale, default currency, unit
preferences, due-soon defaults, meter-reading reminder defaults, sites, and
members. The workspace owner starts subscribed to maintenance email, but may
unsubscribe; only security and account messages are mandatory.

## Sites, Locations, and Asset Placement

A site owns its address and timezone. Locations form an arbitrarily nested,
acyclic tree within a site. The first version supports names, ordering,
archiving, and paths such as `Cebu Workshop / Parts Room / Shelf B`. Capacity,
maps, geofences, and floor plans are later features.

Every active asset has exactly one placement at any point in time:

- It is directly placed in one workspace location; or
- It is installed in exactly one parent asset through a component role.

An installed child derives its physical location and site from its host. A child
that is removed must be placed directly in a location, installed elsewhere,
retired, or disposed as part of the same operation. There are no locationless
active assets. A dated movement or installation history preserves where an
asset was and when.

An object is a location when it only organizes physical placement. It is an
asset when it has a maintainable identity, component structure, or lifecycle;
the same relationship must not model it as both.

## Asset Types and Asset Lifecycles

An asset type revision defines:

- Typed attributes: short text, long text, number or measurement with unit,
  boolean, date, and single choice. Fields can be required, have defaults, and
  include help text.
- One or more typed meters.
- Component roles with cardinality and compatible child asset types.
- Named base maintenance schedule alternatives, such as normal-use and
  severe-use schedules.

Asset types do not inherit from other asset types. They may reference other
types only through component roles. The asset hierarchy can have arbitrary
depth, but may not contain cycles. Required component roles with one clear child
type create minimal child assets when the parent is created; ambiguous roles are
resolved during setup. Owners may install ad-hoc typed components, then later
add the role to a future type revision if it should recur.

Published asset type revisions are immutable. Existing assets receive an
explicit reconciliation diff when fields, meters, or component roles change;
they never silently gain or lose components. Used types are archived instead of
deleted.

Assets are active, retired, disposed, or soft-deleted into restorable trash.
Retiring or disposing an asset pauses its future due calculations and reminders
without losing its component, maintenance, or placement history. Domain records
and attachment objects are never hard-deleted in the MVP.

Simple consumables and materials, such as oil or fasteners, are recorded on a
work item. A part becomes a child asset when its identity, installed history,
schedule, meter, reuse, upgrade, or resale history matters.

## Meters, Time, and Baselines

Asset types may define multiple meters. Readings can be recorded independently
or while completing work. A component inherits compatible usage from its host
by default, while it is installed. Owners may set a used component's starting
usage, record corrections, or select a self-managed meter. Usage must never be
double-counted.

Store instants such as reading capture, synchronization, and email delivery in
UTC. Store calendar-only facts, such as a maintenance date or an annual due
date, as dates rather than invented timestamps. Calendar recurrences use the
asset site's IANA timezone. A completed job snapshots its place and timezone;
members view instants in their own timezone while retaining the original
site-local context.

An asset with unknown prior maintenance history must not gain fictional
completions. An owner can:

- Record evidence of known prior work;
- Perform the work now; or
- Acknowledge an unknown-history tracking baseline at the current date and
  effective usage.

The last option schedules future work from that baseline but reports that
history before it is unknown.

## Maintenance Schedules and Due Work

A type can offer multiple named schedule alternatives. An asset activates one
base schedule and may add requirements, disable inherited requirements, or
override an inherited rule. Components run their own schedules; a parent asset
rolls up due work from its currently installed descendants without duplicating
their requirements.

Schedules and their published revisions are immutable. A revision change is
adopted through an atomic diff: unchanged requirements keep their stable
internal identity and prior completions, new requirements request a baseline,
removed requirements stop producing future work, and explicit asset overrides
remain intact. A schedule source stores kind, title, edition or date, page or
section, URL or notes, and optional manual attachments.

Requirements have a standard action category such as inspect, clean, adjust,
lubricate, replace, or service, plus a custom title and instructions. A
requirement can use one or more of these trigger families:

- One-time date or meter milestones;
- Recurring elapsed intervals;
- Recurring meter intervals;
- Calendar recurrences; and
- Manual or as-needed work with no automatic due calculation.

Recurring meter and time rules may be rolling from completion or anchored to
fixed lifetime or calendar milestones. Requirements can have an initial phase
followed by recurrence. Their trigger policy is configurable as first reached
or all reached, with first reached as the default. The stored trigger model is
typed and extensible so future trigger types do not require a generic expression
language in the MVP.

Due work has a primary state of `upcoming`, `due_soon`, `due`, or `overdue`.
`due_soon` starts using workspace defaults or a requirement override. Work is
overdue immediately after its authoritative threshold; Wrenchbase does not
invent a safety grace period. `history_unknown` and `reading_needed` are
separate data-quality flags. A planned job adds a `planned` annotation but never
clears due work.

A stale meter requests a new reading and never makes meter-based work appear
safe. Time-based rules continue calculating. When a completed work item has a
meter-based requirement, it must capture an effective reading at the work time;
for example, work completed at 25,000 km on a 5,000 km rolling interval is next
due at 30,000 km.

## Jobs, Work Items, and Maintenance Needs

Jobs follow `draft → planned → active → closed`. Planned jobs may assign one or
more workspace members, and a work item can override that assignment. A job has
a planned and actual range; completed work items may record their own local date
and optional time. A job can be cancelled before closure. Closed jobs are
corrected by a traceable amendment or voided with a reason, never silently
overwritten or deleted.

A job contains targeted work items. Each work item can be ad hoc or explicitly
fulfill one or more requirements on its target asset. Only completed work items
reset those requirements and immediately project their next occurrence.
Deferred or not-done work remains due. Closing a partially completed job prompts
the member to carry unfinished items into a new planned job or create a
maintenance need.

Any workspace member can add an ad-hoc work item while a job is `draft`,
`planned`, or `active`, including while work is happening on site. The member
chooses its target asset and may record materials, evidence, a cost allocation,
and an inspection outcome. An ad-hoc work item is historical work by default;
it affects a requirement only when the member explicitly maps it to that
requirement. Closed jobs are never edited in place: a later correction or
on-site discovery is recorded through an amendment or a new job.

A job records its site or location by default, but may use a maintainer address
or custom place. Completion snapshots the chosen place, address, and timezone.
It may include reusable external people or organizations, workspace members,
and participant roles. A person may be affiliated with an organization.

The job total is stored once. Optional work-item allocations support component
reporting without double-counting unallocated cost. Currency is snapshotted on
the job. Receipts and invoices can attach to the job; photos and other evidence
can attach to either the job or a specific work item.

An inspection may record its outcome and create a linked maintenance need. A
maintenance need is immediately due or has a one-off date or meter target. It
is resolved by later work or voided with a reason; it is not automatically
converted into a recurring schedule requirement.

A replacement work item atomically ends the old component installation and
installs the new one. The new component starts its own lifecycle at installation
unless it is a previously used asset with existing history. The old component
must be moved, reinstalled, retired, or disposed. Parent reports retain the
complete lifecycle of both components during their installation periods.

## Notifications and Reports

The notification center is the source of truth for due work, meter-reading
reminders, assignments, and sync problems. Members choose their own email
subscriptions. Email sends immediate state-transition alerts and a weekly
unresolved-work digest by default; the digest is configurable or can be
disabled.

Workspace-only reports show an asset's identity, current configuration,
component and location lifecycle, service timeline, schedule compliance, due
work, costs, maintainers, and evidence. Public links, PDF/CSV export, and buyer
reports are later features.

## Offline Behavior

The browser caches recently used and explicitly pinned asset trees for offline
reading and job drafting. Large attachments download only when requested.
Offline jobs can include readings, attachments, work items, and component
replacements, but may create assets only from cached existing asset types. Asset
type and schedule authoring stays online-only.

Drafts and attachments persist locally with client-generated IDs. The open app
automatically tries to synchronize on reconnect, open or foreground, and online
saves; members can also use Sync now and Retry. Wrenchbase does not promise
closed-browser background synchronization in the MVP.

The first successful upload creates a shared server draft. Its author remains
the editor until an explicit handoff. A job marked complete offline publishes
only after all content is uploaded and the API atomically validates current
state. Transient failures are retryable. Semantic conflicts become
`needs_review` and preserve the draft and evidence.

Conflict resolution never guesses. Members can retarget stale component work,
correct conflicting meter readings, map work to a current requirement, or keep
work as ad hoc history. Client idempotency prevents repeated sync attempts from
creating duplicate jobs.

## MVP Acceptance Scenarios

- A workspace owner invites a partner, configures sites and locations, and both
  can manage maintenance data while only the owner manages membership.
- A user who belongs to both a home and workshop workspace switches between
  them without seeing cross-workspace assets; a new user may create a workspace
  or accept an owner-sent invitation.
- An owner defines a 2024 Yamaha NMAX type with a recursively typed CVT, then
  creates a concrete NMAX with required components.
- A second-hand asset at 35,000 km acknowledges an unknown brake-fluid baseline
  and tracks the next 10,000 km interval without claiming a prior replacement.
- Completing an oil change at 25,000 km clears the current due item and projects
  30,000 km; deferred CVT cleaning stays due with a planned-job annotation.
- A closed weekend job carries unfinished work forward without resetting its
  requirements.
- A member adds an unplanned repair while an active service job is in progress;
  the repair is retained as ad-hoc history unless it is explicitly linked to a
  maintenance requirement.
- Replacing an engine preserves the old engine's work history, starts the new
  engine's lifecycle, and keeps the parent asset's report coherent.
- A schedule revision adding a three-month oil-change trigger retains existing
  oil-change completion history while recalculating the earliest next due point.
- A member records work offline, uploads it when the app reconnects, and reviews
  a replacement conflict without losing photos or receipts.

## Non-Goals

The MVP excludes customer management, bookings, billing, procurement, inventory
management, accounting integrations, public schedule catalogs, asset type
inheritance, arbitrary rule formulas, sensor-driven maintenance prediction,
advanced facility modeling, granular custom roles, public report links,
PDF/CSV export, web push, and guaranteed closed-browser background sync.
