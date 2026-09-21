# Product Vision source extraction

Source: `docs/product-vision.md`

Purpose: capture the vision document's settled product decisions and its exact
heading coverage for reconciliation into the canonical Wrenchbase PRD. This
extraction does not supersede the source.

## Heading-by-heading coverage checklist

- [x] `# Product Vision`
- [x] `## Product Promise`
- [x] `## Principles`
- [x] `## Audience`
- [x] `## Scope`
- [x] `## Non-Goals For The First Version`

## `# Product Vision`

### Decisions and intent

- Wrenchbase is a **mobile-first maintenance tracker** for physical assets that
  require recurring care.
- The originating user problem is personal ownership: follow an asset manual,
  record completed work, and know what is due next.
- The same maintenance loop applies across vehicles, equipment, tools,
  appliances, and recursively nested components.
- Product positioning deliberately occupies the space between vehicle-only
  tools and enterprise facilities/service-management systems.
- The product must combine detailed modelling (the source examples are an NMAX
  engine, CVT, flyball set, and upgrades) with approachability for simple or
  varied assets such as a scooter, gaming chair, tool, or small-business asset.

### PRD implications

- The canonical product definition must remain asset-category-neutral while
  supporting enough structure for complex, nested equipment.
- The core value loop is: represent the asset and its guidance, capture work,
  and expose what needs attention next.
- Complexity is justified only where it supports that loop for owners and small
  teams; enterprise service-organization breadth is outside the positioning.

## `## Product Promise`

### Promised capabilities

- Define reusable asset blueprints plus manufacturer-authored or custom
  maintenance schedules.
- Track concrete assets, components, upgrades, locations, and usage owned or
  operated by the user/workspace.
- Record planned and completed maintenance, repairs, inspections, and
  replacements, including maintainers, costs, photos, receipts, and documents.
- Preserve lifecycle meaning when components are installed, removed, replaced,
  moved, retired, or disposed.
- Classify work using the explicit user-facing states **upcoming**, **due soon**,
  **due**, **overdue**, **unknown**, and **waiting for a fresh meter reading**.

### Constraints

- Reusable definitions and concrete instances are distinct concepts.
- Planned work and completed historical work are both first-class.
- Component lifecycle events and supporting evidence must remain attributable
  and historically intelligible.
- Due-state presentation must represent uncertainty and insufficient meter data,
  not only time- or usage-based urgency.

## `## Principles`

### Product principles to preserve as PRD constraints

- **Mobile-first:** logging work must be practical in garages, roadside,
  workshops, and job sites.
- **Manual-led:** schedules represent manufacturer guidance or the owner's own
  practical maintenance decisions faithfully.
- **Flexible, not vague:** configurable asset types and recursive components
  remain typed, relational, and understandable.
- **History-preserving:** later changes to types, schedules, locations, and
  assets do not rewrite completed maintenance history.
- **Useful before complex:** complete the owner/small-team maintenance loop
  before adding enterprise workflows.
- **Honest about uncertainty:** unknown service history and stale meter readings
  are visible rather than converted into false certainty.
- **Offline where it matters:** users can draft work and evidence in the field
  and synchronize it safely after connectivity returns.

### Cross-cutting acceptance implications

- Mobile use is a primary workflow constraint, not a later responsive-design
  enhancement.
- Versioning/history semantics must preserve what was true when work occurred.
- Offline scope includes drafting work and evidence; synchronization must be
  safe, but the vision does not promise fully autonomous background sync.
- Typed domain modelling and usability must coexist; neither generic free-form
  records nor enterprise-level configurability satisfies the vision.

## `## Audience`

### Primary audiences

- Individuals maintaining their own vehicles, equipment, or household assets.
- DIY mechanics and hobbyists.
- Small garages, workshops, and businesses managing assets they own or operate.
- Small, trusted teams sharing a maintenance workspace.

### Audience boundary

- First-version garages do **not** manage customer accounts or customer-owned
  fleets as a garage-service product.
