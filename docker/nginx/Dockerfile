# Stage 1: PHP dependencies (Vite needs vendor/livewire/flux CSS)
FROM composer:2 AS vendor

WORKDIR /app

COPY ./src/composer.json ./src/composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --no-scripts \
    --ignore-platform-reqs


# Stage 2: Build Vite assets
FROM node:22 AS frontend

WORKDIR /app

COPY ./src/package.json ./src/package-lock.json ./
RUN npm ci

COPY ./src/ .
COPY --from=vendor /app/vendor ./vendor
RUN npm run build


# Stage 3: Nginx
FROM nginx:alpine

COPY ./src/public /var/www/html/public
COPY --from=frontend /app/public/build /var/www/html/public/build

RUN rm -rf /var/www/html/public/storage \
    && ln -s /var/www/html/storage/app/public /var/www/html/public/storage

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf