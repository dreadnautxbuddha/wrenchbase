---
status: final
approval: approved
approved: 2026-09-22
updated: 2026-09-22
---

# Source Reconciliation Summary

Every supplied source is retained as guidance, reconciliation evidence, or a
focused authority within its documented boundary. This index maps every source
heading to its canonical destination and links to the per-source evidence.
Multiple destinations mean the heading has deliberately split ownership. No
source is deleted or demoted by this migration.

## Source verdicts and proposed disposition

| Source                        | Proposed disposition                                                                   | Evidence                                                                             |
| ----------------------------- | -------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------ |
| `Canonical PRD`               | Retain as canonical product authority.                                                 | [reconcile-prd.md](reconcile-prd.md)                                                 |
| `PRD addendum`                | Retain as focused contract and delivery companion.                                     | [reconcile-prd-addendum.md](reconcile-prd-addendum.md)                               |
| `UX and accessibility brief`  | Retain as guidance and migration evidence.                                             | [reconcile-ux-accessibility.md](reconcile-ux-accessibility.md)                       |
| `MVP 0 UI/UX plan`            | Retain as guidance and migration evidence.                                             | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md)                       |
| `MVP 0 visual design`         | Retain as guidance and migration evidence.                                             | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md)                 |
| `Architecture`                | Retain as focused architecture authority.                                              | [reconcile-architecture.md](reconcile-architecture.md)                               |
| `API contract`                | Retain as focused API authority.                                                       | [reconcile-api-contract.md](reconcile-api-contract.md)                               |
| `Offline synchronization`     | Retain as focused synchronization authority.                                           | [reconcile-offline-sync.md](reconcile-offline-sync.md)                               |
| `Security and data lifecycle` | Retain as focused security and lifecycle authority.                                    | [reconcile-security-and-data-lifecycle.md](reconcile-security-and-data-lifecycle.md) |
| `MVP 0 delivery runbook`      | Retain as focused implementation-sequencing authority.                                 | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md)           |
| `README`                      | Retain as repository entry point.                                                      | [reconcile-readme.md](reconcile-readme.md)                                           |

## Heading-complete mapping


### Canonical PRD

Source: `../../prds/prd-wrenchbase-2026-09-21/prd.md`
Verdict: Retain as canonical product authority.
Mapped headings: 81

