# Editorial Prose Review: Wrenchbase PRD and Addendum

This two-file artifact exists to help product decision-makers and downstream UX,
architecture, and delivery readers understand and apply Wrenchbase's product
intent, scope, requirements, and retained technical context.

**Reader type:** Humans

**Style guide:** Microsoft Writing Style Guide
**Current exact word metrics:** `prd.md` 7,294 words; `addendum.md` 1,261
words; combined artifact 8,555 words.

The prose intentionally uses a neutral, precise requirements voice; stable
capitalized domain terms; direct modal verbs; compact user journeys; repeated
“Consequences (testable)” blocks; and code formatting for exact contract
tokens. Preserve those choices. The prior structure review has no CUT findings;
its MOVE and MERGE recommendations are treated as future locations, not
reconsidered here.

## Findings

| Pass | Original Text | Revised Text | Changes |
|---|---|---|---|
| prose | `prd.md` §1 Vision — “It helps an owner or small trusted team turn a manual or practical experience into a maintenance schedule, record the work actually performed, and see what needs attention next.” | “It helps an owner or small trusted team turn guidance from a manual or practical experience into a maintenance schedule, record the work performed, and see what needs attention next.” | Clarifies that the manual or experience supplies guidance; removes an unnecessary intensifier. |
| prose | `prd.md` FR-3 — “An invitation accepts an optional personal message; the submitted email form is retained for display and delivery even though matching uses its normalized value.” | “An invitation can include an optional personal message. The submitted email address is retained for display and delivery, while matching uses its normalized value.” | Replaces an inanimate action with direct wording; clarifies that the retained “form” means the submitted address. |
| prose | `prd.md` Glossary, FR-12, FR-14, FR-16, FR-23, FR-33, §6, and scenario 7 — “labelled ad-hoc position,” “ad-hoc typed Component,” “ad-hoc label,” “Ad-hoc work,” and “ad-hoc history” | “labeled ad hoc position,” “ad hoc typed Component,” “ad hoc label,” “Ad hoc work,” and “ad hoc history” | Standardizes US spelling and the open compound “ad hoc” under Microsoft style. Keep exact code or external contract literals unchanged if any exist outside these prose passages. |
| prose | `prd.md` Glossary, FR-6, FR-8, FR-25 heading and consequences, NFR-4, and NFR-6 — “IANA timezone,” “timezones,” and “their own timezone” | “IANA time zone,” “time zones,” and “their own time zone” | Standardizes Microsoft terminology. Preserve an exact `timezone` field name wherever it is shown as code; none of these passages presents one as a code token. |
| prose | `prd.md` FR-6 — “A Site has a name, IANA timezone, structured postal address, lifecycle status, immutable creation time, and revision.” | “A Site has a name, an IANA time zone, a structured postal address, a lifecycle status, an immutable creation time, and a revision.” | Restores parallel articles in a long attribute list and applies the time-zone terminology fix. |
| prose | `prd.md` FR-9 — “An archived Asset Type must be restored before revision or publication and cannot be archived while a current published parent revision depends on it for automatic required-Component creation.” | “An archived Asset Type must be restored before it can be revised or published. It cannot be archived while a current published parent revision depends on it for automatic required-Component creation.” | Removes an ambiguous nominal phrase and separates two independent lifecycle constraints. |
| prose | `prd.md` FR-11 — “Meter Readings can be recorded independently or during completed work, retain correction history, and never double-count usage.” | “Meter Readings can be recorded independently or during completed work. They retain correction history and never double-count usage.” | Fixes faulty coordination: the original makes one “can” govern unlike predicates. |
| prose | `prd.md` FR-30 — “A weekly digest of unresolved work is enabled by default, configurable, and disableable.” / “The first Workspace owner begins subscribed to maintenance email and may unsubscribe.” / “Invitation delivery is transactional and retryable; mail-provider availability does not decide whether invitation creation commits.” | “A weekly digest of unresolved work is enabled by default; Members can configure or disable it.” / “The first Workspace owner is subscribed to maintenance email by default and can unsubscribe.” / “Invitation delivery is transactional and retryable; invitation creation commits independently of mail-provider availability.” | Replaces an awkward adjective, states the default directly, and removes personification from the delivery guarantee. |
| prose | `prd.md` FR-32 — “Large attachments download only on request.” | “The app downloads large attachments only on request.” | Names the actor; the original can read as though attachments download themselves. |
| prose | `prd.md` FR-33 — “The app attempts synchronization on reconnect, open or foreground, and online saves, and exposes manual **Sync now** and **Retry** controls.” | “The app attempts synchronization when connectivity returns, when it opens or enters the foreground, and after online saves. It also provides manual **Sync now** and **Retry** controls.” | Makes the trigger list grammatically parallel and separates automatic triggers from manual controls. |
| prose | `prd.md` FR-37 — “Corrections are appended through explicit actions rather than silent rewrite.” | “Corrections are appended through explicit actions rather than by silently rewriting history.” | Fixes the missing article/number problem and states what must not be rewritten. |
| prose | `prd.md` FR-38 — “Backup and restore procedures are documented, and a restore into the target environment is successfully exercised before release.” | “Backup and restore procedures are documented, and data is successfully restored into the target environment before release.” | Replaces the abstract “a restore ... is exercised” construction with the concrete completion outcome. |
| prose | `prd.md` NFR-3 — “bearer tokens and invitation secrets are not stored in plaintext application persistence” | “bearer tokens and invitation secrets are not stored as plaintext in application persistence” | Clarifies the relationship between “plaintext” and persistence. |
| prose | `prd.md` OQ-7 — “The sources define product-correctness acceptance but no target for how efficiently a user can translate real guidance into a Maintenance Schedule or understand the next action without excessive setup.” | “The sources define product-correctness acceptance criteria but no target for how efficiently a user can translate real guidance into a Maintenance Schedule or identify the next action without excessive setup.” | Supplies the missing noun after “acceptance” and makes the two user outcomes parallel. |
| prose | `addendum.md` opening — “This addendum preserves settled contract, delivery, and implementation context from the reconciled inputs that is too technical for the canonical PRD.” | “This addendum preserves settled contract, delivery, and implementation context from the reconciled inputs. That context is too technical for the canonical PRD.” | Removes an attachment ambiguity: “that” can appear to modify “inputs” instead of “context.” |
| prose | `addendum.md` §2 Persistence and tenancy and §3 Relational and tenancy enforcement — “use row-level security as defense in depth” / “applies ... as defense in depth” | At the surviving shared tenancy location from the structure MERGE: “Use row-level security as a defense-in-depth measure, not as the primary authorization system.” | Applies the prose fix at the structure review's surviving merged location; adds the missing article and removes duplicate phrasing without changing the security boundary. |
| prose | `addendum.md` §4 Delivery Sequencing — “Every delivery slice changes the API contract, browser behavior, tests, and audit behavior together where affected.” | “Each delivery slice updates the API contract, browser behavior, tests, and audit behavior together when the slice affects them.” | Clarifies what “where affected” modifies and keeps the coordinated-change rule intact. |

## Summary

- **Recommendations:** 17 prose edits.
- **Stable identifiers:** no proposed edit changes an `FR-*`, `NFR-*`, `UJ-*`,
  `SM-*`, `OQ-*`, or `A-*` identifier.
- **Structure dependency:** no text was skipped for CUT; the shared tenancy edit
  is attached to the surviving location from the prior MERGE finding, and no
  MOVE or CONDENSE recommendation is re-litigated.
- **Estimated word impact:** approximately neutral and under 15 words in either
  direction, less than 0.2% of the exact 8,555-word current artifact.
- **Comprehension effect:** the edits standardize Microsoft terminology, repair
  parallelism and unclear agency, and clarify a few dense contract statements
  without changing product or implementation meaning.
