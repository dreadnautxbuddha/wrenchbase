# Wrenchbase Web

The browser application is Wrenchbase's primary client. It is a mobile-first
Next.js application that renders API-owned maintenance data and supports scoped
offline job drafting. The Symfony API remains the source of truth for business
rules, authorization, validation, due-work calculation, and persistence.

## Development

Run the complete containerized stack from the repository root:

```shell
make up
```

The browser application is available at
[http://localhost:3000](http://localhost:3000). Run browser checks with:

```shell
make web-check
```

The root [README](../README.md) documents all development commands. The
repository's Docker Compose files provide `INTERNAL_API_URL` for server-side
composition and `NEXT_PUBLIC_API_URL` for browser requests; do not hard-code
either URL in product code.

## Architecture

Read the repository [architecture](../docs/architecture.md) and
[web instructions](AGENTS.md) before changing application structure. Product
code is organized under `src/features/` by capability. React components and
TanStack Query hooks call Application boundaries; HTTP, IndexedDB, runtime DTO
parsing, and browser APIs belong in Infrastructure; browser and server wiring
belongs in `src/composition/`.

The active workspace is explicit in product routes and API requests. Components
must not infer it from local storage or maintain their own copy of server state.
Use the [API contract](../docs/api-contract.md) and
[offline synchronization contract](../docs/offline-sync.md) when implementing
networked or queued behavior.

## User Experience

Follow the [UX and accessibility brief](../docs/ux-accessibility.md). In
particular, preserve clear workspace switching, visible offline/sync status,
usable touch targets, and explicit loading, empty, error, and conflict states.
Asset and schedule authoring are online-only in v1. Offline support is limited
to cached reading plus drafting maintenance jobs, readings, attachments, and
replacement proposals.
