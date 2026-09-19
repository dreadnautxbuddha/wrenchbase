# Deployment Guide

Wrenchbase supports a portable container deployment first. AWS ECS/Fargate is
the reference managed deployment for the initial hosted service; it is an
example, not a runtime dependency.

## Portable Baseline

Production uses the repository's Docker Compose production configuration with a
Symfony API container, Next.js web container, PostgreSQL 16, an S3-compatible
private object store, a configured OpenID Connect issuer, and an outbound email
provider. Operators terminate TLS, provide persistent database and object-store
volumes, and set secrets through their deployment secret store.

Required configuration covers database connectivity, trusted web and API URLs,
OIDC issuer/audience/client settings, object-store endpoint/bucket/region,
outbound email, signing-key rotation, and observability endpoints. Configuration
values and secret names must be documented alongside their consuming service;
secrets must never appear in committed Compose files or logs.

## AWS Reference

Run API and web containers as separate ECS Fargate services behind an
Application Load Balancer. Use RDS PostgreSQL for relational data, a private S3
bucket for attachments, Secrets Manager for runtime secrets, and SES or another
SMTP-compatible provider for email. Send application logs and service metrics to
CloudWatch or an equivalent observability system. The configured OIDC issuer may
be Amazon Cognito or another standards-compliant provider.

Place database and services in private network segments. Permit public traffic
only through TLS termination, and grant each task role the narrow permissions it
needs. Attachment access is mediated by API-issued signed URLs, not public S3
objects.

## Continuous Integration and Versioning

Every pull request runs `make check` in a clean containerized environment.
Protected release commits also build the API and web images, perform a migration
and health-check smoke test against isolated services, and retain test logs and
image digests. A release tag uses Semantic Versioning while the product remains
pre-1.0; a breaking client contract is introduced under a new `/api/vN` path,
not by changing an existing version in place.

## Release Procedure

1. Build immutable API and web images from a reviewed commit.
2. Run `make check`; publish artifacts only when all checks pass.
3. Take or verify a current database and attachment backup.
4. Apply Doctrine migrations as a single controlled release step before code
   requiring the new schema receives traffic.
5. Deploy API and web services, then verify `/health`, authentication, a
   workspace-scoped read, attachment authorization, and log/metric delivery.
6. Monitor error rate, latency, queue or sync failures, and database health;
   roll back application images when needed. Do not roll back a migration unless
   its migration-specific recovery procedure says it is safe.

## Recovery and Operations

Document the recovery point and recovery time objectives for each environment.
Test database and object-store restores before launch and quarterly afterwards.
The test restore uses isolated infrastructure, validates a representative
workspace and attachment, and records the elapsed recovery time.

Alerts cover unavailable API or web services, failed migrations or backups,
database capacity, object-store failures, email delivery failures, and sustained
authentication or synchronization errors. Rotate compromised secrets, restart
only affected services where possible, and preserve audit and deployment logs
for incident investigation.
