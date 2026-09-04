# Contributing

Keep changes focused on the application or shared contract involved. When an API contract changes, update the API and every affected client together.

Treat each application's manifest and lockfile as the source of truth for its exact dependency versions and available commands.

## Testing Standards

- Cover behavior changes with automated tests in every application they affect.
- Prioritize observable behavior, domain rules, and the historical meaning of maintenance records.
- When a change spans the API contract and the web client, add or update tests in both applications.

### API Tests

Name PHPUnit tests using a Given-When-Then structure so the precondition, action, and expected outcome are explicit:

```php
public function testGivenAnArchivedAssetWhenItIsUpdatedThenTheUpdateIsRejected(): void
{
    // ...
}
```

Keep the method name in camel case. The `Given`, `When`, and `Then` words mark the scenario boundaries without underscores.

### Web Tests

Structure Vitest suites with an outer `describe()` block for the Given precondition and a nested `describe()` block for the When action. Express each Then outcome as a separate `test()` or `it()` call:

```typescript
describe("Given an archived asset", () => {
  describe("When the user attempts to update it", () => {
    it("then displays an error message", () => {
      // ...
    });

    it("then does not submit the update", () => {
      // ...
    });
  });
});
```

## Quality Checks

Run checks for every application changed. The root Make targets execute them in the project containers:

```shell
make api-qa
make web-check
make check
```

The underlying application commands are `composer qa` from `api/` and `npm run check` from `web/`.

## Contracts and Releases

- Update [the API contract](docs/api-contract.md) with every client-visible API
  behavior change and keep affected clients compatible in the same change.
- Update [the offline synchronization contract](docs/offline-sync.md) when a
  queued command, conflict, or sync state changes.
- Update [the deployment guide](docs/deployment.md) when a required environment
  variable, service dependency, migration procedure, or operational runbook
  changes.
- Treat dependency updates as reviewable changes: update only the relevant
  manifest and lockfile, run its application checks, and record security- or
  compatibility-relevant changes in the pull request or commit body.
- A release must pass `make check`, apply migrations successfully, complete a
  health check, and have a tested backup restore for its target environment.

## Markdown Guidelines

- Keep Markdown readable in its raw form as well as when rendered.
- Use ATX headings (`#`, `##`, and so on) with a single space after the marker, and do not skip heading levels.
- Leave a blank line before and after headings, lists, tables, and fenced code blocks.
- Use fenced code blocks with an appropriate language identifier when one is available.
- Prefer descriptive link text over bare URLs, and use relative links for files within the repository.
- Keep list markers and indentation consistent.
- Pad Markdown table cells and align every column's pipes to its widest cell, including its header. Realign the entire table whenever its contents change.

## Commit Standards

- Make each commit a single cohesive change. Do not combine unrelated features, fixes, refactors, formatting, or documentation.
- Keep implementation and its directly related tests together.
- Keep each commit reviewable and independently valid where practical.
- Inspect the working tree before staging, and stage explicit files or hunks so unrelated changes are not included.
- Use a Conventional Commit-style subject with an appropriate scope when useful.
- In the commit body, explain why the change is needed, what changed, and how it was verified.
