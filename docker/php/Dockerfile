FROM php:8.4-cli

# Configure PHP settings for file uploads and execution time
RUN echo "upload_max_filesize = 100M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_input_time = 300" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/uploads.ini

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libzip-dev \
    zip unzip git curl \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql intl zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ARG USER_ID=1000
ARG GROUP_ID=1000

# Pre-create volume mount points with the right owner so new named volumes inherit it
RUN mkdir -p \
        node_modules \
        storage/app/public \
        storage/framework/cache \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    # && chown -R ${USER_ID}:${GROUP_ID} node_modules storage bootstrap/cache
    && chown -R ${USER_ID}:${GROUP_ID} node_modules bootstrap/cache

# uncomment for dev
EXPOSE 8000 5173
