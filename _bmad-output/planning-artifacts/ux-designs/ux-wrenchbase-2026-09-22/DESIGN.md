---
name: Wrenchbase
description: Friendly, sky-blue, mobile-first visual system for trustworthy maintenance records.
status: final
approval: approved
approved: 2026-09-22
sources:
  - ../../prds/prd-wrenchbase-2026-09-21/prd.md
  - ../../prds/prd-wrenchbase-2026-09-21/addendum.md
  - ../../../../docs/ux-accessibility.md
  - ../../../../docs/mvp-0-ui-ux-plan.md
  - ../../../../docs/mvp-0-visual-design.md
  - ../../../../docs/architecture.md
  - ../../../../docs/api-contract.md
  - ../../../../docs/offline-sync.md
  - ../../../../docs/security-and-data-lifecycle.md
  - ../../../../docs/mvp-0-delivery-runbook.md
  - ../../../../README.md
updated: 2026-09-22
colors:
  canvas-light: '#F0F9FF'
  surface-light: '#FFFFFF'
  surface-soft-light: '#E0F2FE'
  text-strong-light: '#0F172A'
  text-secondary-light: '#475569'
  primary-light: '#0369A1'
  primary-active-light: '#075985'
  accent-bright-light: '#38BDF8'
  border-light: '#BAE6FD'
  focus-light: '#0EA5E9'
  success-foreground-light: '#15803D'
  warning-foreground-light: '#B45309'
  danger-foreground-light: '#B91C1C'
  canvas-dark: '#071824'
  surface-dark: '#0C2638'
  surface-soft-dark: '#12344A'
  text-strong-dark: '#F0F9FF'
  text-secondary-dark: '#BAE6FD'
  primary-dark: '#38BDF8'
  primary-active-dark: '#7DD3FC'
  border-dark: '#1E4E69'
  focus-dark: '#7DD3FC'
typography:
  page-heading-mobile:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontSize: 32px
    fontWeight: '700'
  page-heading-large:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontSize: 36px
    fontWeight: '700'
  section-heading:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontSize: 24px
    fontWeight: '700'
  body:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontSize: 17px
    fontWeight: '400'
  editable:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontSize: 17px
    fontWeight: '400'
  label:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontWeight: '600'
  supporting:
    fontFamily: 'Nunito Sans, system-ui, sans-serif'
    fontSize: 14px
    fontWeight: '400'
  technical:
    fontFamily: 'ui-monospace, monospace'
rounded:
  control: 14px
  overlay: 18px
  surface: 20px
  full: 9999px
spacing:
  base: 4px
  '2': 8px
  '3': 12px
  '4': 16px
  '5': 20px
  '6': 24px
  '8': 32px
  '11': 44px
  '12': 48px
  gutter-mobile: 16px
  section-gap: 32px
components:
  primary-button:
    background-light: '{colors.primary-light}'
    background-active-light: '{colors.primary-active-light}'
    background-dark: '{colors.primary-dark}'
    background-active-dark: '{colors.primary-active-dark}'
    minHeight: '{spacing.12}'
    radius: '{rounded.control}'
  secondary-button:
    minHeight: '{spacing.11}'
    radius: '{rounded.control}'
  ghost-button:
    minHeight: '{spacing.11}'
    radius: '{rounded.control}'
  destructive-button:
    foreground-light: '{colors.danger-foreground-light}'
    minHeight: '{spacing.11}'
    radius: '{rounded.control}'
  labeled-text-field:
    minHeight: '{spacing.12}'
    radius: '{rounded.control}'
    font: '{typography.editable}'
  labeled-select-field:
    minHeight: '{spacing.12}'
    radius: '{rounded.control}'
    font: '{typography.editable}'
  page-alert:
    radius: '{rounded.overlay}'
    border-light: '{colors.border-light}'
    border-dark: '{colors.border-dark}'
  field-alert:
    foreground-light: '{colors.danger-foreground-light}'
  public-shell:
    canvas-light: '{colors.canvas-light}'
    canvas-dark: '{colors.canvas-dark}'
  authenticated-shell:
    canvas-light: '{colors.canvas-light}'
    canvas-dark: '{colors.canvas-dark}'
  workspace-switcher:
    radius: '{rounded.overlay}'
  account-menu:
    radius: '{rounded.overlay}'
  content-surface:
    background-light: '{colors.surface-light}'
    background-dark: '{colors.surface-dark}'
    radius: '{rounded.surface}'
  status-badge:
    radius: '{rounded.full}'
  conflict-comparison-region:
    background-light: '{colors.surface-soft-light}'
    background-dark: '{colors.surface-soft-dark}'
    radius: '{rounded.surface}'
