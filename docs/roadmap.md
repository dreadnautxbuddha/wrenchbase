# Roadmap

This roadmap delivers one coherent MVP through capability milestones. Each
milestone should remain useful on its own while preserving the product rules in
the [product requirements](product-requirements.md).

The implementation details for the first milestone are captured in the
[MVP 0 implementation plan](mvp-0-implementation-plan.md).

## MVP 0: Delivery and Contract Foundation

- Provider-neutral OpenID Connect authentication, workspace onboarding,
  multi-workspace switching, and capability-based tenancy enforcement
- Versioned JSON:API conventions, semantic errors, cursor pagination,
  optimistic concurrency, and persisted idempotency results
- Shared-table PostgreSQL tenancy foundations, audit events, and a restricted
  application database role ready for defense-in-depth row-level security
- Mobile-first workspace navigation, accessibility, complete loading and error
  states, CI checks, and a real-stack browser golden path

## MVP 1: Workspace and Asset Foundation

- Owner-sent invitations and owner/member administration using
  capability-based authorization
- Expanded workspace settings, sites, and nested locations
- Versioned asset types with typed attributes, meters, and component roles
- Concrete assets, recursive installation history, placement, movement,
  retirement, disposal, and restorable trash

## MVP 2: Schedules and Due Work

- Versioned maintenance schedule alternatives and source citations
- Requirements with one-time, elapsed, meter, calendar, and manual triggers
- Rolling and anchored recurrence, initial service phases, overrides, and
  schedule adoption diffs
- Meter readings, inherited component usage, baselines, due-work calculation,
  and unknown-history handling

## MVP 3: Work Execution

- Planned, active, closed, amended, and voided maintenance jobs
- Targeted work items, partial completion, assignments, and requirement
  completions, including on-site ad-hoc work
- Maintainers, work locations, costs, attachments, inspection outcomes, and
  follow-up maintenance needs
- Private object storage with authorized signed attachment uploads and downloads
- Atomic component replacement and lifecycle reporting

## MVP 4: Awareness and Reporting

- Mobile-first due-work dashboard and notification center
- Per-member email preferences, due transitions, weekly digests, and
  meter-reading reminders
- Workspace-only asset, component, history, cost, evidence, and compliance
  reports

## MVP 5: Offline Resilience

- Recent and pinned offline asset trees
- Offline job drafts, meter readings, attachments, and replacement proposals
- Foreground automatic synchronization, outbox controls, idempotency, and
  `needs_review` conflict handling

## MVP 6: Production Readiness

- Portable production Docker Compose packaging, observability, health checks,
  and tested backup and restore runbooks
- Release checks and an AWS ECS/Fargate reference deployment

## Later

- Granular workspace roles and permissions
- Public and private schedule catalogs, imports, and sharing
- QR codes, CSV export, PDF reports, and buyer-facing report sharing
- Parts inventory, purchasing, procurement, and accounting integrations
- Push notifications, installable PWA support, and stronger background sync
- Advanced facility locations, maps, capacity, and geofencing
- Sensor integrations, adaptive maintenance indicators, and prediction
- React Native client and broader enterprise CMMS workflows