| Source heading                                                  | Canonical destination                                                                                           | Evidence                             |
| --------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------- | ------------------------------------ |
| `# PRD: Wrenchbase`                                             | intentionally retained focused document                                                                         | [reconcile-prd.md](reconcile-prd.md) |
| `## 0. Document Purpose and Authority`                          | intentionally retained focused document                                                                         | [reconcile-prd.md](reconcile-prd.md) |
| `### 0.1 Approval Scope`                                        | intentionally retained focused document; deferred later-milestone concern; unresolved conflict                  | [reconcile-prd.md](reconcile-prd.md) |
| `## 1. Vision`                                                  | `DESIGN.md`; `EXPERIENCE.md`                                                                                    | [reconcile-prd.md](reconcile-prd.md) |
| `### 1.1 Product Principles`                                    | `DESIGN.md`; `EXPERIENCE.md`                                                                                    | [reconcile-prd.md](reconcile-prd.md) |
| `## 2. Target Users and Jobs To Be Done`                        | `EXPERIENCE.md`                                                                                                 | [reconcile-prd.md](reconcile-prd.md) |
| `### 2.1 Target Users`                                          | `DESIGN.md`; `EXPERIENCE.md`                                                                                    | [reconcile-prd.md](reconcile-prd.md) |
| `### 2.2 Jobs To Be Done`                                       | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `### 2.3 Key User Journeys`                                     | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `## 3. Glossary`                                                | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `## 4. Functional Requirements`                                 | intentionally retained focused document                                                                         | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.1 Identity, Workspaces, and Membership`                  | `EXPERIENCE.md`                                                                                                 | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-1: External identity and sign-in`                      | `EXPERIENCE.md`                                                                                                 | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-2: Workspace creation, editing, and switching`         | `EXPERIENCE.md`; unresolved conflict                                                                            | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-3: Membership invitations and tenure`                  | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-4: Capability authorization and tenant isolation`      | `EXPERIENCE.md`                                                                                                 | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-5: Workspace settings and preferences`                 | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.2 Sites, Locations, and Placement`                       | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-6: Site management`                                    | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-7: Nested Location management`                         | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-8: Singular active placement and history`              | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.3 Asset Types, Assets, and Components`                   | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-9: Versioned Asset Types`                              | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-10: Typed attributes and configured values`            | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-11: Meter definitions and Meter Readings`              | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-12: Component Roles and recursive Asset creation`      | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-13: Concrete Asset creation`                           | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-14: Movement, Installation, and detachment`            | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-15: Asset lifecycle and retained subtrees`             | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-16: Asset Type adoption and Reconciliation`            | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.4 Maintenance Schedules, Baselines, and Due Work`        | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-17: Versioned Maintenance Schedules`                   | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-18: Typed Requirements and Triggers`                   | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-19: Honest Baselines and unknown history`              | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-20: Due Work calculation and presentation`             | `DESIGN.md`; `EXPERIENCE.md`; deferred later-milestone concern                                                  | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.5 Jobs, Work Items, and Maintenance Needs`               | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-21: Job lifecycle and assignment`                      | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-22: Requirement fulfillment and partial completion`    | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-23: Ad hoc work`                                       | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-24: Traceable Job correction`                          | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-25: Job place, time zone, and participants`            | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-26: Costs and Evidence`                                | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-27: Maintenance Needs`                                 | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-28: Atomic Component replacement`                      | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.6 Awareness, Reports, and Offline Resilience`            | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-29: Notification center and due-work dashboard`        | `DESIGN.md`; `EXPERIENCE.md`; deferred later-milestone concern                                                  | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-30: Email preferences and delivery`                    | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-31: Workspace-only reports`                            | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-32: Offline reading and Job drafting`                  | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-33: Synchronization, publication, and conflict review` | `DESIGN.md`; `EXPERIENCE.md`; deferred later-milestone concern                                                  | [reconcile-prd.md](reconcile-prd.md) |
| `### 4.7 Shared Contracts and Operability`                      | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-34: Optimistic concurrency and input preservation`     | `EXPERIENCE.md`; unresolved conflict                                                                            | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-35: Retry-safe commands`                               | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-36: Versioned client-neutral API`                      | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                      | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-37: Auditability and historical provenance`            | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### FR-38: Production readiness`                              | intentionally retained focused document; deferred later-milestone concern; unresolved conflict                  | [reconcile-prd.md](reconcile-prd.md) |
| `## 5. Cross-Cutting Non-Functional Requirements`               | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document                                           | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-1: Accessibility`                                     | `DESIGN.md`; `EXPERIENCE.md`                                                                                    | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-2: Mobile-first interaction`                          | `EXPERIENCE.md`                                                                                                 | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-3: Security and privacy`                              | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-4: Historical integrity`                              | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-5: Reliability and recoverability`                    | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-6: Time and measurement correctness`                  | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `#### NFR-7: Extensibility without premature breadth`           | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `## 6. MVP Scope and Delivery Milestones`                       | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict                                   | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 0: Delivery and Contract Foundation`                   | `EXPERIENCE.md`; unresolved conflict                                                                            | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 1: Workspace and Asset Foundation`                     | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 2: Schedules and Due Work`                             | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 3: Work Execution`                                     | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 4: Awareness and Reporting`                            | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict                                          | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 5: Offline Resilience`                                 | `DESIGN.md`; `EXPERIENCE.md`; deferred later-milestone concern                                                  | [reconcile-prd.md](reconcile-prd.md) |
| `### MVP 6: Production Readiness`                               | intentionally retained focused document; deferred later-milestone concern; unresolved conflict                  | [reconcile-prd.md](reconcile-prd.md) |
| `## 7. Non-Goals for the MVP`                                   | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document                                           | [reconcile-prd.md](reconcile-prd.md) |
| `## 8. Success Metrics`                                         | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict                                   | [reconcile-prd.md](reconcile-prd.md) |
| `### Primary`                                                   | `EXPERIENCE.md`; intentionally retained focused document                                                        | [reconcile-prd.md](reconcile-prd.md) |
| `### Secondary`                                                 | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document                                           | [reconcile-prd.md](reconcile-prd.md) |
| `### Counter-metrics`                                           | `DESIGN.md`; `EXPERIENCE.md`                                                                                    | [reconcile-prd.md](reconcile-prd.md) |
| `### 8.1 Canonical Acceptance Scenarios`                        | `EXPERIENCE.md`; deferred later-milestone concern                                                               | [reconcile-prd.md](reconcile-prd.md) |
| `## 9. Risks and Guardrails`                                    | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document                                           | [reconcile-prd.md](reconcile-prd.md) |
| `## 10. Open Questions and Deferred Decisions`                  | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern; unresolved conflict | [reconcile-prd.md](reconcile-prd.md) |
| `## 11. Assumptions Index`                                      | intentionally retained focused document                                                                         | [reconcile-prd.md](reconcile-prd.md) |