---

# Wrenchbase — Design Spine

This approved spine migrates existing visual decisions; it does not create a
new visual direction. `DESIGN.md` owns how Wrenchbase looks and `EXPERIENCE.md`
owns how it behaves. They are peer contracts and both win over mockups,
wireframes, or imports. The retained source documents remain guidance,
reconciliation evidence, and focused authorities within their documented
boundaries.

## Brand & Style

Wrenchbase is bright, optimistic, rounded, and welcoming without looking
toy-like. Its sky-blue environment and tactile controls reduce the emotional
weight of maintaining a scooter, appliance, chair, tool, family vehicle, or
workshop equipment while keeping the records credible and dependable.

The visual character is lightly game-like only through tactile controls and
encouraging feedback. It never introduces points, streaks, leaderboards, loot,
achievements, confetti, or decorative rewards. Any later celebration must
represent meaningful completed work and remain optional under reduced motion.

Each surface has at most one visually dominant action. Secondary actions stay
visible but quieter. Primary text and controls are large and legible on a phone;
supporting information is smaller without becoming faint or cramped. The same
system must remain credible for individuals, mechanics, workshops, and small
teams.

The Wrenchbase wordmark may use a simple rounded-square tool mark in MVP 0; this
is permission, not a required logo. Illustration is optional and is not part of
the current system. If approved later, it uses simple geometry and small friendly
mechanical motifs rather than a mascot, detailed character art, or stock art.

## Colors

The application environment uses `{colors.canvas-light}` in light appearance and
`{colors.canvas-dark}` in dark appearance. Focused content uses
`{colors.surface-light}` or `{colors.surface-dark}`; quiet grouping may use the
corresponding `surface-soft` token. Saturated color belongs on primary actions,
focus, meaningful states, and small accents—not every surface.

| Role           | Light                           | Dark                           | Rule                                               |
| -------------- | ------------------------------: | -----------------------------: | -------------------------------------------------- |
| Canvas         | `{colors.canvas-light}`         | `{colors.canvas-dark}`         | Application environment.                           |
| Surface        | `{colors.surface-light}`        | `{colors.surface-dark}`        | Focused content.                                   |
| Soft surface   | `{colors.surface-soft-light}`   | `{colors.surface-soft-dark}`   | Quiet grouping and comparison.                     |
| Strong text    | `{colors.text-strong-light}`    | `{colors.text-strong-dark}`    | Headings and primary content.                      |
| Secondary text | `{colors.text-secondary-light}` | `{colors.text-secondary-dark}` | Supporting content; never substitute low contrast. |
| Primary action | `{colors.primary-light}`        | `{colors.primary-dark}`        | Dominant action only.                              |
| Primary active | `{colors.primary-active-light}` | `{colors.primary-active-dark}` | Hover or pressed edge.                             |
| Border         | `{colors.border-light}`         | `{colors.border-dark}`         | One-pixel structural boundary.                     |
| Focus          | `{colors.focus-light}`          | `{colors.focus-dark}`          | Visible ring with a contrasting offset.            |

