<!-- BEGIN:nextjs-agent-rules -->

# This is NOT the Next.js you know

This version has breaking changes — APIs, conventions, and file structure may all differ from your training data. Read the relevant guide in `node_modules/next/dist/docs/` (resolved from this file's directory; in monorepos the `next` package may not be visible from the repo root) before writing any code. Heed deprecation notices.

This block is written and re-added by `next dev` — verify at `node_modules/next/dist/server/lib/generate-agent-files.js`. Removing it from a diff only re-creates the uncommitted change; committing it with your work keeps the tree clean.

<!-- END:nextjs-agent-rules -->

# Web Application Instructions

These instructions supplement the repository-level `AGENTS.md` and take precedence for work in `web/`.

Read the [application boundaries and frontend architecture](../docs/architecture.md) before changing client responsibilities, server-state handling, or offline behavior. Follow the repository [contribution standards](../CONTRIBUTING.md) for tests, quality checks, documentation, and commits.

## Application Boundaries

- Treat the API as the source of truth for business rules, authorization, validation, and persistence behavior.
- Keep Next.js-specific presentation and interaction logic in the web application.
- Do not duplicate domain rules that the API can enforce.
- Keep workflows mobile-first while retaining a good desktop experience.

## Frontend Architecture

- Organize product code by capability first and by Clean Architecture layer second. Use `features/` as the Wrenchbase convention for capabilities; it has no special meaning to Next.js.
- Keep React, Next.js, TanStack Query, HTTP, IndexedDB, and browser APIs out of Domain and Application.
- Add a Domain layer only for genuine framework-independent client-owned behavior. Do not recreate API aggregates as frontend domain objects merely because the API returns their data.
- Keep external request and response DTOs private to Infrastructure. Map them to Application read models or genuine Domain objects before returning them inward.
- Let Presentation depend on Application and Domain, but do not import concrete Infrastructure implementations from React components or TanStack Query hooks.
- Define purpose-specific ports in Application and implement them in Infrastructure. Wire concrete adapters to use cases only in Composition.
- Keep browser and server composition separate when their APIs or configuration differ. Do not import browser-only modules into the server module graph.
- Treat Next.js `app/` pages, layouts, providers, loading states, and error boundaries as thin delivery code.
- Do not call `fetch`, construct API URLs, interpret HTTP responses, or access IndexedDB directly in React components.
- Do not use Next.js Route Handlers or Server Functions as a duplicate business backend; the Symfony API remains authoritative.
- Do not create empty architectural layers in advance. Introduce a layer when a capability has code that belongs there.

## State and Offline Behavior

- Use TanStack Query for server state.
- Use component state for simple UI state. Add another client-state library only when React state is no longer practical.
- Store meaningful offline data in IndexedDB, likely through Dexie. Do not use `localStorage` for offline drafts, queued attachments, or other durable application data.
- Keep asset type, asset attribute, and maintenance plan changes online-only in v1.
- Allow offline creation of maintenance job drafts, including queued attachments, but keep edits and deletes of existing records online-only in v1.

## Testing

- Add or update Vitest tests for every web behavior change.
- Use an outer `describe()` block for the Given precondition and a nested `describe()` block for the When action.
- Express each Then outcome as a separate `test()` or `it()` call. Follow the complete example in the [web testing standards](../CONTRIBUTING.md#web-tests).
- Run targeted tests while developing and run `npm run check` from `web/` before completing web changes.
- Treat `package.json` and `package-lock.json` as authoritative for dependencies and available scripts.
