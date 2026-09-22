---
source: ../../../../docs/mvp-0-visual-design.md
status: final
updated: 2026-09-22
---

# Reconciliation: MVP 0 Visual Design

## Migration verdict

This source is the approved presentation authority for MVP 0. Its visual
character, semantic token boundary, typography, spacing, shape, depth, motion,
component specifications, visual accessibility, non-goals, and acceptance
criteria migrate to `DESIGN.md`. Behavioral consequences such as focus,
keyboard operation, menu closing, busy announcements, and reduced-motion
behavior are cross-referenced in `EXPERIENCE.md` without duplicating visual
values.

The source is retained after canonical UX approval as guidance and migration
evidence. It may be reconsidered only if a separately approved deletion
checkpoint proves heading-complete coverage. Exact values absent from the source
remain unresolved under UX-OQ-4; no feature-local or reconciliation-time values
are invented.

## Heading-complete mapping

### `# MVP 0 Visual Design`

**Classification:** `DESIGN.md`; retained until separate source-retirement
approval.

Migrate the approved visual system without changing the UI/UX plan's screen
structure or behavior. `DESIGN.md` owns presentation, tokens, and shared visual
components; `EXPERIENCE.md` owns interaction.

### `## Status`

**Classification:** `DESIGN.md`; retained authority statement.

Preserve that this direction is approved for MVP 0 and implementation must
follow it. The existing UI/UX plan remains authoritative for structure and
behavior until canonical-spine approval.

### `## Intent`

**Classification:** `DESIGN.md`; later celebration behavior deferred.

Migrate the welcoming, sky-blue, bright, optimistic, lightly game-like,
rounded, phone-legible, clean, and credible character. It reduces the emotional
weight of maintenance without making records feel unreliable and remains
credible for individuals, mechanics, workshops, and small teams.

“Game-like” means tactile controls and encouraging feedback only. Points,
streaks, leaderboards, loot, achievements, and confetti are prohibited. Any
later celebration must correspond to meaningful completed work and respect
reduced motion.

### `## Design principles`

**Classification:** `DESIGN.md`; voice consequence in `EXPERIENCE.md`.

Migrate all five principles below as global rules rather than MVP 0-only
component variants.

### `### One obvious next action`

**Classification:** `DESIGN.md`.

Each screen has at most one visually dominant action. Secondary actions remain
visible but quieter. Do not use dense toolbars, equal-weight button rows, or
hidden actions that assume technical product knowledge.

### `### Friendly, never patronizing`

**Classification:** `DESIGN.md`; `EXPERIENCE.md` voice.

Use plain, encouraging language without baby talk, error jokes, or cartoon
metaphors for serious states. Playfulness never reduces precision for
authorization, conflict, or failure.

### `### Large where interaction happens`

**Classification:** `DESIGN.md`.

Primary text, controls, and touch targets are comfortably sized. Supporting
metadata may be smaller but stays readable. Hierarchy comes from deliberate
contrast, not making the whole interface oversized.

### `### Shape supports meaning`

**Classification:** `DESIGN.md`.

Rounded surfaces and tactile buttons create warmth. Full pills are reserved for
short statuses and selections. Large rounded containers group related content
instead of decorating every section.

### `### Calm canvas, colorful feedback`

**Classification:** `DESIGN.md`.

Use pale-sky application surfaces and white or deep-navy focused surfaces.
Reserve saturated color for Primary Button treatment, focus, meaningful states,
and small accents rather than every card.

### `## Color system`

**Classification:** `DESIGN.md`; unresolved question UX-OQ-4.

Components consume semantic token names. Raw hex values and Tailwind palette
names exist only in the centralized token definition. Feature components do not
redefine visual meaning.

### `### Light appearance`

**Classification:** `DESIGN.md`; required values.

Migrate these exact values:

| Semantic role                 | Required value                                  |
| ----------------------------- | ----------------------------------------------: |
| Canvas                        | `#F0F9FF`                                       |
| Surface                       | `#FFFFFF`                                       |
| Soft surface                  | `#E0F2FE`                                       |
| Strong text                   | `#0F172A`                                       |
| Secondary text                | `#475569`                                       |
| Primary action                | `#0369A1`                                       |
| Primary hover or pressed edge | `#075985`                                       |
| Bright accent                 | `#38BDF8`                                       |
| Border                        | `#BAE6FD`                                       |
| Focus ring                    | `#0EA5E9` plus an unresolved contrasting offset |

