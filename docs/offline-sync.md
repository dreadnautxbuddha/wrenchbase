# Offline Synchronization Contract

Offline support is intentionally limited to cached asset-tree reading and new
maintenance job drafts, readings, attachments, and replacement proposals. The
[product requirements](product-requirements.md) define which work is allowed;
this document defines how it reaches the API.

## Local Outbox

The browser stores meaningful offline data in IndexedDB. Each draft, queued
attachment, and queued command has a stable client-generated UUID and one sync
state: `pending`, `syncing`, `synced`, `failed`, or `needs_review`. A local draft
also records its workspace, author, target asset references, cached revisions,
and dependencies so it cannot be sent to a different workspace.

The app retries pending work when it reconnects, opens, returns to the
foreground, or saves online. Members can also choose Sync now or Retry. The app
does not claim to synchronize while closed.

## Upload and Publish Sequence

1. Create or update the server-side draft with its idempotency key.
2. Request and complete signed uploads for every queued attachment.
3. Confirm each uploaded object with the API.
4. Submit readings, replacement proposals, and work items against the server
   draft using their dependency order.
5. Publish a completed job only after all dependent content is confirmed.

The first successful draft upload creates a shared server draft. Its author is
the editor until an explicit handoff; workspace membership alone does not allow
another member to overwrite it. Replaying any completed step is safe through
the API idempotency contract.

## Failure and Review

Transport failures and temporary service errors move work to `failed` and retain
the draft and evidence for retry. A `409` semantic conflict moves it to
`needs_review`; the client preserves all local input and shows the current API
state and conflict code.

Conflict resolution is explicit. A member may retarget stale component work,
correct a conflicting meter reading, map work to a current requirement, or keep
it as ad-hoc history. The client submits the chosen resolution as a new,
idempotent command with current revisions. It never changes a replacement,
schedule, meter, or lifecycle state automatically.

## Test Scenarios

- Repeated delivery of the same queued command creates one server result.
- An attachment failure prevents job publication while retaining the local draft.
- A revoked membership or changed workspace causes a safe authorization failure.
- A stale replacement proposal becomes `needs_review` with its evidence intact.
- A resolved conflict publishes the member's explicit choice and leaves an
  auditable history.
