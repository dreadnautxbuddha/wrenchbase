# Product Vision

Wrenchbase is a mobile-first maintenance tracker for physical assets that need
recurring care.

It began with a simple owner problem: keeping a loved scooter or car properly
maintained by following its manual, recording completed work, and knowing what
is due next. Wrenchbase applies that same workflow to vehicles, equipment,
tools, appliances, and recursively nested components.

Many maintenance tools are too narrow, focused only on cars, or too heavy,
designed for enterprise facilities and large service organizations. Wrenchbase
sits in the middle: detailed enough to model an NMAX engine, CVT, flyball set,
and upgrades, while remaining approachable for a scooter, gaming chair, tool,
or small business asset.

## Product Promise

Wrenchbase helps an owner or small team:

- Define reusable asset blueprints and manufacturer or custom maintenance
  schedules.
- Track the concrete assets, components, upgrades, locations, and usage they
  own or operate.
- Record planned and completed maintenance, repairs, inspections, and
  replacements with maintainers, costs, photos, receipts, and documents.
- Preserve a clear lifecycle when a component is installed, removed, replaced,
  moved, retired, or disposed.
- See which work is upcoming, due soon, due, overdue, unknown, or waiting for a
  fresh meter reading.

## Principles

- Mobile-first: logging work must be practical in a garage, roadside, workshop,
  or job site.
- Manual-led: schedules should faithfully represent manufacturer guidance or an
  owner's own practical maintenance decisions.
- Flexible, not vague: configurable asset types and recursive components must
  remain typed, relational, and understandable.
- History-preserving: later changes to types, schedules, locations, and assets
  must not rewrite completed maintenance history.
- Useful before complex: solve the owner and small-team maintenance loop before
  expanding into enterprise workflows.
- Honest about uncertainty: unknown service history and stale meter readings
  must be visible rather than converted into false confidence.
- Offline where it matters: users can draft work and evidence in the field, then
  safely synchronize when connected.

## Audience

- Individuals maintaining their own vehicles, equipment, or household assets
- DIY mechanics and hobbyists
- Small garages, workshops, and businesses managing assets they own or operate
- Small, trusted teams sharing a maintenance workspace

Wrenchbase does not manage a garage's customers in the first version. Shops and
mechanics can appear as maintainers on a job, but the workspace owns the asset
records it manages.

## Scope

The MVP includes shared workspaces, sites and locations, versioned asset types,
recursive asset hierarchies, typed meters, maintenance schedules, due work,
planned and completed jobs, component replacement history, evidence,
notifications, workspace reports, and scoped offline job drafting.

The detailed product behavior, terminology, lifecycle rules, and acceptance
scenarios are defined in the [product requirements](product-requirements.md).

## Non-Goals For The First Version

- customer management, booking, and billing
- procurement, inventory management, and accounting integrations
- enterprise CMMS workflows
- public schedule catalogs or template sharing
- asset type inheritance and arbitrary rule formulas
- advanced facility maps, capacity management, and geofencing
- granular custom permissions
- public reports, PDF/CSV export, and web push notifications
- guaranteed background synchronization while the browser is closed