Ordinary text combinations must meet WCAG AA. Bright accent is not permitted as
small text on a light background.

### `### Dark appearance`

**Classification:** `DESIGN.md`; required values plus UX-OQ-4 gap.

Migrate these exact values:

| Semantic role                 | Required value                                  |
| ----------------------------- | ----------------------------------------------: |
| Canvas                        | `#071824`                                       |
| Surface                       | `#0C2638`                                       |
| Soft surface                  | `#12344A`                                       |
| Strong text                   | `#F0F9FF`                                       |
| Secondary text                | `#BAE6FD`                                       |
| Primary action                | `#38BDF8`                                       |
| Primary hover or pressed edge | `#7DD3FC`                                       |
| Border                        | `#1E4E69`                                       |
| Focus ring                    | `#7DD3FC` plus an unresolved contrasting offset |

Primary-action foreground is qualitatively “deep navy” but has no supplied
exact value. MVP 0 follows operating-system color preference and has no product
theme picker.

### `### Semantic colors`

**Classification:** `DESIGN.md`; unresolved question UX-OQ-4.

Required light foregrounds are Success `#15803D`, Warning `#B45309`, and Danger
`#B91C1C`. Information uses the primary sky-blue family, but no exact
information token is supplied. Every semantic state also requires a pale state
surface and a visible icon or label; color is never the sole signal. Exact pale
surfaces and dark semantic colors remain unresolved.

### `### Playful accents`

**Classification:** optional future `DESIGN.md` detail; deferred.

Sun yellow, coral, and mint may appear only in small illustrations, onboarding
detail, or future positive feedback. They never replace semantic colors or give
each peer a different color. No exact values are supplied, so they are not
tokens and are not required for MVP 0.

### `## Typography`

**Classification:** `DESIGN.md`; font-loading mechanism retained technical.

Use Nunito Sans with a system sans-serif fallback. Required weights are `400`
body, `600` labels/buttons/emphasis, and `700` page/section headings. Use system
monospace only for opaque identifiers, correlation IDs, and aligned technical
values. Meter Readings and costs remain Nunito Sans with tabular numerals.

| Role                       | Required size                            |
| -------------------------- | ---------------------------------------: |
| Page heading               | 32 px mobile; 36 px larger screens       |
| Section heading            | 24 px                                    |
| Body and editable controls | 17 px                                    |
| Button and label           | 16–17 px; no exact shared value supplied |
| Supporting text            | 14 px minimum in product workflows       |

Line height remains within 1.4–1.6. Long help text uses a short readable measure.
Next.js font loading remains a browser implementation detail.

### `## Spacing and density`

**Classification:** `DESIGN.md`.

Use a 4 px base scale with common steps `8`, `12`, `16`, `24`, `32`, and `48`
px. Required/ranged layout values are: 16 px mobile gutter; 24–32 px larger
gutter; 20–24 px field gap; 8–12 px related inline gap; 32 px section gap; 48 ×
48 px minimum Primary Button/control target; and 44 × 44 px compact secondary
target. Favor breathing room over above-the-fold density and avoid desktop-only
administration density.

### `## Shape and elevation`

**Classification:** `DESIGN.md`; unresolved shadow values in UX-OQ-4; optional
button depth.

Required radii: 20 px surfaces/cards, 14 px inputs/selects/ordinary buttons,
18 px menus/dialogs, and full pill for Status Badge. Use one-pixel sky-tinted
borders. Reserve soft blue-gray shadows for floating menus, dialogs, and the
most important raised surfaces; ordinary sections do not all float.

A Primary Button may use a 2–3 px darker bottom edge and subtle pressed movement;
this is permitted, not mandatory. Secondary Button remains flatter. Exact shadow
tokens are unresolved.

### `## Icons and illustration`

**Classification:** `DESIGN.md`; optional details; deferred illustration.

Use Lucide-style rounded outline icons at 20 or 24 px with consistent stroke.
Consequential controls include a visible text label. A simple rounded-square
tool mark for the Wrenchbase wordmark is permitted, not required. Illustration
is optional; if later approved, use simple geometry and small mechanical motifs,
not detailed mascots or stock art. No icon package is required until an
implemented screen uses it.

### `## Motion and feedback`

**Classification:** `DESIGN.md`; behavioral constraints in `EXPERIENCE.md`;
optional success/press motion.

