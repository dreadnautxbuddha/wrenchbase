# Security and Data Lifecycle

Wrenchbase holds private maintenance, location, cost, and evidence data. This
policy establishes MVP safeguards for every supported deployment.

## Identity and Tenant Isolation

Authentication is delegated to a configured OpenID Connect issuer. The API maps
the verified subject to a Wrenchbase user and authorizes named capabilities for
the workspace in every request. Authorization happens before reads, mutations,
attachment URLs, report queries, and background delivery. Repository queries and
asynchronous jobs must carry a workspace scope; cross-workspace identifiers must
not disclose whether a record exists.

Only owners manage membership. Invitations are signed, expiring, single-use,
bound to a verified email address, and revocable. Ownership transfer is audited;
the last owner cannot leave or be removed.

## Attachments and Sensitive Data

Attachment objects use private S3-compatible storage and short-lived signed
URLs. Deployments encrypt traffic in transit and enable encryption at rest for
the database, object storage, backups, and managed secrets. Bucket credentials,
database credentials, OIDC client secrets, and mail credentials are held in a
secret manager or deployment secret store, never source control or browser code.

The API validates declared type, detected type, size, ownership, and object
metadata before linking an upload. Logs redact authorization headers, signed
URLs, passwords, and secrets. Deployment operators configure malware scanning
before enabling document formats beyond the MVP image and PDF allow-list.

## Historical Records and Retention

Domain records and confirmed attachment objects are never hard-deleted in the
MVP. Assets can be retired, disposed, or soft-deleted into restorable trash;
jobs can be amended or voided with a reason. These states have distinct meaning
and must remain visible in history and audit trails.

Every deployment documents its backup retention period and recovery owner.
Routine backups include PostgreSQL and attachment objects. Restore tests happen
before production launch and at least quarterly thereafter; they verify a
point-in-time database restore, object availability, tenant isolation, and
application health without touching production data.

## Audit and Incident Response

Record security-relevant events: sign-in subject linkage, invitation create,
revoke, accept, membership changes, ownership transfer, attachment confirmation,
job voids, and administrative configuration changes. Audit records include the
workspace, actor, time, action, target, and safe outcome metadata.

Operators alert on authentication validation failures, authorization anomalies,
backup failures, object-upload errors, repeated sync conflicts, migration
failures, and unhealthy services. An incident response runbook identifies how
to rotate secrets, revoke access, preserve audit evidence, restore service, and
notify affected users when required.
