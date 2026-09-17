# MVP 1 Implementation Plan

This plan turns the workspace and asset foundation milestone into an
implementable sequence. The [product requirements](product-requirements.md)
remain authoritative for product behavior; this document records the decisions
made for MVP 1 delivery and builds on the
[MVP 0 implementation plan](mvp-0-implementation-plan.md).

## Goal and completion criteria

MVP 1 establishes the people, places, blueprints, and concrete assets needed by
all later maintenance workflows.

An owner can invite another person into a workspace and manage membership. A
member can create sites and nested locations, publish a versioned asset type
with typed attributes, meters, and component roles, and create a concrete asset
with recursively installed required components. Members can move, install,
detach, retire, dispose, trash, and restore assets without losing placement,
installation, revision, or audit history.

The milestone is complete when a real-stack browser test proves that two
members can manage one workspace while another workspace remains isolated, and
that an asset assembly retains coherent history through type adoption,
movement, component detachment, and lifecycle changes.

MVP 1 does not include meter readings, maintenance schedule authoring, due-work
calculation, maintenance jobs, attachments, reports, notification preferences,
or offline authoring. Transactional invitation email is included; maintenance
email belongs to MVP 4. Workspace photos and logos wait for the private object
storage introduced in MVP 3.

## Delivery slices

Deliver MVP 1 as four cohesive slices in dependency order:

1. Membership and invitations;
2. Sites and nested locations;
3. Versioned asset-type authoring; and
4. Assets, placement, component installation, and lifecycle.

Each slice updates the API contract, browser client, tests, and audit behavior
together. A slice may use foundations from an earlier slice but must not create
empty layers or speculative tables for a later one.

## Authorization capabilities

Continue using named capabilities returned by the API. The owner and member
roles grant capabilities; clients never infer permission from a role name.

Both owners and members receive:

- `workspace.read`;
- `workspace.membership.read`;
- `site.read` and `site.manage`;
- `assetType.read` and `assetType.manage`; and
- `asset.read` and `asset.manage`.

Owners additionally receive `workspace.update` and
`workspace.membership.manage`. Only the latter authorizes invitation creation
and revocation, member removal, and ownership transfer.

Authorization occurs before scoped resource lookup. Identifiers from another
workspace return `404`, including nested location, asset-type revision,
component, and installation identifiers.

## Membership and invitations

- Owners invite a normalized email address and may attach an optional personal
  message. A workspace may have only one unexpired pending invitation for the
  same normalized address.
- Normalize matching by trimming surrounding whitespace, applying Unicode case
  folding, and normalizing the domain through IDNA. Do not remove dots, plus
  suffixes, or other provider-specific aliases. Retain the submitted address
  separately for display and delivery.
- Invitations use a server-authenticated token with a random, single-use
  secret. Store only the secret's cryptographic digest, never the plaintext
  token. The invitation expires after seven days.
- Creating or resending an invitation rotates the secret and expiry and queues
  a new delivery. Revoking it makes every previously issued link unusable.
- The email link opens the browser application. The invitee signs in through
  OIDC before acceptance, and the API compares the provider-verified email with
  the invited address using the documented normalization policy.
- Acceptance is an idempotent command. It creates one active `member`
  membership, consumes the invitation, increments membership revisions, and
  writes audit events in one transaction.
- A signed-in user may inspect only the safe invitation summary needed to
  accept their own invitation. The API does not disclose workspace or invitee
  details to an unauthenticated or differently addressed user.
- Owners can list active members and pending invitations, revoke invitations,
  and remove members. All members can list active members so later assignment
  workflows do not require a contract change.
- Ownership transfers only to an active member. The transfer promotes the
  recipient and demotes the initiating owner atomically. The last owner cannot
  leave, be removed, or be demoted without a successful transfer.
- Membership rows and consumed or revoked invitations remain as historical
  records. Rejoining creates a new membership tenure rather than rewriting an
  old one.

