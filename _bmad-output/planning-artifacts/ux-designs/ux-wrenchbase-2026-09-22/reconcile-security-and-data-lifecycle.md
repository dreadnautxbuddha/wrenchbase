---
source: ../../../../docs/security-and-data-lifecycle.md
status: final
updated: 2026-09-22
---

# Reconciliation: Security and Data Lifecycle

## Migration verdict

This policy remains a focused security and lifecycle authority. Privacy-facing,
authorization, concealment, Evidence, and historical-state consequences migrate
to `EXPERIENCE.md`; it does not authorize a new route, audit-log surface, or
visual direction.

## Heading-complete mapping

| Source heading                        | Classification                                                        | Migration or retention                                                                                                                                                                                                                                                                    |
| ------------------------------------- | --------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `# Security and Data Lifecycle`       | Retained focused document; `EXPERIENCE.md`                            | Preserve the private nature of maintenance, Location, cost, and Evidence data and reflect it in safe UI states and examples.                                                                                                                                                              |
| `## Identity and Tenant Isolation`    | `EXPERIENCE.md`; retained focused document; deferred MVP 1            | Migrate Capability-driven controls, explicit Workspace context, concealed cross-Workspace lookup, owner-only Membership management, safe invitation behavior, and last-owner constraints. OIDC and enforcement mechanics remain technical; invitation/ownership screens are not invented. |
| `## Attachments and Sensitive Data`   | Retained focused document; deferred MVP 3/MVP 5; unresolved conflict  | Migrate private, authorized, confirmed Evidence behavior and safe failure handling. Keep storage, encryption, secret, log-redaction, metadata, and malware-scanning mechanics focused. UX-OQ-7 retains the allow-list/product-boundary question.                                          |
| `## Historical Records and Retention` | `EXPERIENCE.md`; retained focused document; deferred later milestones | Preserve distinct `active`, `retired`, `disposed`, and `trashed` meanings; amendment/void rather than silent overwrite; readable history; and no implied hard deletion. Backup operations remain focused. PRD OQ-3 keeps trash retention unresolved.                                      |
| `## Audit and Incident Response`      | Retained focused document; `EXPERIENCE.md` consequence                | Preserve traceability where product history exposes actor/time/action/outcome. Do not invent a global audit viewer or incident-notification UX; alerting and response operations remain focused.                                                                                          |

## Safety and dropped-detail audit

Product UI and mockups never expose bearer tokens, invitation secrets, signed
URLs, credentials, passwords, or internal logs. No qualitative UX detail is
dropped; un-migrated facts remain security, operations, or later-milestone
implementation details.
