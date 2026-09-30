# API Contract

This document defines cross-cutting API behavior. The
[canonical PRD](../_bmad-output/planning-artifacts/prds/prd-wrenchbase-2026-09-21/prd.md)
is authoritative for domain behavior; capability documentation and tests define
each resource's fields and commands.

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

Use JSON:API 1.1 request, response, and error documents with the
`application/vnd.api+json` media type. Attribute and relationship field names
use lower camel case. Dates use ISO 8601 dates; instants use RFC 3339 UTC
timestamps. Monetary amounts use integer minor units with an explicit ISO 4217
currency code.

Successful creates return `201 Created`, a `Location` header, and the created
resource document. Updates and commands return `200 OK` with the resulting
resource or read-model document. Destructive-looking domain commands such as
retire, dispose, void, and restore return the resulting historical state rather
than `204 No Content`.

Collections use opaque cursor pagination. Clients may request a documented,
bounded `page[size]` and pass the server-supplied cursor through `page[after]`.
Collection documents expose the next page through a JSON:API `links.next` URL.
Each collection documents an immutable, deterministic cursor order; mutable
display fields are not cursor keys. Filtering, inclusion, sparse fieldsets, and
sorting are capability-specific. An unsupported query parameter returns `400`
with a stable JSON:API error code rather than being ignored. New optional
response fields are compatible; renaming, removing, or changing the meaning of
a field requires a new API version.

## Errors, Concurrency, and Idempotency

Errors use JSON:API error objects with `status`, a stable `code`, `title`, and
safe `detail`. Field-specific errors use a JSON Pointer in `source.pointer`.
Every error response includes a correlation ID in both a response header and
error metadata. The API uses `400` for a malformed request or unsupported query,
`401` for an invalid or missing token, `403` for a known but unauthorized
workspace action, `404` for an unavailable scoped resource, `409` for a
current-state conflict, `412` for a stale precondition, `415` for unsupported
media, `422` for a well-formed request that violates validation or domain rules,
and `428` when a required precondition is missing.

Mutable resource metadata includes an opaque resource `revision`. Responses also
include a strong `ETag` for the exact representation. When a representation
contains caller-specific access metadata, its ETag incorporates the resource
revision, caller membership revision, and actor identifier; different
representations must not share a strong ETag.

A command that depends on the current state supplies the ETag through
`If-Match`. A missing precondition returns `428`; a precondition that no longer
matches the caller's current representation returns `412`. After authorization
and precondition validation, the API uses the resource revision for persistence
compare-and-swap. A command based on current state that conflicts for another
domain reason returns `409` with a semantic error code and a safe conflict
summary. Clients must not retry `409` or `412` responses blindly.

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