Use a purpose-specific mail delivery port and a PostgreSQL transactional
outbox. Invitation creation and its delivery request commit together; a
retryable worker sends queued mail without making the HTTP request depend on
the mail provider. Development Compose uses a captured-mail service so the
real link can be exercised without sending external email. Later notification
delivery may reuse the transport and outbox, but not invitation-specific
application logic.

## Workspace settings

MVP 0 already provides name, locale, and default currency. MVP 1 adds unit
preferences for the measurement dimensions used by asset attributes and meter
definitions. Store canonical values in the API and use workspace preferences
only for input defaults and display conversion; changing a preference never
rewrites stored measurements.

Due-soon defaults are added with schedule work in MVP 2. Meter-reading reminder
defaults and email subscriptions are added with awareness work in MVP 4. A
workspace photo or logo is added after private attachment storage exists in
MVP 3. These deferrals keep settings from introducing incomplete domain or
storage behavior.

## Sites and nested locations

A site has a name, IANA timezone, optional structured postal address, lifecycle
status, immutable creation instant, and opaque revision. Its address fields are
address lines, locality, administrative area, postal code, and ISO 3166-1
country code; no field is invented when it is unknown.

Locations belong permanently to one site and form an ordered, arbitrarily
nested acyclic tree. A location has a name, optional parent, sibling position,
lifecycle status, and revision. The API calculates display paths from current
ancestors; paths are not authoritative identifiers. Moving a location between
parents is allowed only within its site and must reject cycles.

Creating a site does not invent a default location. Before creating a directly
placed active asset, the member explicitly creates or chooses a location.

Archiving a location archives its selected subtree atomically and is rejected
while any active asset is directly placed anywhere in that subtree. Installed
descendants are located through their directly placed root and therefore do not
need duplicate placement checks. Restoring a location requires an active site
and either no parent or an active parent. A site can be archived only when all
of its locations are archived and it has no directly placed active assets.

Renames, reparenting, sibling reordering, archival, and restoration are
revision-checked commands. Placement history and the completed-job snapshots
added in later milestones preserve historical site and location meaning even
when the current tree changes. Site and location change events retain their
before-and-after names, paths, address, and timezone where applicable so earlier
placement history remains explainable.

## Asset types and revisions

An asset type is a stable workspace-owned identity with an active or archived
lifecycle. Its revisions contain the user-visible blueprint. A new type begins
with one mutable draft. Publishing freezes that revision permanently, and
starting another revision clones the latest published revision into one new
draft. A type has at most one draft and one current published revision.

Members can delete a never-published draft type that has no references. Once a
type has been published or referenced, it is archived instead of deleted.
Archived types and all published revisions remain readable wherever history
references them. An archived type cannot start or publish a revision until it
is explicitly restored.

Publishing and archiving are idempotent, revision-checked commands. Publication
validates the complete blueprint and increments its positive revision number.
Asset creation accepts only a published revision; it never binds implicitly to
an editable draft.

Definitions inside a revision use stable UUIDs that survive cloning when the
concept remains the same. Renaming a definition keeps its identity. A genuinely
new attribute, meter, component role, or choice option receives a new identity;
removed definitions remain available through older revisions. The API never
matches definitions by title.

## Typed attributes

An attribute definition has a stable identity, unique key within the revision,
label, type, required flag, optional help text, sibling position, and an
optional type-valid default. Supported types are:

- short text;
- long text;
- decimal number;
- measurement with a declared dimension and canonical unit;
- boolean;
- calendar date; and
- single choice with ordered, stably identified options.

Keys are API-facing stable names and cannot be silently reused for a different
definition. Numeric values use exact decimal representation rather than binary
floating point. Measurement input is converted to the definition's canonical
unit before persistence. Choice values reference option identities, not labels.

Publication rejects duplicate keys, invalid defaults, empty choice sets, and
incompatible edits that reuse an existing identity for a different field type.
Required definitions without defaults are valid because asset creation can
request their values.

## Meter definitions

A meter definition has a stable identity, unique key, label, measurement
dimension, canonical unit, decimal precision, and sibling position. MVP 1
defines meters on asset types and instantiates their identities on assets; meter
readings and inherited usage begin in MVP 2.

Publication rejects units that do not belong to the declared dimension and
incompatible edits that reuse an identity with a different dimension. A later
revision may change the display label or preferred presentation unit without
changing the meter's accumulated meaning.

## Component roles

A component role has a stable identity, unique key, label, minimum and optional
maximum cardinality, sibling position, and one or more compatible asset types.
The minimum is non-negative; a maximum, when present, must be at least the
minimum. Compatibility references stable asset-type identities rather than
titles.

When a role has a positive minimum and exactly one compatible type, publishing
the parent revision snapshots that type's current published revision as the
automatic-child revision. Creating a parent automatically creates the minimum
number of children from that snapshot and installs them atomically. A later
child-type publication never changes an already published parent blueprint.
Generated child names use the role label and an ordinal when needed and can be
edited later. Ambiguous required roles are resolved explicitly during parent
creation by choosing compatible published revisions.

Publication rejects a required role with no compatible published type and any
chain of unambiguous required roles that would recurse forever during automatic
child creation. Archiving a type is rejected while a current published revision
depends on it for automatic child creation. Optional compatibility cycles are
allowed because concrete asset installations independently enforce acyclicity.

Members may also install an ad-hoc typed component without a blueprint role by
providing a role label. A later asset-type reconciliation may explicitly map
that installation to a newly defined role; it never matches by label
automatically.

## Concrete assets and configured values

An asset has a stable identity, editable name, lifecycle state, referenced
asset-type revision, configured attribute values, instantiated meters, opaque
revision, and creation instant. Creation requires either a direct active
location or a parent installation. Required child creation and every initial
placement or installation occur in the same transaction.

The API validates configured values against the selected published revision.
Defaults are materialized when the asset is created so a later blueprint change
cannot reinterpret an existing value. Unknown optional values stay absent;
required values without defaults must be supplied during creation or explicit
required-role resolution.

Configured values retain their definition identity and the revision under
which they were accepted. Values removed by a later type adoption remain
historically readable but are no longer part of the active configuration.

## Placement and installation history

Every active asset has exactly one current placement:

- a direct placement in one active workspace location; or
- an open installation in one active parent asset.

Direct placements and installations are dated history records, not columns on
the asset. Changing placement atomically closes the previous record and opens
the new one. Commands accept an effective instant, defaulting to the API clock,
and reject chronology that overlaps or predates later recorded transitions.

Installing a component requires an active child and parent in the same
workspace, a compatible role or an explicit ad-hoc label, available role
capacity, and a result with no asset cycle. Moving an installed component to a
location is the detach operation. Moving a directly placed asset into a parent
is the install operation. Moving an assembly moves only its directly placed
root; installed descendants continue deriving site and location from that
root.

MVP 1 records manual detach and install operations but does not present them as
completed maintenance. MVP 3 adds the purpose-specific replacement work item
that closes one installation and opens another as part of an atomic job
completion.

## Lifecycle and installed subtrees

Asset lifecycle states are `active`, `retired`, `disposed`, and `trashed`.
Trash also records the prior state so restoration has an explicit target.
Retirement, disposal, trash, and restoration are commands with a reason,
effective instant, actor, and audit event; they never delete asset history.

When an active asset leaves `active`, the command closes its incoming direct
placement or parent installation. Installations below that asset remain open,
so the assembly stays structurally intact even though its root no longer has an
active placement. Reactivating a retired assembly root must give it a new active
direct location or compatible parent in the same transaction.

When a host leaves `active`, every component still installed beneath it remains
installed and keeps its own lifecycle state. The entire installed subtree is
operationally paused because it has no active root: later due-work calculation
and reminders must treat every descendant as paused without fabricating
individual retirement or disposal events.