### PRD addendum

Source: `../../prds/prd-wrenchbase-2026-09-21/addendum.md`
Verdict: Retain as focused contract and delivery companion.
Mapped headings: 18

| Source heading                                       | Canonical destination                                                                      | Evidence                                               |
| ---------------------------------------------------- | ------------------------------------------------------------------------------------------ | ------------------------------------------------------ |
| `# Wrenchbase PRD Addendum`                          | intentionally retained focused document                                                    | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `## 1. Existing Application Boundaries`              | `EXPERIENCE.md`; intentionally retained focused document                                   | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `## 2. MVP 0 Contract and Delivery Context`          | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict              | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Authentication and identity`                    | `EXPERIENCE.md`; intentionally retained focused document                                   | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### API conventions`                                | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict              | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Persistence and tenancy`                        | `EXPERIENCE.md`; intentionally retained focused document                                   | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Browser and verification`                       | `EXPERIENCE.md`; intentionally retained focused document                                   | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `## 3. MVP 1 Contract and Delivery Context`          | intentionally retained focused document; deferred later-milestone concern                  | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Capability strings`                             | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Invitation delivery`                            | intentionally retained focused document; deferred later-milestone concern                  | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Relational and tenancy enforcement`             | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Purpose-specific commands`                      | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### Browser and acceptance context`                 | `DESIGN.md`; `EXPERIENCE.md`; deferred later-milestone concern                             | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `## 4. Delivery Sequencing Retained from the Inputs` | intentionally retained focused document                                                    | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### MVP 0 sequence`                                 | intentionally retained focused document                                                    | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `### MVP 1 sequence`                                 | intentionally retained focused document; deferred later-milestone concern                  | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `## 5. Engineering Verification Context`             | intentionally retained focused document                                                    | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |
| `## 6. Detailed Extraction Records`                  | intentionally retained focused document                                                    | [reconcile-prd-addendum.md](reconcile-prd-addendum.md) |

### UX and accessibility brief

Source: `../../../../docs/ux-accessibility.md`
Verdict: Retained as guidance and migration evidence; reconsider only at a separately approved deletion checkpoint.
Mapped headings: 4

| Source heading                        | Canonical destination                                                                                           | Evidence                                                       |
| ------------------------------------- | --------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------- |
| `# UX and Accessibility Brief`        | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document                                           | [reconcile-ux-accessibility.md](reconcile-ux-accessibility.md) |
| `## Navigation and Workspace Context` | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern; unresolved conflict | [reconcile-ux-accessibility.md](reconcile-ux-accessibility.md) |
| `## Jobs and On-Site Work`            | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern; unresolved conflict | [reconcile-ux-accessibility.md](reconcile-ux-accessibility.md) |
| `## Accessible Interaction`           | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document                                           | [reconcile-ux-accessibility.md](reconcile-ux-accessibility.md) |

### MVP 0 UI/UX plan

Source: `../../../../docs/mvp-0-ui-ux-plan.md`
Verdict: Retained as guidance and migration evidence; reconsider only at a separately approved deletion checkpoint.
Mapped headings: 21