Use 120–180 ms for hover, press, menu, and focus transitions. A Primary Button
may move 1–2 px on press. Loading remains calm and avoids large decorative
loops. Success may use a brief scale or check after a completed action. Reduced
motion removes non-essential movement. Motion never delays navigation,
submission, or access to an error.

### `## Components`

**Classification:** `DESIGN.md`; names shared verbatim with `EXPERIENCE.md`.

Create presentation primitives only when MVP 0 uses them in more than one
workflow. They are not a separate product domain or comprehensive library.
Feature behavior remains with the feature; variants remain deliberate. The
complete required component-name inventory is recorded below.

### `### Buttons`

**Classification:** `DESIGN.md`; busy behavior in `EXPERIENCE.md`.

Primary Button uses a large label and minimum 48 px height. Primary Button,
Secondary Button, Ghost Button, and Destructive Button require obvious hover,
focus, pressed, disabled, and busy treatment appropriate to their roles. A busy
button holds label width stable and describes the operation, for example
`Creating workspace…`.

### `### Fields`

**Classification:** `DESIGN.md`; association/focus behavior in `EXPERIENCE.md`.

Labeled Text Field and Labeled Select Field keep labels above controls, use at
least 48 px height and 17 px editable text, and show help before error. Error is
programmatically associated and never relies on red border alone.

### `### Surfaces`

**Classification:** `DESIGN.md`.

Content Surface is used only for a meaningful content boundary or interaction
target. Do not wrap every heading and paragraph in a card. Workspace overview
uses one Settings surface rather than a card for each value.

### `### Menus`

**Classification:** `DESIGN.md`; keyboard/focus behavior in `EXPERIENCE.md`.

Workspace Switcher and Account Menu use large rows. The active item has a label
or check in addition to color. Menus accommodate realistic Workspace names,
close with Escape, and return focus to the trigger.

### `### Alerts and conflicts`

**Classification:** `DESIGN.md`; recovery behavior in `EXPERIENCE.md`.

Page Alert and Field Alert communicate state accessibly. An alert has a clear
heading, icon, explanation, and specific next action. Conflict Comparison Region
shows current and local values calmly; ordinary concurrency must not appear
catastrophic.

### `## Tailwind implementation`

**Classification:** `DESIGN.md` token boundary; retained focused browser
implementation.

Centralize semantic tokens and shared primitives. Feature code consumes semantic
utilities and may add content-specific layout, but never creates competing
button, field, alert, menu, badge, or surface systems. Keep browser styling near
the browser application rather than publishing a premature cross-client package.
Future React Native may share vocabulary without consuming CSS/Tailwind.

The initial semantic inventory is canvas, surface, soft surface, floating
surface; strong, secondary, inverse text; primary, primary-active; border,
input, focus; success, warning, danger, information; common radii and shadows.
Missing exact values remain UX-OQ-4. Do not add a third-party component kit in
MVP 0. Native controls, React, and Tailwind support the small required set.

`web/src/app/globals.css`, `@theme inline`, Tailwind CSS 4, and package timing
remain implementation details rather than UX behavior.

### `## Accessibility standard`

**Classification:** `DESIGN.md`; `EXPERIENCE.md`; required validation.

WCAG 2.2 AA is a completion requirement. Preserve semantic/native behavior;
logical keyboard order, visible focus, no traps, and focus restoration; input
names and help/error association; retained values and error-summary focus;
announced asynchronous outcomes; independence from color, motion, hover, fine
pointer accuracy, and icon recognition; 200% text zoom; 320 px reflow without
ordinary horizontal scrolling; required contrast and targets in default, hover,
focus, disabled, busy, Validation, and conflict states; and OS reduced-motion
and color-scheme preferences.

Automated checks supplement rather than replace manual keyboard, zoom/reflow,
and representative screen-reader checks of Sign-in, onboarding, Workspace, and
stale-edit flows.

### `## Non-goals`

**Classification:** `DESIGN.md`; `EXPERIENCE.md` guardrails.

Do not introduce gamification mechanics; mascot/illustration system;
comprehensive design-system site; per-Workspace theme customization; compact
expert mode; dense data tables; or decorative animation unrelated to user
actions.

### `## Acceptance criteria`

**Classification:** `DESIGN.md` validation; retained review evidence.

Validate that a non-technical user immediately identifies the primary action;
the UI is friendly but not child-only; large type and controls fit at 320 px
without horizontal scrolling; the sky-blue palette remains readable; rounded
surfaces clarify grouping; playful feedback never obscures serious error or
conflict; and the same components remain credible for a mechanic or small
workshop.