The lifecycle command may detach selected component subtrees atomically before
the host changes state. Selections must be non-overlapping. Each selected root
must, in the same request, be placed in an active location, installed in a
compatible active parent outside the transitioning subtree, retired, or
disposed. Its installed descendants move or pause with it. The API validates
every destination, lifecycle choice, and cycle before changing anything. If any
selection is invalid, neither the detachments nor the host lifecycle transition
occurs.

An asset inside an already paused subtree must be detached through one atomic
command before it can resume independently. That command gives the selected
subtree an active placement or transitions it to retired or disposed; it cannot
leave the selected root locationless and active. A command may also dispose or
trash a whole retained assembly. Reactivating a retired root or restoring an
active root resumes still-active installed descendants. Descendants with their
own retired, disposed, or trashed state remain inactive.

Restoring a trashed asset returns it to its recorded prior lifecycle state. If
that state is active, the command must supply an active direct location or a
compatible active parent unless its retained assembly root is restored in the
same transaction. A retired restoration remains paused and does not require an
active placement. Disposed assets are not restorable; a correction uses a
separately audited lifecycle amendment rather than overwriting the disposal
event.

## Asset-type adoption and reconciliation

An existing asset never silently adopts a new asset-type revision. A preview
endpoint returns a reconciliation diff using stable definition identities:

- unchanged and renamed attributes, meters, and component roles;
- added definitions and values or decisions they require;
- removed definitions retained as historical configuration;
- compatible and incompatible type changes; and
- current installations that can remain, need explicit mapping, or violate a
  new maximum cardinality.

The member submits explicit resolutions with the current asset and target type
ETags. New required attribute values and ambiguous required components must be
provided. Unambiguous required components may be created atomically. Existing
ad-hoc installations may be explicitly mapped to new roles. Reconciliation
never uninstalls, retires, disposes, or deletes an asset automatically.

Adoption is one transaction and records both the previous and adopted revision
plus the accepted diff. A stale preview returns `412`; a still-current request
that cannot satisfy the target blueprint returns a semantic `409` or validation
`422` as appropriate.

## API contract

All MVP 1 endpoints remain under `/api/v1`, use JSON:API 1.1, and follow the
existing pagination, errors, correlation, ETag, precondition, and idempotency
contracts. Capability documentation added with each slice defines exact
resources and examples.

Collections use immutable creation instant and UUID cursor ordering unless the
capability documents another immutable order. Tree and sibling ordering are
returned as resource data, not used as collection cursor keys.

Create commands and commands that may emit more than one record require an
`Idempotency-Key`. Mutations based on visible current state require `If-Match`.
Compound lifecycle, placement, publication, acceptance, and reconciliation
commands are atomic and return their resulting read model.

The API exposes purpose-specific command endpoints rather than asking clients
to coordinate invariants through generic resource patches. This applies to
invitation acceptance, ownership transfer, location-tree moves, publication,
asset placement, component installation, lifecycle transitions, and revision
adoption.

## Persistence and tenancy

Add relational storage only as each slice requires it. Expected concepts
include invitations, membership tenures, mail outbox entries, sites, locations,
asset types and revisions, revision definitions, assets, configured values,
meters, placements, installations, lifecycle events, and reconciliation
records. Exact tables remain implementation decisions of their capability.

Every tenant-owned row has a non-null workspace scope. Composite constraints
and foreign keys prevent cross-workspace parentage, compatibility, placement,
and installation. Enable PostgreSQL Row-Level Security for tenant-owned MVP 1
domain tables using transaction-local workspace context and the restricted
runtime role established in MVP 0. Application authorization remains the
capability system; RLS is defense in depth.

Users, external identities, workspaces, memberships, invitations, idempotency
records, audit events, and delivery outbox records are control-plane data and
remain outside tenant-domain RLS. Their repositories still require explicit
actor or workspace scope as appropriate.

Use database constraints for local facts such as uniqueness, revision
compare-and-swap, one current placement, one open installation, and role
capacity where practical. Use domain logic within locked transactions for graph
acyclicity, subtree lifecycle transitions, recursive creation, and
reconciliation.

