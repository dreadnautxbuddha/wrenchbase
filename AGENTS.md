# Wrenchbase

Wrenchbase is an open-source, mobile-first maintenance tracker for vehicles, equipment, and nested assets.

## Product Direction

- Keep the product useful for individuals, hobbyists, small garages, and small teams.
- Prioritize mobile-first workflows.
- Support configurable asset types and attributes.
- Support parent and child asset relationships.
- Preserve historical maintenance records.
- Treat maintenance jobs as append-friendly records with clear history behavior.
- Keep offline support scoped and practical for v1.

## Stack

- Monorepo
- Backend: Symfony API
- Frontend: Next.js, React, and TypeScript
- Database: PostgreSQL
- Local development: Docker Compose

## Engineering Guidance

- Prefer clear domain modeling over generic JSON-only storage.
- Use configurable attributes, but keep core concepts relational.
- Use archived or deactivated asset type attributes instead of deleting attributes that are already used.
- Use TanStack Query for frontend server state.
- Use IndexedDB, likely through Dexie, for offline job drafts and queued attachments.
- Do not use localStorage for meaningful offline data.
- Keep asset type, attribute, and maintenance plan changes online-only in v1.
- Allow offline creation of maintenance jobs in v1, but avoid offline edits and deletes until sync behavior is more mature.