| Source heading                           | Canonical destination                                                               | Evidence                                                       |
| ---------------------------------------- | ----------------------------------------------------------------------------------- | -------------------------------------------------------------- |
| `# MVP 0 UI/UX Plan`                     | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document               | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Design objective`                    | `EXPERIENCE.md`                                                                     | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Planning and review process`         | intentionally retained focused document                                             | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Scope`                               | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict              | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Route map`                           | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict       | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Application shells`                  | `DESIGN.md`; `EXPERIENCE.md`                                                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `### Public shell`                       | `DESIGN.md`; `EXPERIENCE.md`                                                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `### Authenticated shell`                | `DESIGN.md`; `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Sign-in and callback`                | `DESIGN.md`; `EXPERIENCE.md`                                                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## No-membership onboarding`            | `EXPERIENCE.md`; deferred later-milestone concern; unresolved conflict              | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Workspace creation`                  | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                                   | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Workspace overview`                  | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                                   | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Workspace settings`                  | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                                   | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Stale-edit recovery`                 | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                                   | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Workspace switcher and account menu` | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                                   | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Page and operation states`           | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                                   | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Responsive behavior`                 | `DESIGN.md`; `EXPERIENCE.md`                                                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Accessibility behavior`              | `DESIGN.md`; `EXPERIENCE.md`                                                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Content and visual direction`        | `DESIGN.md`; `EXPERIENCE.md`                                                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## Wireframe review set`                | intentionally retained focused document; unresolved conflict                        | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |
| `## UX acceptance checklist`             | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document               | [reconcile-mvp-0-ui-ux-plan.md](reconcile-mvp-0-ui-ux-plan.md) |

### MVP 0 visual design

Source: `../../../../docs/mvp-0-visual-design.md`
Verdict: Retained as guidance and migration evidence; reconsider only at a separately approved deletion checkpoint.
Mapped headings: 29

| Source heading                        | Canonical destination                                | Evidence                                                             |
| ------------------------------------- | ---------------------------------------------------- | -------------------------------------------------------------------- |
| `# MVP 0 Visual Design`               | `DESIGN.md`; intentionally retained focused document | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Status`                           | `DESIGN.md`; intentionally retained focused document | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Intent`                           | `DESIGN.md`; deferred later-milestone concern        | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Design principles`                | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### One obvious next action`         | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Friendly, never patronizing`     | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Large where interaction happens` | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Shape supports meaning`          | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Calm canvas, colorful feedback`  | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Color system`                     | `DESIGN.md`; unresolved conflict                     | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Light appearance`                | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Dark appearance`                 | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Semantic colors`                 | `DESIGN.md`; unresolved conflict                     | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Playful accents`                 | `DESIGN.md`; deferred later-milestone concern        | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Typography`                       | `DESIGN.md`; intentionally retained focused document | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Spacing and density`              | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Shape and elevation`              | `DESIGN.md`; unresolved conflict                     | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Icons and illustration`           | `DESIGN.md`; deferred later-milestone concern        | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Motion and feedback`              | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Components`                       | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Buttons`                         | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Fields`                          | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Surfaces`                        | `DESIGN.md`                                          | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Menus`                           | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `### Alerts and conflicts`            | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Tailwind implementation`          | `DESIGN.md`; intentionally retained focused document | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Accessibility standard`           | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Non-goals`                        | `DESIGN.md`; `EXPERIENCE.md`                         | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |
| `## Acceptance criteria`              | `DESIGN.md`; intentionally retained focused document | [reconcile-mvp-0-visual-design.md](reconcile-mvp-0-visual-design.md) |

### Architecture

Source: `../../../../docs/architecture.md`
Verdict: Retain as focused architecture authority.
Mapped headings: 11

| Source heading                           | Canonical destination                                                                                                        | Evidence                                               |
| ---------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------ |
| `# Architecture`                         | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Repository Layout`                   | intentionally retained focused document; deferred later-milestone concern                                                    | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Application Boundaries`              | `EXPERIENCE.md`; intentionally retained focused document                                                                     | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Identity and Tenancy`                | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Backend Architecture`                | intentionally retained focused document                                                                                      | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Frontend Architecture`               | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Domain Storage`                      | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Configurable Asset Types and Values` | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Schedules, Usage, and Time`          | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Jobs, Reports, and Notifications`    | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern                                   | [reconcile-architecture.md](reconcile-architecture.md) |
| `## Frontend State and Offline Scope`    | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern; unresolved conflict | [reconcile-architecture.md](reconcile-architecture.md) |

### API contract

Source: `../../../../docs/api-contract.md`
Verdict: Retain as focused API authority.
Mapped headings: 6

