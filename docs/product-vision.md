# Product Vision

Wrenchbase is a mobile-first maintenance tracker for assets that need recurring care.

Many maintenance tools are either too narrow, focused only on cars, or too heavy, designed for large facilities and enterprise maintenance teams. Wrenchbase aims to sit in the middle: flexible enough to model vehicles, parts, equipment, and nested assets, while remaining simple enough for individuals, hobbyists, small garages, and small teams.

The core idea is simple:

- Define the kinds of assets you care about.
- Track the specific assets you own.
- Log maintenance and repair work over time.
- Attach photos, receipts, invoices, and documents.
- Compare completed work against recommended maintenance schedules.
- See what is due next.

## Principles

- Mobile-first: logging work should be practical from a garage, roadside, workshop, or job site.
- Flexible, not vague: users should be able to define custom asset types without turning the whole system into unstructured data.
- History-preserving: maintenance records should remain understandable even when asset types and attributes change later.
- Useful before complex: the first version should solve personal maintenance tracking well before expanding into heavier team workflows.
- Offline where it matters: users should be able to create maintenance job drafts without a connection, then sync later.

## Target Users

- Individuals maintaining their own vehicles or equipment
- DIY mechanics and hobbyists
- Small garages and workshops
- Small teams managing a modest set of physical assets

## Product Shape

Wrenchbase should support both simple and detailed tracking.

A user should be able to start with one scooter or car, then gradually add richer structure: tires, battery, engine, accessories, service schedules, receipts, and parts used. The product should not require enterprise setup before it becomes useful.

## Core Concepts

An asset is anything the user wants to maintain. Examples include a car, scooter, engine, tire, battery, tool, appliance, or piece of equipment.

An asset type defines what kind of asset something is. Asset types are user-configurable. A user might define a car asset type with fields such as manufacturer, model, year, plate number, and VIN. The same user might define a tire asset type with fields such as manufacturer, size, manufacturing date, and expiry date.

An asset can belong to another asset. This allows Wrenchbase to model nested structures such as:

```text
Scooter
  Engine
  Battery
  Tires
    Front Tire
    Rear Tire
```

A job records maintenance, repair, inspection, installation, replacement, or other work performed on an asset. Jobs should support dates, odometer or usage readings, cost, vendor or service provider, notes, part numbers, photos, receipts, and documents.

A maintenance plan describes recommended recurring work. Plans may come from manufacturer guidance or from the user's own schedule. Plan items may be based on distance, time, usage hours, or manual conditions.

The due-work engine compares maintenance plans against completed jobs and current usage. It should help users answer:

- What has already been done?
- What is due soon?
- What is overdue?
- What has never been done?
- Which asset or subpart needs attention next?

## Data Flexibility

Wrenchbase should support configurable asset attributes without turning the whole product into unstructured JSON.

Core concepts such as assets, asset types, attributes, jobs, attachments, maintenance plans, and plan items should remain relational. Flexible attribute values can use JSON where needed, but common scalar values such as text, numbers, dates, and booleans should remain practical to query and filter.

Asset type attributes that are already used by assets should not be hard-deleted. They should be archived or deactivated so existing asset history remains understandable and no attribute values become orphaned.

## MVP Scope

The first useful version should include:

- asset type builder with configurable attributes
- asset creation and editing
- parent and child asset hierarchy
- maintenance job logging
- photo and receipt attachments for jobs
- manufacturer or custom maintenance plans
- due and overdue maintenance calculation
- mobile-first dashboard
- asset service timeline
- pending sync and outbox view

The MVP should favor a coherent personal maintenance workflow over broad enterprise maintenance features.

## Offline Scope

Offline support is important, but the first version should keep it scoped.

Wrenchbase should allow users to view recently loaded assets and histories while offline. Users should also be able to create maintenance job drafts offline, including queued photos or receipts, then sync them later when the connection returns.

The first version should keep asset type changes, asset attribute changes, maintenance plan changes, edits, and deletes online-only. This avoids complex sync conflicts while still supporting the most likely offline workflow: logging work while standing near the asset.

Offline sync states should be visible and explicit:

- pending
- syncing
- synced
- failed
- needs_review

Failed syncs should never be silently discarded. Users should be able to review and retry pending work.

## Non-Goals For The First Version

- full enterprise CMMS workflows
- procurement and purchasing
- accounting integrations
- complex team permissions
- full offline-first editing of every record
- multi-device conflict resolution
- public marketplace or template sharing

These can be reconsidered later, but they should not distract from building a useful maintenance tracker first.