## Complete token migration

### Required exact tokens

- Light: `canvas-light #F0F9FF`, `surface-light #FFFFFF`,
  `surface-soft-light #E0F2FE`, `text-strong-light #0F172A`,
  `text-secondary-light #475569`, `primary-light #0369A1`,
  `primary-active-light #075985`, `accent-bright-light #38BDF8`,
  `border-light #BAE6FD`, `focus-light #0EA5E9`,
  `success-foreground-light #15803D`, `warning-foreground-light #B45309`, and
  `danger-foreground-light #B91C1C`.
- Dark: `canvas-dark #071824`, `surface-dark #0C2638`,
  `surface-soft-dark #12344A`, `text-strong-dark #F0F9FF`,
  `text-secondary-dark #BAE6FD`, `primary-dark #38BDF8`,
  `primary-active-dark #7DD3FC`, `border-dark #1E4E69`, and
  `focus-dark #7DD3FC`.
- Typography: Nunito Sans plus fallback; weights `400`, `600`, `700`; sizes and
  ranges as mapped above; system monospace for technical values only.
- Spacing: 4 px base; common `8`, `12`, `16`, `24`, `32`, `48`; required/ranged
  gutters, gaps, and target sizes as mapped above.
- Radius: `control 14px`, `overlay 18px`, `surface 20px`, `full` pill.
- Motion: 120–180 ms transition range and 1–2 px optional press movement.

### UX-OQ-4: required roles without supplied exact values

- pale semantic state surfaces;
- dark Success, Warning, Danger, and Information colors;
- exact Information color in both appearances;
- floating surface;
- inverse text;
- input color;
- shadow values;
- contrasting focus-ring offset;
- exact dark Primary Button foreground; and
- no single exact Button/label font size inside the approved 16–17 px range.

Implementation must not invent or duplicate these values in feature code.

### Optional, permitted, or deferred values

- Sun yellow, coral, and mint have no supplied values and are not tokens.
- The 24–32 px gutter, 20–24 px field gap, 8–12 px inline gap, 16–17 px label
  size, and 1.4–1.6 line height are approved ranges, not missing exact tokens.
- Exact shadow values are unresolved even though shadow use is constrained.

## Complete component migration

The component names below remain identical in `DESIGN.md` and `EXPERIENCE.md`:

1. Primary Button
2. Secondary Button
3. Ghost Button
4. Destructive Button
5. Labeled Text Field
6. Labeled Select Field
7. Page Alert
8. Field Alert
9. Public Shell
10. Authenticated Shell
11. Workspace Switcher
12. Account Menu
13. Content Surface
14. Status Badge
15. Conflict Comparison Region

Required specifications are the mapped visual rules above. Optional tactile
depth, illustration, wordmark, icon-package addition, and success animation do
not become required components or variants.

## Optional-versus-required audit

### Required

- Approved visual character and anti-gamification boundary.
- One visually dominant action maximum.
- Exact supplied light/dark palette values and system color preference.
- Nunito Sans, supplied weights/sizes/ranges, readable line height, and technical
  monospace restrictions.
- Supplied spacing, target, radius, border, component, accessibility, and
  responsive rules.
- Semantic token consumption and centralized presentation primitives.
- Text/icon or text/label support where color or icon alone would carry meaning.
- WCAG 2.2 AA completion and manual critical-flow verification.

### Optional or permitted

- 2–3 px Primary Button bottom edge and 1–2 px pressed movement.
- Brief success check/scale motion.
- Rounded-square wordmark tool mark.
- Illustration, later and only in the described geometric/mechanical style.
- Sun yellow, coral, and mint accents in constrained future use.
- Icon package installation only when an implemented screen needs it.

### Prohibited

- Points, streaks, leaderboards, loot, achievements, confetti, mascots, or
  unrelated engagement mechanics.
- Bright accent as small light-background text; color-only states; icon-only
  consequential controls.
- Per-Workspace theme picker, expert compact mode, dense data tables, broad
  component-system work, or feature-local competing visual systems.
- Motion that delays action or remains non-essential under reduced motion.

## Dropped-detail audit

No approved qualitative visual detail, exact supplied value, range, component,
accessibility requirement, non-goal, or acceptance criterion is intentionally
dropped. Tailwind file paths and implementation mechanics remain retained
technical context. Optional details remain optional rather than being promoted
to requirements. Missing values remain explicit under UX-OQ-4 rather than being
filled by assumption.