- A shop or mechanic may be recorded as the maintainer on a job.
- The workspace owns the records for the assets it manages.

### PRD implications

- Multi-user workspace collaboration is in scope, but enterprise organization
  and customer-relationship workflows are not.
- The data-ownership model centers the workspace and the assets it owns or
  operates, even when maintenance is performed externally.

## `## Scope`

### Explicit MVP scope

- Shared workspaces.
- Sites and locations.
- Versioned asset types.
- Recursive asset hierarchies.
- Typed meters.
- Maintenance schedules.
- Due work.
- Planned and completed jobs.
- Component replacement history.
- Evidence.
- Notifications.
- Workspace reports.
- Scoped offline job drafting.

### Source relationship

- This document explicitly delegates detailed behavior, terminology, lifecycle
  rules, and acceptance scenarios to `docs/product-requirements.md`.
- During reconciliation, this scope statement establishes product intent while
  the requirements source supplies the authoritative operational detail.

## `## Non-Goals For The First Version`

### Explicit exclusions

- Customer management, booking, and billing.
- Procurement, inventory management, and accounting integrations.
- Enterprise CMMS workflows.
- Public schedule catalogs or template sharing.
- Asset-type inheritance and arbitrary rule formulas.
- Advanced facility maps, capacity management, and geofencing.
- Granular custom permissions.
- Public reports, PDF/CSV export, and web push notifications.
- Guaranteed background synchronization while the browser is closed.

### Boundary clarifications

- Notifications and workspace reports are in MVP scope, but **web push**,
  **public reports**, and **PDF/CSV export** are explicitly excluded.
- Configurable/versioned asset types are in scope, but type inheritance is not.
- Offline job drafting and later safe synchronization are in scope, but reliable
  closed-browser background sync is not promised.
- Small garages are an audience, but customer-facing garage operations are not.

## Stable identifiers

- No stable requirement IDs or other normative identifiers appear in this
  source. IDs must be preserved from sources that define them; none should be
  invented solely to label statements from this vision extraction.

## Reconciliation tensions and missing decisions

No internal contradiction is present in this source. The following are
reconciliation checks for the other authoritative planning documents, not
assumed conflicts:

- **Release terminology:** the source uses both “MVP” and “first version.” The
  canonical PRD should confirm that these denote the same release boundary or
  state any difference explicitly.
- **Notification/report boundary:** notifications and workspace reports are in
  scope, while web push, public reports, and PDF/CSV export are not. Other
  sources must define the in-scope notification channels and report delivery.
- **Offline boundary:** “draft work and evidence” and “scoped offline job
  drafting” are promised, while closed-browser background sync is excluded.
  Other sources must settle exactly which records and evidence operations work
  offline and how conflicts/retries behave.
- **Workspace ownership boundary:** small garages may participate only for
  assets the workspace owns or operates; customer management is excluded. Other
  sources should be checked for any customer-asset or service-business workflow
  that would violate this boundary.
- **Lifecycle vocabulary:** installed, removed, replaced, moved, retired, and
  disposed are all named. Other sources must define whether these are formal
  states, events, or user actions and how they affect history.
- **Due-state vocabulary:** all six promised states must map consistently to the
  detailed due-status model; in particular, “unknown” and “waiting for a fresh
  meter reading” must remain distinguishable.

## Canonical PRD coverage obligations from this source

The reconciled PRD is incomplete unless it:

- states the owner/small-team recurring-maintenance value proposition;
- names and bounds all four audience groups and the no-customer-management rule;
- includes every explicit MVP scope item;
- retains every first-version non-goal;
- carries the seven product principles into functional or non-functional
  constraints;
- preserves lifecycle history and honest uncertainty as observable behaviors;
- distinguishes reusable definitions from concrete tracked assets; and
- reconciles the exact due-state and lifecycle vocabulary against the detailed
  requirements without silently dropping or broadening it.
