# MVP 0 Engineering Standards Hardening Plan

This plan closes the gap between Wrenchbase's documented architecture and the
checks that protect it. It applies to the Symfony API, the Next.js browser
application, repository scripts, documentation, local hooks, and continuous
integration.

Implement this plan as Package 5 of the
[MVP 0 delivery runbook](mvp-0-delivery-runbook.md), after API authentication
and before workspace persistence and browser feature work. The package is a
single engineering-foundation change: it must not add product behavior or
silently rewrite an API contract.

## Goals

- Give contributors one unambiguous source for coding, testing, and command
  standards.
- Apply deterministic formatting to both applications.
- Enforce a hard 120-character limit in manually authored PHP, JavaScript,
  TypeScript, JSX, and TSX source and test files.
- Make warnings, type failures, architecture violations, tests, and production
  build failures block completion.
- Keep local hooks, documented commands, root Make targets, and CI consistent.
- Correct the small amount of starter code that predates the capability-first
  architecture and test naming rules.
- Keep the checks fast enough for ordinary development while reserving the
  real-stack end-to-end suite for the complete milestone gate.

## Non-goals

- Do not change authentication, workspace, JSON:API, persistence, or UI
  behavior.
- Do not add a global coverage percentage while the product has little domain
  code. Behavior coverage remains mandatory, and later packages add tests for
  their explicit risks.
- Do not introduce the 120-physical-lines-per-file limit planned for the later
  readable source package. That separate modularity rule can coexist with the
  120-character line-width rule in this package.
- Do not add speculative application layers merely to exercise an architecture
  rule.
- Do not replace PHPStan, PHP CS Fixer, ESLint, TypeScript, Vitest, or PHPUnit.

## Standards authority

Keep each document responsible for one kind of rule:

- `AGENTS.md` defines instruction scope, required source documents, application
  boundaries, and completion behavior for implementation agents.
- `api/AGENTS.md` and `web/AGENTS.md` contain only application-specific
  architecture and test guidance that overrides or supplements the root.
- `CONTRIBUTING.md` is the canonical contributor reference for coding style,
  tests, quality commands, documentation, and commits.
- Tool configuration is the executable authority for formatting, static
  analysis, import restrictions, and test execution.
- The root `Makefile` is the public command interface. Package-manager scripts
  are implementation details used by those targets.

Remove duplicated wording where it can drift. Application instructions should
link to the canonical contributor section instead of restating a second
version of the same command policy.

Add explicit required-reading links:

- Read the security and data lifecycle policy before changing identity,
  authorization, tenancy, secrets, attachments, retention, or deletion.
- Read the UX and accessibility brief before changing user-facing browser
  workflows or shared presentation components.
- Continue to require the API and offline contracts when their behavior is
  affected.

## Repository formatting baseline

Move shared text-file rules into a root `.editorconfig` and remove the
API-local duplicate after confirming equivalent PHP behavior. Define explicit
overrides instead of relying on editor defaults:

- UTF-8, LF endings, final newlines, and trimmed trailing whitespace;
- four spaces for PHP;
- two spaces for TypeScript, JavaScript, JSX, TSX, JSON, CSS, and YAML;
- tabs where Make syntax requires them; and
- preserved intentional trailing spaces in Markdown.

Keep PHP CS Fixer on the Symfony rule set with strict types required for all
manually authored PHP source and tests.

Add Prettier to the web development toolchain with a committed configuration
and ignore file, using `printWidth: 120`. Use the Tailwind-compatible formatter
integration so utility classes have one stable order. Because Prettier treats
line width as a wrapping preference, also enable `@stylistic/max-len` as an
error with a 120-character code and comment limit. Do not ignore long strings,
template literals, regular expressions, or URLs in maintained source; split or
extract them deliberately. Exclude generated, dependency, lock, minified, and
build output rather than weakening the source rule. Add separate write and
check scripts; only the check script belongs in the normal quality gate. Limit
the initial formatting pass to maintained web source and configuration so
unrelated documentation is not mechanically rewritten.

