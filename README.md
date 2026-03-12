# ZonaJasa Back-end

Repository for the ZonaJasa Laravel-based API and Dockerized development environment.

## 🧩 Overview

ZonaJasa provides a RESTful API for managing services, users, authentication, and integration with external tools such as Waha and n8n. Core features include:

- Laravel 12 framework (PHP 8.2)
- Passport authentication (personal access tokens)
- Scheduled jobs and queue workers
- OTP mailing and header tracking

## 🚀 Getting Started with Docker

The project includes a `docker-compose.yaml` file and helper scripts.

### Prerequisites

- Docker & Docker Compose v2
- Make (optional, but targets are provided)
- `./platform.sh` detects host architecture (amd64/arm64)

### Environment

Copy `.env.example` to `.env` and adjust as needed. Key flags:

```ini
BUILD=true          # build local image; false to pull from registry
APP_URL=https://zonajasa.com
DB_*               # database credentials (mysql service)
WAHA_IMAGE=...      # optionally override image tag
```

### Commands

Use the included Makefile or run scripts directly.

```sh
# build or pull and start (handles arch detection automatically)
make zj-docker-start

# stop and remove containers
make zj-docker-stop

# restart services
make zj-docker-restart

# run artisan commands inside app container
make zj-docker-migrate
make zj-docker-refresh
```

Custom scripts are available in `scripts/`:

- `compose-start.sh` wraps `docker compose` with logic for `BUILD`, arch and profiles
- `platform.sh` returns `linux/amd64` or `linux/arm64` depending on host

Profiles allow switching between build and pull:

- `rebuild` profile builds `app-build` service
- `rerun` profile runs prebuilt `app-run` image

## 📡 API Endpoints

Base URL: `{{APP_URL}}/api/:version`

| Method | Endpoint      | Description                |
| ------ | ------------- | -------------------------- |
| POST   | `/login`      | Obtain access token        |
| POST   | `/register`   | User registration          |
| GET    | `/verify-otp` | List users (auth required) |

> Authentication is via Bearer token from Passport. Include
> `Authorization: Bearer <token>`.

## 🔧 Development Notes

## Struktur Folder

Proyek ini menggunakan **Domain-Driven Design (DDD)** dengan struktur folder berikut:

```
app/
├── Console/                    # Artisan commands
│   └── Commands/
├── Domain/                     # Business logic & entities
│   ├── Auth/                   # Auth domain
├── Infrastructure/             # External integrations & persistence
│   ├── Database/               # Database-related classes
│   └── Http/                   # HTTP controllers, middleware, requests
└── Internal/                   # Application services
    ├── Auth/                   # Auth services
```

### Directory Descriptions

| Folder                | Deskripsi                                                                                      |
| --------------------- | ---------------------------------------------------------------------------------------------- |
| `app/Domain/`         | Entitas bisnis, value objects, interfaces, dan business logic murni tanpa dependency eksternal |
| `app/Infrastructure/` | Implementasi kontrak domain, database models, HTTP controllers, middleware, dan form requests  |
| `app/Internal/`       | Application services yang menggunakan domain logic dan infrastructure                          |
| `bootstrap/`          | Framework bootstrapping dan cache configuration                                                |
| `config/`             | Konfigurasi aplikasi (database, cache, mail, auth, dll)                                        |
| `database/`           | Migrations, seeders, dan factories                                                             |
| `public/`             | Entry point dan assets statis                                                                  |
| `resources/`          | Blade templates, CSS, JavaScript, dan frontend assets                                          |
| `routes/`             | Route definitions untuk web dan console                                                        |
| `storage/`            | File uploads, cache, sessions, dan logs                                                        |
| `tests/`              | Unit tests dan feature tests                                                                   |
| `vendor/`             | Composer dependencies                                                                          |

The codebase follows a **clean architecture** / hexagonal style:

- **Domain layer** (`app/Domain`) contains business entities, value objects,
  and interfaces (contracts) that express core rules independent of frameworks.
- **Infrastructure layer** (`app/Infrastructure`) houses implementation details:
  database repositories, HTTP clients, mailers, and any framework-specific
  adapters.
- **Application layer** (inside `app/Internal` or `app/Module`) orchestrates use
  cases, request validation, and controllers; it depends on domain contracts but
  not on concrete infrastructure.
- Dependency inversion is maintained via interfaces and Laravel service
  providers (`app/Providers`) to bind implementations.

Other notes:

- Migrations are in `database/migrations`; factories and seeders available.
- Run `php artisan migrate --seed` within container (`make zj-docker-migrate`).
- Background jobs: `php artisan queue:work` or `make zj-job-lorawan`.

## 📦 Deployment

- When `BUILD=false`, the `app-run` service expects an image tag `zonajasa/zonajasa-be-laravel:1.0` from your registry.
- Ensure environment variables are set appropriately in production `.env`.

## 📝 Contributing

Feel free to open issues or PRs. Follow PSR‑12 coding style and include tests in `tests/Feature` or `tests/Unit`.

## 📄 License

Project code is MIT-licensed as per Laravel default.