## Browser application

Add capability-focused features for membership, sites, asset types, and assets.
Keep authenticated routes client-composed under the MVP 0 OIDC decision. Use
Application ports and use cases for API access, private Infrastructure DTOs and
runtime parsing, TanStack Query for server state, and thin Next.js delivery
files.

Provide mobile-first workflows for:

- accepting an invitation after sign-in;
- listing members and pending invitations, with owner-only controls;
- creating sites and browsing, adding, moving, ordering, archiving, and
  restoring nested locations;
- authoring and validating a draft asset type, reviewing its full blueprint,
  and confirming publication;
- creating an asset and resolving ambiguous required components;
- browsing an asset tree with current type revision and inherited location;
- moving, installing, and detaching an asset with the consequential target
  visible before confirmation;
- previewing and applying an asset-type reconciliation; and
- retiring, disposing, trashing, or restoring an assembly, including choosing
  components to detach and rehome atomically.

Forms preserve entered values after validation, network, `409`, or `412`
responses. Destructive-looking lifecycle screens explain retained history and
paused descendants. Tree controls are keyboard accessible, do not rely on drag
and drop, and expose an explicit move action suitable for touch and assistive
technology.

## Testing and CI

API tests cover invitation secrecy, expiry, resend, revocation, verified-email
matching, acceptance replay, membership tenure, last-owner protection,
ownership transfer, capabilities, audit events, and mail-outbox retry behavior.

Site and location tests cover timezone and address validation, ordering,
reparenting, cycle rejection, archive restrictions, subtree archival,
restoration, revisions, and cross-workspace isolation.

Asset-type tests cover draft mutability, published immutability, stable
definition identities, typed defaults and values, units, choice options,
cardinality, compatible types, required-role recursion, publication replay,
archival, and restoration.

Asset tests cover recursive creation, ambiguous required roles, direct and
inherited placement, movement chronology, role capacity, installation cycles,
ad-hoc components, type-revision previews and stale adoption, retained removed
values, lifecycle history, subtree pause and resume, atomic selected-component
detachment, restore placement, and cross-workspace isolation.

Web tests cover capability-driven controls, invitation states, keyboard-usable
location and asset trees, draft publication errors, asset creation, preserved
form state, reconciliation decisions, stale revisions, and lifecycle
confirmation language.

Extend the Playwright golden path using the real Compose stack and serial
Chromium:

1. An owner invites the second development user and captures the invitation
   email.
2. The second user signs in, accepts the invitation, and switches into the
   shared workspace.
3. A member creates a site and nested locations.
4. A member publishes a parent and component asset type, then creates an asset
   with a recursively installed required component.
5. A member moves the assembly, installs an ad-hoc component, and adopts a new
   parent-type revision through the reconciliation preview.
6. A member retires the host while atomically detaching one selected component
   to an active location, then verifies the retained subtree is paused.
7. The owner transfers ownership and the former owner remains a member.
8. A user in another workspace receives `404` for the shared workspace's site,
   type, asset, and installation routes and API requests.

Run primary creation, tree, and lifecycle paths at a narrow mobile viewport.
Retain traces, screenshots, and the HTML report on failure. Every slice keeps
`make check` green and adds migration and RLS integration coverage before its
tenant-owned tables ship.

## Delivery sequence

1. `feat(memberships): add invitations and member administration`
2. `feat(locations): add sites and nested workspace locations`
3. `feat(asset-types): add versioned typed asset blueprints`
4. `feat(assets): add asset creation and placement history`
5. `feat(assets): add installation and lifecycle transitions`
6. `feat(asset-types): add explicit asset revision reconciliation`
7. `test(e2e): cover the workspace and asset foundation golden path`

Large slices may use smaller cohesive commits, but implementation and directly
related tests remain together. Every client-visible contract change updates the
shared API documentation in the same commit.
