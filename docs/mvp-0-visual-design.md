# MVP 0 Visual Design

## Status

This document is a review draft. It translates the approved MVP 0 layout and
interaction flow into a proposed visual system. The
[MVP 0 UI/UX plan](mvp-0-ui-ux-plan.md) remains authoritative for screen
structure and behavior until this direction is approved.

## Intent

Wrenchbase should feel welcoming to someone maintaining a scooter, appliance,
chair, tool, or family vehicle for the first time. The interface should reduce
the emotional weight of maintenance without making the underlying records feel
unreliable.

The proposed character is:

- sky-blue, bright, and optimistic;
- lightly game-like through tactile controls and encouraging feedback;
- rounded and friendly without becoming toy-like;
- large and legible on a phone;
- clean enough that a non-technical user can identify the next action quickly;
  and
- credible for mechanics, workshops, and small teams.

"Game-like" describes presentation and feedback, not artificial engagement.
MVP 0 does not add points, streaks, leaderboards, loot, achievements, or
confetti. Later celebrations must correspond to meaningful completed work and
respect reduced-motion preferences.

## Design principles

### One obvious next action

Each screen has at most one visually dominant action. Secondary actions remain
visible but quieter. Avoid dense toolbars, rows of equal-weight buttons, and
hidden actions that require technical product knowledge.

### Friendly, never patronizing

Use plain, encouraging language without baby talk, jokes inside errors, or
cartoon metaphors for serious states. The interface can feel playful while
still explaining authorization, data conflicts, and failures precisely.

### Large where interaction happens

Primary text, controls, and touch targets are comfortably sized. Supporting
metadata may be smaller but remains readable. Do not make the entire interface
oversized; hierarchy comes from deliberate contrast between primary and
secondary information.

### Shape supports meaning

Rounded surfaces and tactile buttons establish warmth. Pills are reserved for
short statuses and selections. Large rounded containers must group related
content rather than decorate every section.

### Calm canvas, colorful feedback

Use pale sky surfaces for the application environment and white or deep-navy
surfaces for focused content. Saturated color belongs on primary actions,
focus, meaningful states, and small accents rather than every card.

## Color system

Use semantic design tokens in components. Tailwind color names and raw hex
values belong only in the global token definition; feature components consume
names such as `canvas`, `surface`, `primary`, and `danger`.

### Light appearance

- Canvas: `#F0F9FF`, a very pale sky blue.
- Surface: `#FFFFFF`.
- Soft surface: `#E0F2FE`.
- Strong text: `#0F172A`.
- Secondary text: `#475569`.
- Primary action: `#0369A1`.
- Primary hover or pressed edge: `#075985`.
- Bright accent: `#38BDF8`.
- Border: `#BAE6FD`.
- Focus ring: `#0EA5E9` with a contrasting offset.

The proposed primary, text, and semantic foreground combinations meet WCAG AA
contrast for ordinary text. The bright accent is not used as small text on a
light background.

### Dark appearance

- Canvas: `#071824`.
- Surface: `#0C2638`.
- Soft surface: `#12344A`.
- Strong text: `#F0F9FF`.
- Secondary text: `#BAE6FD`.
- Primary action: `#38BDF8` with deep navy text.
- Primary hover or pressed edge: `#7DD3FC`.
- Border: `#1E4E69`.
- Focus ring: `#7DD3FC` with a contrasting offset.

MVP 0 follows the operating-system color preference. It does not add an
in-product theme picker.

### Semantic colors

- Success foreground: `#15803D` in light appearance.
- Warning foreground: `#B45309` in light appearance.
- Danger foreground: `#B91C1C` in light appearance.
- Informational foreground: the primary sky-blue family.

Each semantic state also has a pale surface and visible icon or label. Color is
never its only identifying signal.

### Playful accents

Sun yellow, coral, and mint may appear in small illustrations, onboarding
details, or future positive feedback. They do not replace semantic colors and
do not give every peer element a different color.

## Typography

Use **Nunito Sans** for the interface. Its rounded forms support the friendly
direction while remaining readable for forms and operational data. Load it
through Next.js font handling and provide a system sans-serif fallback.

Use three weights:

- `400` for body text;
- `600` for labels, buttons, and emphasized values; and
- `700` for page and section headings.

Use a system monospace stack only for opaque identifiers, correlation IDs, and
aligned technical values. Ordinary meter readings and costs stay in Nunito Sans
with tabular numerals so they remain approachable.

Proposed sizes:

- Page heading: 32 pixels on mobile and 36 pixels on larger screens.
- Section heading: 24 pixels.
- Body and editable controls: 17 pixels.
- Button and label text: 16 to 17 pixels.
- Supporting text: 14 pixels, never smaller in product workflows.

Use comfortable line heights between 1.4 and 1.6. Long help text should wrap
into short readable measures rather than span a wide desktop screen.

