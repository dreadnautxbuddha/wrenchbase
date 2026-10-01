---
source: ../../../../docs/offline-sync.md
status: final
updated: 2026-09-22
---

# Reconciliation: Offline Synchronization Contract

## Migration verdict

The contract remains the focused authority for delivery mechanics. Its visible
scope, sync states, retry triggers, publication gates, and explicit conflict
choices migrate to the MVP 5 section of `EXPERIENCE.md`. It creates no new
visual system; `DESIGN.md` supplies existing accessible status and conflict
treatments.

## Heading-complete mapping

| Source heading                       | Classification                                                  | Migration or retention                                                                                                                                                                                                                                                                                                                                              |
| ------------------------------------ | --------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `# Offline Synchronization Contract` | Retained focused document; `EXPERIENCE.md`; unresolved conflict | Preserve scoped offline behavior. Canonical PRD FR-32 overrides the contract's omission of offline Asset creation from cached existing Asset Types.                                                                                                                                                                                                                 |
| `## Local Outbox`                    | `EXPERIENCE.md`; retained focused document; deferred MVP 5      | Migrate the exact client states `pending`, `syncing`, `synced`, `failed`, and `needs_review`; Workspace/author safety; reconnect/open/foreground/online-save triggers; **Sync now** and **Retry**; and no closed-browser promise. IndexedDB, UUIDs, revisions, and dependency storage remain technical. UX-OQ-8 retains unspecified state presentation and cleanup. |
| `## Upload and Publish Sequence`     | `EXPERIENCE.md`; retained focused document; deferred MVP 5      | Migrate dependency-gated publication, shared draft authorship, explicit handoff, and replay safety. Retain exact upload/confirmation command order in the contract.                                                                                                                                                                                                 |
| `## Failure and Review`              | `EXPERIENCE.md`; deferred MVP 5                                 | Migrate preserved draft/Evidence on transient failure, explicit `needs_review`, current API state and conflict code, and the allowed retarget/correct/map/ad-hoc choices. Never silently change Component, Maintenance Schedule, Meter, or lifecycle state.                                                                                                         |
| `## Test Scenarios`                  | Retained focused document; validation evidence                  | Preserve duplicate-delivery, failed attachment, revoked Membership, stale replacement, and explicit-resolution scenarios as acceptance evidence; do not create screens from tests.                                                                                                                                                                                  |

## Conflict and gap audit

- The canonical PRD adds offline Asset creation using cached existing Asset
  Types and controls the product scope.
- `409`/`needs_review` remains distinct from `412` stale-form recovery.
- Authorization failure, partial interruption, cache freshness, and cleanup of
  `synced` records remain UX-OQ-8.

No qualitative detail is dropped. Storage, command order, and idempotency
mechanics remain in the retained contract.