| Source heading                            | Canonical destination                                                                          | Evidence                                               |
| ----------------------------------------- | ---------------------------------------------------------------------------------------------- | ------------------------------------------------------ |
| `# API Contract`                          | intentionally retained focused document                                                        | [reconcile-api-contract.md](reconcile-api-contract.md) |
| `## Versioning and Authentication`        | `EXPERIENCE.md`; intentionally retained focused document                                       | [reconcile-api-contract.md](reconcile-api-contract.md) |
| `## Requests and Responses`               | `EXPERIENCE.md`; intentionally retained focused document                                       | [reconcile-api-contract.md](reconcile-api-contract.md) |
| `## Errors, Concurrency, and Idempotency` | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict                  | [reconcile-api-contract.md](reconcile-api-contract.md) |
| `## Attachments`                          | intentionally retained focused document; deferred later-milestone concern; unresolved conflict | [reconcile-api-contract.md](reconcile-api-contract.md) |
| `## Required Capability Documentation`    | `EXPERIENCE.md`; intentionally retained focused document                                       | [reconcile-api-contract.md](reconcile-api-contract.md) |

### Offline synchronization

Source: `../../../../docs/offline-sync.md`
Verdict: Retain as focused synchronization authority.
Mapped headings: 5

| Source heading                       | Canonical destination                                                                      | Evidence                                               |
| ------------------------------------ | ------------------------------------------------------------------------------------------ | ------------------------------------------------------ |
| `# Offline Synchronization Contract` | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict              | [reconcile-offline-sync.md](reconcile-offline-sync.md) |
| `## Local Outbox`                    | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern | [reconcile-offline-sync.md](reconcile-offline-sync.md) |
| `## Upload and Publish Sequence`     | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern | [reconcile-offline-sync.md](reconcile-offline-sync.md) |
| `## Failure and Review`              | `EXPERIENCE.md`; deferred later-milestone concern                                          | [reconcile-offline-sync.md](reconcile-offline-sync.md) |
| `## Test Scenarios`                  | intentionally retained focused document                                                    | [reconcile-offline-sync.md](reconcile-offline-sync.md) |

### Security and data lifecycle

Source: `../../../../docs/security-and-data-lifecycle.md`
Verdict: Retain as focused security and lifecycle authority.
Mapped headings: 5

| Source heading                        | Canonical destination                                                                          | Evidence                                                                             |
| ------------------------------------- | ---------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------ |
| `# Security and Data Lifecycle`       | `EXPERIENCE.md`; intentionally retained focused document                                       | [reconcile-security-and-data-lifecycle.md](reconcile-security-and-data-lifecycle.md) |
| `## Identity and Tenant Isolation`    | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern     | [reconcile-security-and-data-lifecycle.md](reconcile-security-and-data-lifecycle.md) |
| `## Attachments and Sensitive Data`   | intentionally retained focused document; deferred later-milestone concern; unresolved conflict | [reconcile-security-and-data-lifecycle.md](reconcile-security-and-data-lifecycle.md) |
| `## Historical Records and Retention` | `EXPERIENCE.md`; intentionally retained focused document; deferred later-milestone concern     | [reconcile-security-and-data-lifecycle.md](reconcile-security-and-data-lifecycle.md) |
| `## Audit and Incident Response`      | `EXPERIENCE.md`; intentionally retained focused document                                       | [reconcile-security-and-data-lifecycle.md](reconcile-security-and-data-lifecycle.md) |

### MVP 0 delivery runbook

Source: `../../../../docs/mvp-0-delivery-runbook.md`
Verdict: Retain as focused implementation-sequencing authority.
Mapped headings: 57

