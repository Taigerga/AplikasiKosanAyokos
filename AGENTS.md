# AyoKos — AGENTS.md

## Tech stack
- **Laravel 12** on **PHP 8.2+**, **MySQL** (local), **SQLite** (test), **Tailwind CSS v4**, **Vite**, **Blade**, **Sanctum**

## Key commands
| Command | What it does |
|---|---|
| `composer dev` | Dev server + queue + logs + Vite concurrently |
| `composer test` | `config:clear && artisan test` (PHPUnit on SQLite `:memory:`) |
| `composer setup` | Full project bootstrap (composer install, env, key, migrate, npm, build) |
| `npm run dev` / `npm run build` | Vite dev / production build |
| `php artisan test --filter={TestName}` | Single test |
| `./vendor/bin/phpunit tests/Feature/{TestName}.php` | Single file (bypass artisan config clear) |

## Architecture

### Auth
Single `web` guard (session) sharing one `User` model with `role` column:
- Web: `auth` middleware (default `web` guard) + `penghuni`/`pemilik` middleware for role check
- API: Sanctum (`auth:sanctum`) — supports both session-based (from web) and token-based (mobile) auth
- Login accepts username+password only (no role selection). **All controllers & views use `auth()->user()` consistently** (no guard-specific `auth('penghuni')` calls).

### Route files
- `routes/web.php` — all web routes (public + auth'd penghuni/pemilik)
- `routes/api.php` — all API routes (public + Sanctum-protected)

### Controllers
- **`app/Http/Controllers/API/`** — 32 API controllers (Pemilik*, Penghuni*, Auth, Public, Admin, Notification, PaymentCallback)
- **`app/Http/Controllers/Web/`** — 19 Web controllers (Blade views, same Service layer as API)
- Both layers share the same Service classes — no logic duplication.

### Middleware
- `penghuni` — role check for penghuni-only routes
- `pemilik` — role check for pemilik-only routes
- API uses `auth:sanctum` (Sanctum) which supports both session-based (from web) and token-based (mobile) auth

### Validation
- **`app/Http/Requests/`** — 19 centralized FormRequest classes:
  - `Auth/` — LoginRequest, RegisterRequest
  - `Pemilik/` — StoreKos, UpdateKos, StoreKamar, UpdateKamar, StoreKosFasilitas, UpdateKosFasilitas, StorePengaturanKos, UpdatePengaturanKos
  - `Penghuni/` — StoreKontrak, ExtendKontrak, StorePembayaran, StoreReview, UpdateReview
  - `Profile/` — UpdatePenghuniProfile, UpdatePemilikProfile, UploadFotoProfil, ChangePassword

### Service Layer
- **`app/Services/`** — 9 folders (14 classes, ~153 methods): `Auth`, `Kos` (incl. `FotoKosService`), `Kamar`, `Kontrak`, `Pembayaran`, `Review`, `Profile`, `Analisis`, `Notification` (5 classes)
- Both Web & API Controllers delegate business logic to shared Service classes.

### Admin
- 6 API controllers + 1 Web controller under `Admin/` namespace
- Full CRUD for: admin users, data-penghuni, data-pemilik
- Read-only for: data-kontrak, data-pembayaran

### Payment Callback
- API-only webhook: `POST /api/payment/callback` — handles settled/paid/expired/failed (HMAC-SHA256 signature via `X-Callback-Signature` header using `PAYMENT_CALLBACK_TOKEN`)
- `GET /api/payment/simulate/{externalId}` — testing endpoint (admin-only via `auth:sanctum` + `admin`)

### Form Submission
- **AJAX-first**: forms use `data-ajax="true"` + `data-ajax-action="/api/..."` (handled by `resources/js/utils/ajax-form.js`)
- **Fallback**: forms retain `action="{{ route(...) }}"` for non-JS submission
- **API client**: `resources/js/services/api-client.js` — Axios with CSRF, Bearer token, error interceptors
- **Error handler**: `resources/js/utils/notifications.js` — `handleApiError()` maps HTTP status codes to toast messages (401 → login failed / session expired, 422 → validation errors, etc.)

### Notable implementation details
- Sanctum SPA middleware (`EnsureFrontendRequestsAreStateful`) is active in `bootstrap/app.php` — API supports both session-based (from web) and token-based auth
- Security headers via `SecurityHeaders` middleware (web stack): X-Frame-Options, X-Content-Type-Options, X-XSS-Protection, Referrer-Policy, Permissions-Policy, HSTS, CSP
- Global rate limiters: `api-global` (120/min/IP), `web-global` (60/min/IP)
- Session: `cookie` driver, `encrypt=true`, `same_site=strict`
- Sanctum token expiration: 1440 min (24h) via `SANCTUM_TOKEN_EXPIRATION`

### Sessions / queue / cache
- Sessions: `cookie` driver (Sanctum SPA requires cookie-based sessions)
- Queue: `database` driver
- Cache: `database` driver

### Storage
Public file serving via custom `Route::get('/storage/{folder}/{filename}')` (not `php artisan storage:link`). Allowed folders: `kos, kamar, ktp, bukti, pembayaran, profiles, reviews, kontrak, foto_profil, bukti_pembayaran`.

## Testing
- **PHPUnit** (not Pest). SQLite `:memory:` per test.
- RefreshDatabase used explicitly where needed (not in base TestCase).
- `composer test` always runs `config:clear` first.
- Tests live in `tests/Feature/` and `tests/Unit/`.

## Code style
- Laravel Pint (PSR-12), indent: 4 spaces, LF line endings
- PHP models use Indonesian snake_case primary keys (`id_kos`, `id_pemilik`, etc.)
- Blade views in `resources/views/` organized by role (`admin/`, `pemilik/`, `penghuni/`, `public/`)
- Views include Font Awesome via npm (`@fortawesome/fontawesome-free`), not CDN
