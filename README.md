# Manager Library API

Laravel backend for the Manager Library technical assessment. The approved documentation in the
`test-manager-library-3145555-docs` repository is the source of truth for business behavior, the
HTTP contract, and the physical data model.

This branch contains the Phase 1 foundation and contractual health check only. It deliberately does
**not** include business endpoints, authentication, loan or return behavior, or database migrations.

## Technology baseline

- PHP 8.3 or later
- Laravel 13
- Composer 2
- PostgreSQL 16 with the PDO PostgreSQL extension

No Node.js toolchain is required by this API project.

## Architecture

Business code lives under `src/Library` and follows Clean/Hexagonal Architecture:

```text
src/Library/
├── Domain/
├── Application/
│   ├── Ports/
│   └── UseCases/
├── Adapters/
│   ├── Inbound/Http/
│   └── Outbound/
│       ├── Persistence/
│       ├── Security/
│       └── Storage/
└── Bootstrap/
```

The empty `app/` directory exists only so Laravel can detect its conventional framework namespace;
business and adapter code must remain under `src/Library`.

Dependencies point inward. `Domain` is framework-independent; `Application` depends only on the
domain; Laravel, Eloquent, HTTP, security, and filesystem concerns remain in adapters. Port-to-adapter
bindings belong exclusively in `LibraryServiceProvider`, the module composition point.

The versioned API route file is `routes/api.php`, mounted at `/api/v1`. Phase 1 registers only
`GET /api/v1/health`, which returns `{"status":"ok"}`.

## Database ownership and schemas

The infrastructure repository starts an empty PostgreSQL 16 engine. Laravel migrations are the sole
source of DDL and will later create the `library` schema, its six documented business tables, indexes,
constraints, and the five fixed categories. Phase 1 creates none of them.

Application connections use the `library,public` search path. Business objects belong to `library`;
Laravel's technical migration repository is configured as `public.migrations`, so it does not become
a seventh business table. The initial migration must create `library` before creating business
objects there.

## Local setup

1. Install PHP, Composer, the PDO PostgreSQL extension, and PostgreSQL 16.
2. Install dependencies:

   ```bash
   composer install
   ```

3. Create the local environment file and generate the Laravel application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   On PowerShell, replace the copy command with:

   ```powershell
   Copy-Item .env.example .env
   ```

4. Set `DATABASE_URL` in `.env`, for example:

   ```dotenv
   DATABASE_URL=postgresql://manager_library:<password>@127.0.0.1:5432/manager_library
   ```

   The separate `DB_*` values are local fallbacks. Keep `DB_SEARCH_PATH=library,public` and
   `DB_MIGRATIONS_TABLE=public.migrations` unchanged unless the approved documentation changes.

5. Provide local, non-committed values for these required application variables:

   ```dotenv
   JWT_SECRET=<strong-random-secret>
   ADMIN_USERNAME=<initial-admin-username>
   ADMIN_PASSWORD=<initial-admin-password>
   CORS_ORIGIN=http://localhost:5173
   ```

   `COVERS_DIR` is optional and defaults to `storage/app/covers`. Phase 1 does not consume the JWT,
   administrator, or cover settings yet; they are declared now to keep environment ownership clear.

6. Start the development server:

   ```bash
   php artisan serve
   ```

Do not commit `.env` or real credentials. The committed `.env.example` contains names and safe local
defaults only.

## Development checks

```bash
composer validate --strict
composer lint
composer test
php artisan about
php artisan route:list
```

`php artisan migrate` is intentionally omitted until Phase 2 adds the approved migrations. When they
exist, migrations must be run by the application rather than by infrastructure startup scripts.

## Phase 1 boundaries

- No business endpoints are implemented; only the contractual health check exists.
- No authentication or authorization behavior is implemented.
- No business entity, repository adapter, or use case is implemented.
- No database table, column, seed, or migration is introduced.
- Spanish remains the required language for future contractual user-facing messages.
