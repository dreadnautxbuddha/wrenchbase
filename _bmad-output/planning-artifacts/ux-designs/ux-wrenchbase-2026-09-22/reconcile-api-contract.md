---
source: ../../../../docs/api-contract.md
status: final
updated: 2026-09-22
---

# Reconciliation: API Contract

## Migration verdict

The API contract remains a focused technical authority. `EXPERIENCE.md` owns
only its user-visible consequences: explicit Workspace context, authoritative
returned state, distinguishable recovery states, input preservation, and safe
error presentation. It establishes no independent visual direction.

## Heading-complete mapping

| Source heading                            | Classification                                                       | Migration or retention                                                                                                                                                                                                                                                                                                                                          |
| ----------------------------------------- | -------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `# API Contract`                          | Retained focused document                                            | Retain API ownership of wire behavior; UX cites it and does not duplicate the protocol.                                                                                                                                                                                                                                                                         |
| `## Versioning and Authentication`        | Retained focused document; `EXPERIENCE.md`                           | Retain `/api/v1`, bearer-token validation, and authorization mechanics. Migrate explicit Workspace context, provider-neutral session behavior, and concealed cross-Workspace lookup.                                                                                                                                                                            |
| `## Requests and Responses`               | Retained focused document; `EXPERIENCE.md`                           | Retain JSON:API, field formats, status codes, cursor mechanics, and compatibility rules. Migrate the rule that clients render returned authoritative representations and present collection loading/retry without exposing opaque cursors. No pagination control is invented.                                                                                   |
| `## Errors, Concurrency, and Idempotency` | `EXPERIENCE.md`; retained focused document; unresolved conflict      | Migrate safe details and copyable correlation context; distinguish `401`, `403`, `404`, `409`, `412`, `422`, and `428`; preserve input; never blind-retry `409` or `412`; reuse an idempotency key only for the same submission. ETags, revisions, fingerprints, and transport mechanics remain focused. UX-OQ-6 retains the missing-precondition recovery gap. |
| `## Attachments`                          | Retained focused document; deferred MVP 3/MVP 5; unresolved conflict | Retain signed-URL, confirmation, privacy, immutability, and protocol details. Later Evidence UX must not claim success before confirmation. UX-OQ-7 retains the mismatch between the image/PDF allow-list or reference limits and the broader/open PRD boundary. No attachment component is invented.                                                           |
| `## Required Capability Documentation`    | Retained focused document; `EXPERIENCE.md` validation rule           | Each implemented capability must have UX ownership for exposed success, unauthorized, invalid, stale, conflict, and repeated-command outcomes; route/contract examples and tests remain focused documentation.                                                                                                                                                  |

## State mapping

- `401` maps to Session expired or sign-in recovery.
- `403` maps to Unauthorized; known unavailable controls are already hidden by
  returned Capabilities.
- `404` maps to one concealed Not found experience for missing and
  cross-Workspace resources.
- `409` maps to explicit semantic Conflict review.
- `412` maps to stale-edit comparison and deliberate resubmission.
- `422` maps by stable code and source pointer to field Validation or a
  domain-rule Page Alert; it is not assumed to be field validation.
- `428` remains UX-OQ-6.

## Open questions and dropped-detail audit

- **UX-OQ-6:** user-facing missing-precondition recovery is unspecified.
- **UX-OQ-7:** Evidence formats and quantitative limits require product
  approval before becoming UX promises.

No UX-relevant detail is dropped. Protocol and storage facts excluded from the
spines remain in this retained focused document.
