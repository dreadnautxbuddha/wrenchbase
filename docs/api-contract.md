# API Contract

This document defines cross-cutting API behavior. The [product requirements](product-requirements.md)
remain authoritative for domain behavior; capability documentation and tests
define each resource's fields and commands.

## Versioning and Authentication

All public endpoints are versioned below `/api/v1`. Clients authenticate with
an OpenID Connect bearer access token. The API validates the token's issuer,
audience, expiry, and subject, then resolves the Wrenchbase user; clients do
not send identity-provider user IDs as trusted request data.

Workspace-owned resources are scoped by path, for example
`/api/v1/workspaces/{workspaceId}/assets`. A request is authorized for the
named workspace before any resource is read or changed. A resource identifier
from another workspace is indistinguishable from a missing resource.

## Requests and Responses

Use JSON request and response bodies with UTF-8 field names in lower camel case.
Dates use ISO 8601 dates; instants use RFC 3339 UTC timestamps. Monetary
amounts use integer minor units with an explicit ISO 4217 currency code.

Successful creates return `201 Created` and the created representation. Updates
and commands return `200 OK` with the resulting read model. Destructive-looking
domain commands such as retire, dispose, void, and restore return the resulting
historical state rather than `204 No Content`.

Collections use opaque cursor pagination. Clients may request a documented,
bounded page size and pass the server-supplied `nextCursor`; filtering and sort
options are capability-specific. New optional response fields are compatible;
renaming, removing, or changing the meaning of a field requires a new API
version.

## Errors, Concurrency, and Idempotency

Errors use `application/problem+json` with RFC 9457 fields plus a stable
`code`, optional `fieldErrors`, and a correlation ID. The API uses `400` for a
malformed request, `401` for an invalid or missing token, `403` for a known but
unauthorized workspace action, `404` for an unavailable scoped resource, `409`
for a current-state conflict, and `422` for a valid request that violates domain
or validation rules.

Mutable representations include an opaque `revision`. A command that depends on
the current state supplies that revision through `If-Match`; a stale revision
returns `409` with a semantic conflict code and the current representation or a
safe conflict summary. Clients must not retry semantic conflicts blindly.

Every create or publish command accepts an `Idempotency-Key` UUID. The API
stores the key, workspace, authenticated user, request fingerprint, and result
for a bounded retention period. Repeating the same request returns the original
result; reusing a key with a different request is rejected.

## Attachments

The API authorizes an attachment before issuing a short-lived, single-object
signed upload URL to private S3-compatible storage. The client reports upload
completion to the API, which verifies object metadata before linking the object
to a job or work item. Downloads use short-lived signed URLs after the same
workspace authorization check.

The MVP accepts JPEG, PNG, WebP, HEIC, and PDF evidence. The deployment defines
the maximum object and job totals; the reference defaults are 25 MiB per object
and 250 MiB per job. Objects are immutable after confirmation, are never public,
and are retained with their domain record.

## Required Capability Documentation

Each implemented capability documents its routes, authorization capability,
request and response examples, state transitions, validation errors, pagination
and sort behavior, revision requirements, and idempotent commands. Contract
tests cover its successful, unauthorized, invalid, stale, and repeated-command
cases.
