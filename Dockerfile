# ─────────────────────────────────────────────
# Stage 1 — Build frontend assets
# ─────────────────────────────────────────────
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts

COPY resources/ resources/
COPY vite.config.js ./
COPY public/ public/

RUN npm run build

# ─────────────────────────────────────────────
# Stage 2 — Install PHP dependencies
# ─────────────────────────────────────────────
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-interaction \
        --no-progress \
        --optimize-autoloader \
        --ignore-platform-reqs

# ─────────────────────────────────────────────
# Stage 3 — Production image (PHP-FPM 8.3)
# ─────────────────────────────────────────────
FROM php:8.4-fpm-alpine AS app

LABEL org.opencontainers.image.title="ONG Infentil"
LABEL org.opencontainers.image.description="Laravel 13 / PHP 8.4 application for ONG Infentil"

# System dependencies & PHP extensions
RUN apk add --no-cache \
        bash \
        curl \
        freetype-dev \
        git \
        icu-dev \
        jpeg-dev \
        libpng-dev \
        libwebp-dev \
        libxml2-dev \
        libzip-dev \
        oniguruma-dev \
        postgresql-dev \
        shadow \
        supervisor \
        unzip \
        zlib-dev \
    && docker-php-ext-configure gd \
            --with-freetype \
            --with-jpeg \
            --with-webp \
    && docker-php-ext-install -j"$(nproc)" \
            bcmath \
            exif \
            gd \
            intl \
            mbstring \
            opcache \
            pcntl \
            pdo_pgsql \
            pgsql \
            xml \
            zip \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /tmp/pear

# PHP runtime config
COPY docker/php/php.ini     /usr/local/etc/php/conf.d/app.ini
COPY docker/php/www.conf    /usr/local/etc/php-fpm.d/www.conf

# Supervisor config (app + queue worker)
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# App code
WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data --from=vendor  /app/vendor ./vendor
COPY --chown=www-data:www-data --from=frontend /app/public/build ./public/build

# Ensure storage dirs exist with correct permissions
RUN mkdir -p \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/testing \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

COPY --chown=www-data:www-data docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
