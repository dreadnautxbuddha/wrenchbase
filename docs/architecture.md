# Architecture

Wrenchbase is planned as a monorepo with a Symfony API, a Next.js frontend, PostgreSQL, and Docker Compose for local development.

## Repository Layout

```text
wrenchbase/
  apps/
    api/
    web/
  docker/
  docs/
  compose.yaml
  README.md
```

## Backend

The backend should keep core maintenance concepts relational and use flexible attribute values only where flexibility is required.

Planned core entities:

- `asset_types`
- `asset_type_attributes`
- `assets`
- `asset_attribute_values`
- `maintenance_plans`
- `maintenance_plan_items`
- `jobs`
- `job_attachments`

## Configurable Asset Types

Users can define asset types such as car, scooter, tire, battery, engine, appliance, or tool.

Each asset type can define attributes. Example attributes:

- Car: manufacturer, brand, model, year, plate number, VIN
- Tire: manufacturer, size, manufacturing date, expiry date
- Battery: manufacturer, model, voltage, installation date, warranty expiry

Assets must belong to an asset type. Assets may also have a parent asset, allowing structures such as:

```text
Car
  Engine
  Battery
  Tire Set
    Front Left Tire
    Front Right Tire
```

## Attribute Values

Attribute values should use a hybrid storage model:

```text
asset_attribute_values
  id
  asset_id
  asset_type_attribute_id
  value_json
  value_text
  value_number
  value_date
  value_boolean
```

`value_json` supports flexible or complex values. Typed columns make filtering and reporting practical for common cases such as dates, numbers, and booleans.

## Attribute Deletion

Asset type attributes should not be hard-deleted once used by an asset.

- If an attribute is unused, it may be deleted.
- If an attribute is used, it should be archived or deactivated.
- Archived attributes should remain visible on existing assets that already have values.
- Archived attributes should not appear by default when creating new assets.

This preserves historical data and prevents orphaned values.

## Maintenance Plans

Maintenance plans represent manufacturer or custom recommendations.

Plan items may be triggered by:

- distance, such as every 5,000 km
- time, such as every 6 months
- usage hours
- manual or condition-based intervals

The due-work engine should compare completed jobs against active maintenance plan items and return statuses such as:

- ok
- due soon
- overdue
- never done

## Frontend State

Use TanStack Query for server state such as assets, jobs, plans, and due-work summaries.

Use component state for simple UI state. Add a small client state library only if UI state becomes difficult to manage with React alone.

Offline data should be stored in IndexedDB, likely through Dexie. Do not use localStorage for meaningful offline data.

## Offline Scope

The first version should avoid full offline-first behavior.

Supported in v1:

- cached offline read access for recently viewed assets and histories
- offline creation of maintenance job drafts
- queued photo and receipt uploads
- sync status and outbox view

Online-only in v1:

- asset type changes
- asset attribute changes
- maintenance plan changes
- edits and deletes of existing records

Suggested sync states:

- pending
- syncing
- synced
- failed
- needs_review
