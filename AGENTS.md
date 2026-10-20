# AGENTS.md — Maison Korhogo / ImmoPro

## Project overview

Real estate platform (immobilier) for Côte d'Ivoire, branded **ImmoPro**. Laravel 13.8 / PHP 8.3+ with Vite 8, Tailwind CSS 3, Alpine.js. French-language UI throughout.

## Quick start

```bash
composer run setup   # install deps, copy .env, generate key, migrate, npm install, npm run build
composer run dev     # starts artisan serve + queue:listen + pail + vite concurrently
composer run test    # config:clear then artisan test
```

## Architecture

### Two property systems (important)

There are **two separate property models** — don't confuse them:

- **`Annonce`** — the main user-facing listing system. Users create annonces with images, equipment, pricing. Used on the public site (`/annonces`). Fields: `titre`, `description`, `type_bien`, `type_offre`, `categorie`, `prix`, `superficie`, `nombre_pieces`, `nombre_chambres`, `nombre_salles_bain`, `adresse`, `quartier`, `images` (JSON array), `equipements` (JSON array), `statut`, `date_disponibilite`, `id_user`.
- **`Bien`** — an older/secondary model used by the admin panel (`/admin/biens`). Linked to `Agence` and `Proprietaire`. Fields: `titre`, `description`, `type_bien`, `quartier`, `adresse`, `prix`, `nombre_pieces`, `statut`, `id_agence`, `id_proprietaire`.

### Role system

Users have an `role` enum: `admin`, `agence`, `proprietaire`, `client`. Each role gets a profile model:

- `admin` → no profile model, just the role
- `agence` → `Agence` (linked via `id_user`)
- `proprietaire` → `Proprietaire` (linked via `id_user`)
- `client` → `Client` (linked via `id_user`)

Middleware: `admin` (AdminMiddleware) checks `role === 'admin'`. `role:agence,proprietaire` (CheckRole) accepts multiple roles.

### Foreign key convention

This project uses `id_*` prefix for foreign keys (`id_user`, `id_agence`, `id_proprietaire`, `id_bien`), **not** Laravel's default `user_id` pattern. Always use this convention in queries, relationships, and new migrations.

### Auth

Custom `AuthController` handles registration (with role-based profile creation) and login. Google OAuth via `GoogleController` + Laravel Socialite. The `routes/auth.php` file (Breeze scaffolding) is loaded but its routes are **not used** — the actual auth routes are all in `routes/web.php`.

Registration creates the correct profile model based on the selected role via `match()`.

### Key routes

| Route | Controller | Auth |
|---|---|---|
| `GET /` | Closure (home page with recent annonces) | Public |
| `GET /annonces` | `AnnonceController@index` | Public |
| `GET /annonces/{annonce}` | `AnnonceController@show` | Public |
| `POST /annonces` | `AnnonceController@store` | Auth |
| `GET /admin` | `AdminDashboardController@index` | Auth + Admin |
| `GET /admin/users` | `UserController@index` | Auth + Admin |
| `GET /admin/biens` | `BienController@index` | Auth + Admin |
| `GET /admin/agences` | `AgenceController@index` | Auth + Admin |
| `GET /auth/google` | `GoogleController@redirect` | Public |

### Frontend

- **Layout**: `resources/views/layouts/app.blade.php` — contains all CSS inline (custom properties, navbar, footer, buttons, dropdowns). Uses `@yield('content')` and `@stack('styles')` / `@stack('scripts')`.
- **Fonts**: Plus Jakarta Sans (body) + Playfair Display (headings) via Google Fonts.
- **Icons**: Bootstrap Icons via CDN.
- **Colors**: CSS custom properties — `--primary: #284b63`, `--teal: #3c6e71`, `--accent: #d4a853`.
- Tailwind is configured but the main layout uses **custom CSS**, not Tailwind utilities. Tailwind is only used via `resources/css/app.css` (base/components/utilities directives).
- Alpine.js is loaded in `resources/js/app.js`.

### Database

- **Dev default**: SQLite (`DB_CONNECTION=sqlite` in `.env.example`).
- **Testing**: SQLite in-memory (`:memory:`), array drivers for cache/mail/session/queue.
- **Sessions/cache/queue**: Database-backed in production (`.env.example` defaults).
- `Schema::defaultStringLength(191)` in `AppServiceProvider` — needed for MySQL/MariaDB compatibility.

### Images

Annonce images are stored via `Storage::disk('public')` in `annonces/` directory. Requires `php artisan storage:link` for public access. Max 8 images per annonce, max 2MB each (jpg/jpeg/png/webp).

## Dev tooling

- **Laravel Pint** (`vendor/bin/pint`): code style fixer, Laravel preset.
- **StyleCI**: configured in `.styleci.yml` with `no_unused_imports` disabled.
- **PHPUnit 12**: `php artisan test` or `vendor/bin/phpunit`.
- **Laravel Debugbar**: dev dependency, available in local environment.
- **Laravel Pail**: log tailing, started by `composer run dev`.

## Environment variables (beyond defaults)

```
GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
GOOGLE_REDIRECT_URI=...
```

Required for Google OAuth. Configure in `config/services.php` → `google`.

## EditorConfig

- UTF-8, LF line endings, 4-space indent, final newline, trim trailing whitespace.
- YAML: 2-space indent.
- Markdown: no trailing whitespace trimming.
