# API Instructions

These instructions supplement the repository-level `AGENTS.md` and take precedence for work in `api/`.

Read the [backend architecture](../docs/architecture.md#backend-architecture) before changing application structure or dependencies. Follow the repository [contribution standards](../CONTRIBUTING.md) for tests, quality checks, documentation, and commits.

## Architecture

- Organize business code by capability first and Clean Architecture layer second.
- Preserve the source dependency direction `Infrastructure -> Application -> Domain`, with Infrastructure also allowed to depend directly on Domain.
- Keep Domain independent of Application, Infrastructure, Symfony, Doctrine, HTTP, and persistence concerns.
- Keep Application focused on use-case orchestration. It may depend on Domain and application-owned ports, but not Infrastructure or framework contracts.
- Keep controllers, persistence, external-service adapters, Doctrine mapping, and other technical details in Infrastructure.
- Define purpose-specific ports in Application when a use case needs an external capability. Wire infrastructure implementations through Symfony dependency injection.
- Keep behavior on aggregates and value objects when it naturally belongs there.
- Name application orchestrators after one use case with a `Handler` suffix. Avoid broad application services.
- Name domain services after a precise domain capability. Avoid generic `Services` directories and context-free service names.
- Introduce concept-focused subdirectories only when a cohesive concept needs them. Do not create parallel `Model`, `Entity`, and `ValueObject` directories by default.

## Testing

- Add or update PHPUnit tests for every API behavior change, especially domain rules and historical-record behavior.
- Name test methods in camel-case Given-When-Then form, with no underscores between the phases. For example:

  ```php
  public function testGivenAnArchivedAssetWhenItIsUpdatedThenTheUpdateIsRejected(): void
  {
      // ...
  }
  ```

- Use `PHPUnit\Framework\TestCase` for isolated domain tests, `KernelTestCase` for integration tests that need Symfony services, and `WebTestCase` for HTTP behavior.
- Run targeted tests while developing and run `composer qa` from `api/` before completing API changes.
- Treat `composer.json` and `composer.lock` as authoritative for dependencies and available scripts.