In light appearance, success uses `{colors.success-foreground-light}`, warning
uses `{colors.warning-foreground-light}`, and danger uses
`{colors.danger-foreground-light}`. Every semantic state also requires a pale
surface plus a visible icon or label; color is never the only signal. Bright
accent `{colors.accent-bright-light}` is not small text on a light background.

The operating-system color preference selects light or dark appearance. MVP 0
has no in-product theme picker and no per-Workspace theme customization.

[OPEN QUESTION UX-OQ-4] Exact values are not supplied for semantic state
surfaces, dark semantic colors, information, floating surface, inverse text,
input, shadows, focus offset, or the dark primary-action foreground. Until that
is resolved, implementations must not invent or duplicate those values.

Sun yellow, coral, and mint are optional future accents for illustrations or
positive feedback. No source supplies their token values, so they are not
tokens in this draft. They never replace semantic colors or assign every peer a
different color.

## Typography

Nunito Sans is the interface typeface, loaded through supported Next.js font
handling with a system sans-serif fallback. Use weight `400` for body text,
`600` for labels, buttons, and emphasized values, and `700` for page and section
headings.

- Page headings use `{typography.page-heading-mobile}` on mobile and
  `{typography.page-heading-large}` on larger screens.
- Section headings use `{typography.section-heading}`.
- Body and editable controls use `{typography.body}` and
  `{typography.editable}`.
- Button and label text is 16–17 pixels; the source does not choose one exact
  size for a shared token.
- Supporting text uses `{typography.supporting}` and is never smaller in product
  workflows.
- Line heights stay between 1.4 and 1.6. Long help text wraps to a short readable
  measure instead of spanning a wide screen.

Use `{typography.technical}` only for opaque identifiers, correlation IDs, and
aligned technical values. Meter Readings and costs remain in Nunito Sans with
tabular numerals.

## Layout & Spacing

Use a four-pixel base with common steps 8, 12, 16, 24, 32, and 48 pixels. The
mobile page gutter is `{spacing.gutter-mobile}`; larger mobile and desktop
gutters are 24–32 pixels. Form fields are separated by 20–24 pixels, related
inline controls by 8–12 pixels, and sections by `{spacing.section-gap}`.

Layouts start at a 320-pixel CSS viewport and favor breathing room over fitting
more controls above the fold. Wider viewports increase surrounding space rather
than introducing needless columns or desktop-only density. Long names, errors,
and user content wrap or expose their complete accessible value; they do not
clip the layout.

Primary interactive targets are at least 48 by 48 pixels. Compact secondary
targets are at least 44 by 44 pixels. MVP 0 forms remain a single column at all
widths, with labels above controls. The Workspace overview uses one settings
surface rather than a card for every value.

## Elevation & Depth

Structure comes first from tone, spacing, and one-pixel sky-tinted borders.
Soft blue-gray shadows are reserved for floating menus, dialogs, and the most
important raised surfaces. Ordinary page sections do not all become floating
cards.

Primary buttons may use a two- or three-pixel darker bottom edge. Secondary
buttons remain flatter. No source supplies exact shadow values; see
`[OPEN QUESTION UX-OQ-4]`.

## Shapes

Use `{rounded.surface}` for primary surfaces and cards, `{rounded.control}` for
inputs, selects, and ordinary buttons, `{rounded.overlay}` for menus and
dialogs, and `{rounded.full}` only for short statuses and selections. Rounded
containers must group related content rather than decorate every section.

Lucide-style rounded outline icons use a consistent stroke at 20 or 24 pixels.
Consequential controls include visible text; an icon alone never carries their
meaning.

Motion uses 120–180 millisecond transitions for hover, press, menu, and focus
feedback. A primary button may move down one or two pixels when pressed. Loading
motion stays calm and avoids large decorative loops; a success message may use a
brief scale or check movement after completed work. Reduced motion removes all
non-essential movement, and motion never delays navigation, submission, or
access to an error.

## Components

