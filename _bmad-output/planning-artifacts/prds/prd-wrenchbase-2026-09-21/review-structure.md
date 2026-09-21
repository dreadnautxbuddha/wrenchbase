# Editorial Structure Review: Wrenchbase PRD and Addendum

This two-file artifact exists to help product decision-makers and downstream UX,
architecture, and delivery readers understand Wrenchbase's product intent,
scope, success conditions, requirements, and retained technical context well
enough to approve the PRD and plan from it.

**Structure model:** Strategic/Context (Pyramid)

**Reader type:** Humans

**Style guide:** Microsoft Writing Style Guide
**Exact word metrics:** `prd.md` 6,927 words; `addendum.md` 1,261 words;
combined artifact 8,188 words.

## Findings

| Pass | Original Text | Revised Text | Changes |
|---|---|---|---|
| structure | `prd.md` current order: §0 Purpose → §1 Vision → §2 Users/JTBD/Journeys → §3 Glossary → §4–5 Requirements → §6 Scope → §7 Non-Goals → §8 Success → §9 Risks | **MOVE** the strategic sections ahead of detailed journeys and requirements: §0 Purpose → §1 Vision/Principles → §2.1 Target Users → §2.2 Jobs To Be Done → §6 MVP Scope → §7 Non-Goals → §8 Success Metrics → §9 Risks → §2.3 Journeys → §3 Glossary → §4–5 Requirements. Renumber headings after the move; keep all stable `FR-*`, `NFR-*`, `UJ-*`, and `SM-*` IDs unchanged. | The Pyramid's answer, boundary, measures, and risks currently arrive after roughly 5,800 words of context and requirements. Moving 904 words (§6 229, §7 103, §8 446, §9 126) gives human readers the decision frame before detail. Word impact: 0 removed. |
| structure | `prd.md` §8 Primary metric `SM-1` points forward to §8.1 Canonical Acceptance Scenarios, which appears after Secondary and Counter-metrics | **MOVE** §8.1 Canonical Acceptance Scenarios directly beneath `SM-1`, then continue with `SM-2`–`SM-4`, Secondary metrics, and Counter-metrics. | The 203-word evidence block should sit next to the claim it proves. This removes a forward jump and follows the Pyramid rule that evidence supports, rather than trails far behind, the argument. Word impact: 0 removed. |
| structure | `prd.md` §6 MVP Scope and Delivery Milestones: 229 words across an introduction and seven short milestone subsections | **CONDENSE** the section into one scan-friendly milestone table with columns for milestone, included capability set, and explicit boundary/dependency where stated. Preserve the “one coherent MVP” interpretation and independent-usefulness rule above the table. | The current micro-sections are accurate but force repeated heading/list transitions. A table makes the capability sequence and boundaries comparable at a glance. Estimated impact: save about 25–40 words from the exact 229-word section (0.3–0.5% of the combined artifact). |
| structure | `prd.md` §0 Document Purpose and Authority, especially the paragraph assigning stable IDs inside a 123-word opening section | **MOVE** the stable-ID paragraph to a short “Requirement conventions” note immediately before §4 Functional Requirements; leave canonical authority, approval status, and source precedence in §0. | Stable-ID mechanics are important at the point readers enter the requirements database, but they interrupt the strategic opening. Moving part of the exact 123-word section improves top-level focus. Word impact: 0 removed. |
| structure | `prd.md` §2.3 Key User Journeys (448 words), §3 Glossary (489 words), standardized FR “Consequences (testable)” blocks, and §9 Risks and Guardrails (126 words) can look repetitive beside the requirements | **PRESERVE** these as distinct scaffolding: journeys show end-to-end human context, the glossary establishes shared language, the repeated FR schema supports scanning, and risks explain why guardrails exist. Keep journeys and glossary immediately before detailed requirements after the strategic-section move. | For human readers, these 1,063 words prevent the PRD from becoming a flat requirements database. Cutting them would reduce comprehension and engagement even though related terms and behaviors recur later. Word impact: 0 removed; explicit comprehension trade-off accepted. |
| structure | `addendum.md` §1 Existing Application Boundaries (108 words) is followed by milestone-specific context; shared §5 Engineering Verification Context (108 words) appears only after both milestone sections and delivery sequences | **MOVE** §5 Engineering Verification Context directly after §1, then present MVP 0, MVP 1, delivery sequencing, and extraction records. | Engineering verification applies to both milestone contexts, so placing its 108 words with shared boundaries prevents readers from treating it as late or optional evidence. Word impact: 0 removed. |
| structure | `addendum.md` §2 Persistence and tenancy (85 words) and §3 Relational and tenancy enforcement (80 words) repeat the shared Workspace scope, restricted-role, RLS, and defense-in-depth frame | **MERGE** shared tenancy assertions into one addendum subsection after Existing Application Boundaries; retain only the MVP 0 control-plane foundation and MVP 1 tenant-table delta under their respective milestone sections. | This makes the common rule authoritative in one place while keeping milestone-specific changes chronological. Estimated impact: save about 30–45 words across the exact 165-word pair (0.4–0.5% of the combined artifact). |
| structure | `addendum.md` §4 Delivery Sequencing (92 words) partially echoes `prd.md` §6 milestone summaries, while §6 Detailed Extraction Records (30 words) is pure audit navigation | **PRESERVE** both in the addendum and keep Detailed Extraction Records last. Do not merge delivery sequencing into the PRD scope table: one states implementation order, while the other states product capability boundaries. | The apparent overlap serves different reader tasks, and the final 30-word extraction index is correctly placed as supporting evidence. Word impact: 0 removed. |

## Summary

- **Recommendations:** 8 total — 4 moves, 2 preserves, 1 condensation, and
  1 merge.
- **Estimated reduction if all recommendations are accepted:** about 55–85
  words, or 0.7–1.0% of the exact 8,188-word combined artifact.
- **Length target:** none was provided. These recommendations optimize decision
  flow and scanability, not aggressive shortening.
- **Primary structural gain:** readers encounter product boundary, success
  conditions, and risks before the 38 detailed functional requirements.
- **Comprehension trade-off:** the review explicitly preserves journeys,
  glossary, repeated requirement schema, risks, and addendum trace sections;
  removing them would shorten the artifact but make it less usable for human
  readers.
