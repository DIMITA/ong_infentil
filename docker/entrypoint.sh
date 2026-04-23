#!/usr/bin/env bash
set -e

# ── Wait for PostgreSQL to be ready ──────────────────────────────────────────
echo "[entrypoint] Waiting for PostgreSQL at ${DB_HOST}:${DB_PORT:-5432}..."
until php -r "
  \$c = @pg_connect('host=${DB_HOST} port=${DB_PORT:-5432} dbname=${DB_DATABASE} user=${DB_USERNAME} password=${DB_PASSWORD}');
  exit(\$c ? 0 : 1);
" 2>/dev/null; do
  sleep 1
done
echo "[entrypoint] PostgreSQL is ready."

# ── Storage symlink ───────────────────────────────────────────────────────────
php artisan storage:link --force 2>/dev/null || true

# ── Run migrations ────────────────────────────────────────────────────────────
echo "[entrypoint] Running migrations..."
php artisan migrate --force

# ── Caches ───────────────────────────────────────────────────────────────────
echo "[entrypoint] Caching config, routes, views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan filament:cache-components 2>/dev/null || true
php artisan icons:cache 2>/dev/null || true

echo "[entrypoint] Boot complete — starting services."
exec "$@"