The formal component names below are shared verbatim with
`EXPERIENCE.md` Component Patterns. They are presentation primitives, not a new
product domain or a broad component library.

| Component                  | Visual specification                                                                                                                                                                                                         |
| -------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Primary Button             | `{components.primary-button}`; large label, one dominant action per surface, minimum 48-pixel height, darker 2–3 pixel bottom edge permitted, visible hover/focus/pressed/disabled/busy appearance, stable width while busy. |
| Secondary Button           | `{components.secondary-button}`; flatter and quieter than Primary Button, still visibly interactive in every state.                                                                                                          |
| Ghost Button               | `{components.ghost-button}`; lowest visual action weight while retaining a visible focus state and practical target.                                                                                                         |
| Destructive Button         | `{components.destructive-button}`; danger treatment plus explicit label; never danger color alone.                                                                                                                           |
| Labeled Text Field         | `{components.labeled-text-field}`; label above, 17-pixel editable text, help before error, visible focus, at least 48 pixels high.                                                                                           |
| Labeled Select Field       | `{components.labeled-select-field}`; same visual order, size, typography, and state treatment as Labeled Text Field.                                                                                                         |
| Page Alert                 | `{components.page-alert}`; clear heading, icon, explanation, and specific next action; state is not communicated by color alone.                                                                                             |
| Field Alert                | `{components.field-alert}`; visually adjacent to its field, does not replace the field label or rely on a red border.                                                                                                        |
| Public Shell               | `{components.public-shell}`; calm compact column on the application canvas; Wrenchbase name, concise statement, and one primary action.                                                                                      |
| Authenticated Shell        | `{components.authenticated-shell}`; top-bar model with clear Workspace context and a constrained main column; no empty sidebar or MVP 0 bottom navigation.                                                                   |
| Workspace Switcher         | `{components.workspace-switcher}`; large rows, enough width for realistic Workspace names, active item marked by label or check as well as color.                                                                            |
| Account Menu               | `{components.account-menu}`; same overlay language as Workspace Switcher, with large readable rows.                                                                                                                          |
| Content Surface            | `{components.content-surface}`; boundary only where content needs grouping or an interaction target; not a wrapper for every heading and paragraph.                                                                          |
| Status Badge               | `{components.status-badge}`; full pill only for short status or selection text; always includes a readable label.                                                                                                            |
| Conflict Comparison Region | `{components.conflict-comparison-region}`; calm current-versus-local comparison; must not make ordinary concurrency appear catastrophic.                                                                                     |

Feature presentation consumes the centralized semantic tokens and shared
primitives. It does not repeat raw palette values or create competing button,
field, alert, menu, badge, or surface systems.

## Do's and Don'ts

| Do                                                                                                                            | Don't                                                                                            |
| ----------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------ |
| Keep the canvas calm and reserve saturated color for actions, focus, meaningful states, and small accents.                    | Give every card or peer element a different bright color.                                        |
| Make one next action visually obvious and keep secondary actions quieter.                                                     | Build dense toolbars or rows of equal-weight buttons.                                            |
| Use rounded grouping and tactile feedback to create warmth.                                                                   | Turn every section into a floating card or make the product toy-like.                            |
| Use icons with visible labels for consequential actions.                                                                      | Require icon recognition, hover, motion, or color to understand meaning.                         |
| Validate contrast in light and dark appearance across default, hover, focus, disabled, busy, validation, and conflict states. | Use `{colors.accent-bright-light}` as small text on a light background.                          |
| Preserve legibility at 320 CSS pixels and 200% text zoom.                                                                     | Add compact expert modes, dense data tables, or clipped text.                                    |
| Use feedback tied to real work and honor reduced motion.                                                                      | Add points, streaks, achievements, confetti, unrelated decorative animation, or a mascot system. |
| Keep component variants deliberate and centralized.                                                                           | Build a comprehensive design-system site or a competing feature-local visual system.             |