## Spacing and density

Use a four-pixel base scale, with `8`, `12`, `16`, `24`, `32`, and `48` pixels
as the common steps.

- Mobile page gutter: 16 pixels.
- Larger mobile and desktop page gutter: 24 to 32 pixels.
- Form field gap: 20 to 24 pixels.
- Related inline-control gap: 8 to 12 pixels.
- Section gap: 32 pixels.
- Minimum interactive target: 48 by 48 pixels for primary controls and 44 by
  44 pixels for compact secondary controls.

Prefer more breathing room over fitting more controls above the fold. Avoid
desktop-only density that makes the mobile experience feel like a compressed
administration panel.

## Shape and elevation

- Primary surfaces and cards: 20-pixel radius.
- Inputs, selects, and ordinary buttons: 14-pixel radius.
- Menus and dialogs: 18-pixel radius.
- Status badges: full pill radius.

Use one-pixel sky-tinted borders to define structure. Use soft blue-gray shadows
only for floating menus, dialogs, and the most important raised surfaces.
Ordinary page sections should not all become floating cards.

Primary buttons may use a two- or three-pixel darker bottom edge and a subtle
pressed movement. This creates tactile, game-like feedback without adding
visual clutter. Secondary buttons remain flatter.

## Icons and illustration

Use Lucide-style rounded outline icons at 20 or 24 pixels with a consistent
stroke. Consequential controls include a visible text label; do not expect a
non-technical user to decode an icon-only action.

The Wrenchbase wordmark may use a simple rounded-square tool mark in MVP 0.
Illustration is optional. If introduced later, use simple geometric shapes and
small friendly mechanical motifs rather than detailed mascots or stock art.

## Motion and feedback

- Use 120- to 180-millisecond transitions for hover, press, menu, and focus
  feedback.
- A primary button may move down one or two pixels when pressed.
- Loading indicators remain calm and do not loop large decorative motion.
- Success messages may use a brief scale or check motion after a completed
  action.
- Honor `prefers-reduced-motion` by removing non-essential movement.

Motion must never delay navigation, form submission, or access to an error.

## Components

Create presentation primitives only when MVP 0 uses them in more than one
workflow. Expected reusable pieces are:

- primary, secondary, ghost, and destructive buttons;
- labeled text and select fields with help and error text;
- page-level and field-level alerts;
- the public and authenticated shells;
- the workspace switcher and account menu;
- a content surface;
- a status badge; and
- a conflict comparison region.

These are presentation components, not a separate product domain or a broad
component library. Keep feature behavior in its feature and keep variants
deliberate.

### Buttons

Buttons use large labels, a minimum 48-pixel primary height, and obvious hover,
focus, pressed, disabled, and busy states. A busy button keeps its label width
stable and describes the operation, such as `Creating workspace…`.

### Fields

Labels remain above inputs. Controls have at least a 48-pixel height and
17-pixel editable text. Help text appears before an error; an error is connected
to its field and does not rely on a red border alone.

### Surfaces

Use a surface when content needs a clear boundary or interaction target. Avoid
wrapping every heading and paragraph in a card. The workspace overview uses one
settings surface rather than separate cards for every value.

### Menus

Menus use large rows, visible active-state labels or checks, and enough width to
show realistic workspace names. They close with Escape and return focus to the
trigger.

### Alerts and conflicts

Alerts use a clear heading, icon, explanation, and specific next action. Stale
edits show current and local values in calm comparison surfaces; the visual
treatment must not make a normal concurrency event feel catastrophic.

## Tailwind implementation

Tailwind CSS 4 is already installed. Define the semantic tokens in
`web/src/app/globals.css` and expose them through `@theme inline`. Feature code
uses semantic utilities rather than raw palette utilities wherever the design
meaning matters.

Keep the initial token set small:

- canvas, surface, soft surface, and floating surface;
- strong, secondary, and inverse text;
- primary and primary-active;
- border, input, and focus;
- success, warning, danger, and information; and
- common radii and shadows.

Do not add a third-party component kit in MVP 0. Build the small set of required
accessible primitives with native controls, React, and Tailwind. Add an icon
package only when implementation reaches a screen that uses it.

## Non-goals

- gamification mechanics;
- a mascot or illustration system;
- a comprehensive design system site;
- theme customization per workspace;
- compact expert-only modes;
- dense data tables; and
- decorative animation unrelated to user actions.

## Review criteria

Approve this direction only when the styled wireframes demonstrate that:

- a non-technical user can identify the primary action immediately;
- the interface feels friendly without appearing intended only for children;
- large text and controls still fit at 320 pixels without horizontal scrolling;
- the sky-blue palette maintains readable contrast;
- rounded surfaces clarify grouping rather than create clutter;
- playful feedback does not obscure serious errors or conflicts; and
- the same components remain credible for a mechanic or small workshop.
