---
source: ../../../../README.md
status: final
updated: 2026-09-22
---

# Reconciliation: README

## Migration verdict

The README remains the repository entry point. Its product positioning and
current-platform facts inform the spines, while stack, repository, commands,
documentation routing, and status remain in the README. It is not a candidate
for retirement.

## Heading-complete mapping

| Source heading         | Classification                                                             | Migration or retention                                                                                                                                                                        |
| ---------------------- | -------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `# Wrenchbase`         | `DESIGN.md`; `EXPERIENCE.md`; retained focused document                    | Preserve the concise mobile-first maintenance-tracker identity and support for recursively nested Assets without duplicating product scope.                                                   |
| `## What It Tracks`    | Retained canonical-PRD reference; deferred applications                    | Use as a completeness check for later Assets, Components, Maintenance Schedules, Due Work, Jobs, Evidence, costs, notifications, and offline drafting; do not infer current screens.          |
| `## Product Direction` | `DESIGN.md`; `EXPERIENCE.md`                                               | Preserve the middle ground between narrow vehicle tools and enterprise systems, and credibility for individuals through small teams.                                                          |
| `## Stack`             | Retained focused document                                                  | Keep PHP/Symfony, Next.js/React/TypeScript, PostgreSQL, Docker Compose, and object-storage facts in README/architecture; only current responsive-browser platform behavior enters EXPERIENCE. |
| `## Repository Layout` | Retained focused document; deferred React Native                           | Preserve browser-primary and future-mobile boundaries; do not create `mobile/` or native UI.                                                                                                  |
| `## Development`       | Retained focused document                                                  | Commands and container workflow do not migrate to UX spines.                                                                                                                                  |
| `## Documentation`     | Retained focused document; later authority-link update only after approval | Keep current inbound links until the canonical UX artifacts are approved and any source retirement is separately authorized.                                                                  |
| `## Project Status`    | Retained focused document                                                  | Early-development status is context, not a visual or interaction requirement.                                                                                                                 |

## Dropped-detail audit

No qualitative positioning is dropped. Technical and contributor detail stays
in the retained README. No README link changes occur at this checkpoint.
