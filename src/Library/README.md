# Library module

This module follows Clean/Hexagonal Architecture. Dependencies point inward:

- `Domain` contains framework-independent business types and rules.
- `Application` contains use cases and the ports they require.
- `Adapters/Inbound/Http` translates Laravel HTTP requests and responses.
- `Adapters/Outbound` integrates persistence, security, clocks, and cover storage.
- `Bootstrap` is the single composition point that binds ports to Laravel adapters.

Domain and application code must not import Laravel, Eloquent, HTTP, filesystem, JWT, or database
types. This Phase 1 structure intentionally contains no business implementation.