| Source heading                                                  | Canonical destination                                                         | Evidence                                                                   |
| --------------------------------------------------------------- | ----------------------------------------------------------------------------- | -------------------------------------------------------------------------- |
| `# MVP 0 Delivery Runbook`                                      | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Authority and package rules`                                | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Review gate`                                                | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 1: Web test foundation and continuous integration`  | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 1 > ### Scope`                                         | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 1 > ### Acceptance`                                    | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 1 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 2: Visual and accessibility foundation`             | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document         | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 2 > ### Scope`                                         | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document         | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 2 > ### Acceptance`                                    | `DESIGN.md`; `EXPERIENCE.md`                                                  | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 2 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 3: Local OpenID Connect environment`                | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 3 > ### Scope`                                         | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 3 > ### Acceptance`                                    | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 3 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 4: API authentication and user profile`             | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 4 > ### Scope`                                         | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 4 > ### Acceptance`                                    | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 4 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 5: Engineering standards hardening`                 | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 5 > ### Source documents`                              | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 5 > ### Scope`                                         | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 5 > ### Acceptance`                                    | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 5 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 6: Workspace read and creation API`                 | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 6 > ### Scope`                                         | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 6 > ### Acceptance`                                    | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 6 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 7: Browser authentication and onboarding`           | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document         | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 7 > ### Scope`                                         | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 7 > ### Acceptance`                                    | `EXPERIENCE.md`                                                               | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 7 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 8: Workspace creation, overview, and switching`     | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document         | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 8 > ### Scope`                                         | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 8 > ### Acceptance`                                    | `EXPERIENCE.md`                                                               | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 8 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 9: Workspace update and concurrency API`            | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 9 > ### Scope`                                         | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 9 > ### Acceptance`                                    | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 9 > ### Verify`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 10: Workspace settings and stale-edit recovery`     | `DESIGN.md`; `EXPERIENCE.md`; unresolved conflict                             | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 10 > ### Scope`                                        | `EXPERIENCE.md`                                                               | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 10 > ### Acceptance`                                   | `DESIGN.md`; `EXPERIENCE.md`                                                  | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 10 > ### Verify`                                       | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 11: Browser localization hardening`                 | `EXPERIENCE.md`; intentionally retained focused document; unresolved conflict | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 11 > ### Scope`                                        | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 11 > ### Acceptance`                                   | `EXPERIENCE.md`                                                               | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 11 > ### Verify`                                       | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 12: Readable source and file-size hardening`        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 12 > ### Scope`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 12 > ### Acceptance`                                   | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 12 > ### Verify`                                       | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Package 13: Real-stack golden path and milestone hardening` | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document         | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 13 > ### Scope`                                        | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 13 > ### Acceptance`                                   | `EXPERIENCE.md`; intentionally retained focused document                      | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `Package 13 > ### Verify`                                       | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |
| `## Handoff prompt`                                             | intentionally retained focused document                                       | [reconcile-mvp-0-delivery-runbook.md](reconcile-mvp-0-delivery-runbook.md) |

### README

Source: `../../../../README.md`
Verdict: Retain as repository entry point.
Mapped headings: 8

| Source heading         | Canonical destination                                                     | Evidence                                   |
| ---------------------- | ------------------------------------------------------------------------- | ------------------------------------------ |
| `# Wrenchbase`         | `DESIGN.md`; `EXPERIENCE.md`; intentionally retained focused document     | [reconcile-readme.md](reconcile-readme.md) |
| `## What It Tracks`    | intentionally retained focused document; deferred later-milestone concern | [reconcile-readme.md](reconcile-readme.md) |
| `## Product Direction` | `DESIGN.md`; `EXPERIENCE.md`                                              | [reconcile-readme.md](reconcile-readme.md) |
| `## Stack`             | intentionally retained focused document                                   | [reconcile-readme.md](reconcile-readme.md) |
| `## Repository Layout` | intentionally retained focused document; deferred later-milestone concern | [reconcile-readme.md](reconcile-readme.md) |
| `## Development`       | intentionally retained focused document                                   | [reconcile-readme.md](reconcile-readme.md) |
| `## Documentation`     | intentionally retained focused document                                   | [reconcile-readme.md](reconcile-readme.md) |
| `## Project Status`    | intentionally retained focused document                                   | [reconcile-readme.md](reconcile-readme.md) |

## Reconciliation-wide verdict

The final spines preserve the approved friendly, sky-blue visual direction and
mobile-first browser behavior without adding product scope, information
architecture, engagement mechanics, or a new component system. All supplied
sources remain retained as guidance, reconciliation evidence, or focused
authorities. Any future retirement requires a separately approved,
heading-complete deletion checkpoint.

Unresolved conflicts are UX-OQ-1 through UX-OQ-9 in `.memlog.md` and `EXPERIENCE.md`; PRD OQ-1 through OQ-7 remain at their existing phase gates. No qualitative source detail is intentionally dropped. Technical facts that do not belong in the UX spines remain in retained focused documents.