## Backend coding standard

Document and enforce the following baseline:

- Every manually authored PHP file starts with `declare(strict_types=1)`.
- Every manually authored PHP source and test line is at most 120 characters.
  Add PHP_CodeSniffer's hard line-length sniff with both the preferred and
  absolute limit set to 120; generated files, dependencies, lockfiles, and
  migrations may be explicitly excluded.
- Follow [Symfony's published coding standard](https://symfony.com/doc/current/contributing/code/standards.html),
  including PSR-12/PSR-4 structure, strict comparisons, Yoda ordering when
  comparing a variable with an expression, trailing commas in multiline
  arrays, early returns instead of `else` after a returning or throwing branch,
  braces for every control body, Symfony member ordering, and no `void` return
  declaration on PHPUnit test methods.
- Follow Symfony naming: camel case for variables, functions, methods, and
  arguments; upper camel case for classes, interfaces, traits, enums, enum
  cases, and PHP filenames; screaming snake case for constants; `Abstract`,
  `Interface`, `Trait`, and `Exception` affixes where Symfony prescribes them;
  and snake case for route and configuration names.
- All parameters, properties, and return values are typed. Structured domain or
  application data uses a named object, value object, or documented precise
  shape instead of an unexplained `array` or `mixed` value.
- Domain and Application code do not suppress errors, use global state, or
  depend on framework service location.
- Domain failures use domain language. Infrastructure exceptions are translated
  at the application or delivery boundary and do not leak vendor details into
  API documents.
- Transactions are owned by an application use case when several persistence
  effects must succeed atomically.
- Instants are UTC and calendar-only facts remain dates, consistent with the
  architecture and product requirements.
- New application orchestrators are single-use-case handlers. Generic manager,
  helper, utility, or service classes require a precise capability-oriented
  name and responsibility.

Wrenchbase adopts Symfony's code and naming rules, not Symfony-project package
headers or optional contributor `@author` tags. The hard 120-character limit is
a Wrenchbase override: wrap a declaration when Symfony's ordinary same-line
preference would exceed it.

Keep PHP CS Fixer's `@Symfony` preset as the primary automatic style fixer and
add explicit rules where the preset leaves a project choice. Use
PHP_CodeSniffer for the hard line limit and naming checks that PHP CS Fixer does
not cover. Add positive and negative fixtures for variable/member naming,
strict and Yoda comparisons, early-return condition structure, and line length
so configuration drift cannot silently disable the standard.

Keep PHPStan at `max` for source and tests, with no baseline. Add Deptrac as a
development check for the documented source dependency direction:

```text
Infrastructure -> Application -> Domain
Infrastructure ----------------> Domain
```

The dependency configuration must permit Symfony bootstrap and configuration
code deliberately, while rejecting framework or Infrastructure dependencies
from Domain and Application. Add a small failing fixture or configuration test
that proves an inward dependency violation is detected.

Move the starter health endpoint into a capability-neutral Infrastructure
namespace, with its test in the corresponding test namespace. Treat the
Symfony kernel and framework configuration as explicit composition/bootstrap
exceptions rather than pretending they are domain capabilities.

## Web coding standard

Document and enforce the following baseline:

- Every manually authored JavaScript, TypeScript, JSX, and TSX source and test
  line is at most 120 characters. Prettier should normally wrap it; the
  ESLint Stylistic rule is the hard backstop.
- TypeScript remains strict; new `any` values are prohibited except at an
  external boundary where they are immediately narrowed or parsed.
- Prefer `unknown` for untrusted data and validate external responses before
  returning them from Infrastructure.
- Use type-only imports for types and named exports for ordinary modules.
  Next.js entrypoints and configuration files may use their required default
  exports.
- Components remain responsible for presentation and interaction. They do not
  construct transport requests, interpret wire responses, or access durable
  browser storage directly.
- Tests query the rendered interface through roles, labels, names, and visible
  behavior instead of implementation-only selectors when an accessible query
  is available.
- Interactive components must preserve keyboard operation, visible focus,
  accessible names, error associations, and non-color status communication.

Enable type-aware linting through typescript-eslint's strict type-checked and
stylistic type-checked configurations. Keep the Next.js Core Web Vitals and
TypeScript configurations, then make these project choices explicit at error
severity:

- **Unsafe values:** reject explicit `any`, unsafe assignment, argument, call,
  member access, and return; reject unsafe function types and non-null
  assertions except a narrowly documented framework interop case.
- **Promises:** reject floating promises, misused promises, and awaiting
  non-promises; require consistent awaited returns and `Error` rejection
  values.
- **Control flow:** require strict equality, explicit boolean expressions,
  exhaustive `switch` statements, and no unnecessary conditions.
- **Mutation:** prefer `const` and mark private members `readonly` when they are
  only assigned during construction.
- **Types and imports:** require consistent type imports, reject CommonJS
  `require()` in application code, reject empty or unsafe object/function
  types, and keep external data `unknown` until validated.
- **Naming:** use camel case for variables, functions, methods, parameters, and
  ordinary properties; Pascal case for classes, interfaces, type aliases,
  enums, and React components; and permit external wire keys only at the
  Infrastructure boundary.
- **Maintainability:** reject unused variables and private members, shadowed
  declarations, implicit evaluation, thrown non-`Error` values, and production
  `console` calls outside approved repository scripts.
- **React and accessibility:** retain the Next.js and React Hooks rules and
  enforce accessible JSX semantics through the existing framework rule set,
  adding a focused rule only where an audited gap exists.

Do not enable complexity, parameter-count, or magic-number limits in this
package. Those thresholds are highly context-sensitive and would encourage
mechanical extraction before Wrenchbase has enough production code to set an
evidence-based limit.

Add `eslint-plugin-jsdoc` with TypeScript-aware validation. Define a class
property as immediately identifiable only when its type is explicit in
TypeScript or its JavaScript initializer is an unambiguous primitive literal.
For every other class property:

- JavaScript and JSX require a JSDoc block with a complete-sentence description
  and a valid `@type {Type}` declaration.
- TypeScript and TSX require an explicit TypeScript type annotation plus a
  JSDoc block with a complete-sentence description. Do not duplicate the type
  with `@type`; the TypeScript annotation remains the single type authority.
- Document units, nullability meaning, lifecycle, and valid states when those
  facts are not expressed by the declared type.

Use `jsdoc/require-jsdoc` with `PropertyDefinition` contexts, the appropriate
JavaScript and TypeScript error presets, description validation, and targeted
ESLint fixtures. If selectors cannot express the exact conditional reliably,
add a small local ESLint rule with RuleTester coverage rather than weakening the
requirement or requiring noise on self-evident primitive fields.

Make ESLint warnings fatal with `--max-warnings=0`. Add file-scoped
`no-restricted-imports` rules to the flat ESLint configuration for the
documented web layers:

- Domain cannot import Application, Infrastructure, Presentation, Composition,
  React, Next.js, TanStack Query, HTTP, IndexedDB, or browser-only modules.
- Application cannot import Infrastructure, Presentation, Composition, React,
  Next.js, or browser APIs.
- Presentation cannot import concrete Infrastructure or Composition modules.
- Infrastructure cannot import Presentation or Composition modules.
- Server composition cannot import browser composition or browser-only
  adapters.

Use the existing `@/` alias in the restrictions. Include representative valid
and invalid import fixtures in an automated configuration test so a glob or
path-alias mistake cannot make the rule silently ineffective.

## Test conventions

Retain behavior-first test requirements in every affected application.

For PHPUnit:

- Require camel-case `testGiven...When...Then...` method names.
- Continue to select `TestCase`, `KernelTestCase`, or `WebTestCase` according to
  whether the test needs no framework, the Symfony container, or HTTP delivery.
- Prefer strict assertions when type is part of the result.
- Keep first-party Symfony deprecations fatal.
- Add a lightweight repository check for test method names and a fixture that
  proves a nonconforming name fails.

For Vitest:

- Keep an outer Given `describe`, an inner When `describe`, and one observable
  Then outcome per `it` or `test`.
- Use Testing Library and `user-event` for browser behavior.
- Treat timers, network boundaries, storage, and randomness explicitly so tests
  remain deterministic.

Correct existing starter tests as part of the package. Do not add a brittle
text parser for nested Vitest suites; enforce their structure through examples,
review, and focused ESLint/Vitest rules where an established rule expresses the
requirement accurately.

## Quality commands, hooks, and CI

Make the root commands canonical and keep their responsibilities explicit:

```text
make api-qa       Composer validation, PHP format, architecture, PHPStan, tests
make web-check    Prettier, ESLint, TypeScript, Vitest, production build
make pre-commit   Fast API and web gates; no real-stack end-to-end suite
make check        Complete current repository gate
```

Align `composer qa`, GrumPHP, npm scripts, Make targets, contributor guidance,
and application instructions so equivalent commands run the same checks in the
same order. Do not retain a documented shortcut that omits Composer validation
or architecture checks.

Add a deterministic `next build` to the web gate. Document non-secret build
configuration and ensure the build does not require a live identity provider or
API. Keep runtime integration in the later real-stack package.

Update the pre-commit hook to call `make pre-commit`, covering both
applications. CI continues to call `make check`. The later Playwright package
may extend `make check` with the real-stack suite without making ordinary
pre-commit work launch browsers.

## Implementation sequence

1. Reconcile written authority and command names in all three `AGENTS.md`
   files and `CONTRIBUTING.md`.
2. Add the root EditorConfig, PHP hard line-length and Symfony rules, web
   formatter, ESLint hard line limit, typed linting, and JSDoc checks; format
   only files in scope.
3. Add backend and web architecture checks with positive and negative fixtures.
4. Add the PHPUnit naming check and correct existing starter placement and test
   names.
5. Align Composer, npm, Make, pre-commit, and CI entrypoints; add the web
   production build gate.
6. Run each underlying check independently, then run the public root gates.
7. Review the final diff for generated files, unrelated rewrites, weakened
   rules, or accidental product behavior changes.

## Acceptance criteria

- A fresh checkout has one discoverable contributor standard and one canonical
  root command per quality workflow.
- PHP and web formatting are deterministic and checked without changing files.
- A 121-character line in either maintained PHP or maintained JS/TS source
  fails its application quality command.
- Symfony condition ordering and naming violations fail API QA.
- A non-obvious JavaScript or TypeScript class property without its required
  type information and JSDoc description fails web linting.
- A representative forbidden backend dependency and forbidden frontend import
  both make the appropriate quality command fail.
- Existing source and tests conform to the documented architecture and test
  naming rules.
- Any ESLint warning fails `make web-check`.
- A TypeScript error, failing Vitest, formatting difference, or failed Next.js
  production build fails `make web-check`.
- Composer invalidity, PHP formatting drift, a dependency violation, a PHPStan
  error, a bad PHPUnit test name, or a failing PHPUnit test fails `make api-qa`.
- The pre-commit hook covers both applications without running Playwright.
- CI runs the same `make check` developers use locally.
- No product contract or visible behavior changes.

## Verification

Run the individual gates first so failures identify the responsible layer,
then the aggregate commands:

```shell
make api-qa
make web-test
make web-check
make pre-commit
make check
docker compose config --quiet
git diff --check
```

Also execute each negative fixture once and confirm it fails for the intended
reason before confirming the clean repository passes again.
