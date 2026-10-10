# Online Indegene

A small PHP application for registering and searching local-government indigene records.

## Requirements

- PHP 8.2 or later with the `mysqli` and `fileinfo` extensions
- MySQL 8.0 or later
- Composer 2 (for the test suite)

## Run with Docker

Docker Compose starts Apache/PHP and MySQL, creates the `fika_admin` table on the
database's first start, and serves the app at <http://localhost:8080>.

```sh
cp .env.example .env
docker compose up --build
```

Open <http://localhost:8080/home_fika.php> to begin. Register a record from the
Register link; the Records link lists saved records. To stop the services, run
`docker compose down`. The database is stored in the `mysql-data` volume and is
preserved when the services stop. To remove it and start with an empty database,
run `docker compose down --volumes`.

The values in `.env.example` are for local development only. Change them before
using this setup outside a private development environment.

## Run without Docker

1. Create a MySQL database named `fika` and apply [`schema.sql`](./schema.sql).
2. Configure the connection using `DB_HOST`, `DB_USER`, `DB_PASS`, and `DB_NAME`.
   Defaults are `localhost`, `root`, an empty password, and `fika`.
3. Ensure `Fika/images/` is writable by the PHP process for uploaded images.
4. Serve the `Fika/` directory with PHP 8.2+ and open `home_fika.php`.

## Tests

Install the development dependencies and run the PHPUnit suite:

```sh
composer install
composer test
composer lint
```

The tests cover database environment configuration and verify that search terms,
including SQL-looking input, remain bound parameters rather than SQL text.
The lint command enforces PSR-12 in `Fika/lib/` and `tests/`; the legacy page
templates remain outside that style check.

## Application structure

- `Fika/` contains the PHP pages, stylesheets, and static assets.
- `Fika/database_fika.php` configures the MySQLi connection and reads settings
  from the environment.
- `Fika/lib/` contains database configuration, query construction, and logging
  helpers.
- `schema.sql` defines the application records table and is loaded by Docker
  when its database volume is initialized.
- `tests/` contains the PHPUnit suite.

The registration page writes indigene records and uploaded image paths to
`fika_admin`; the search and records pages read from that table. Bootstrap and
other browser assets are vendored under `Fika/` and are not installed through
Composer.
