#!/bin/sh
set -e

# The laravel_storage volume hides the image's storage/ directory.
# Copy in anything new from the image copy without overwriting existing files
# (-n keeps user uploads and logs). Remove -n for paths that git should always win.
cp -an /opt/storage-seed/. storage/

php artisan storage:link || true
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# The volume is shared with nginx, so keep it readable and writable by php-fpm
chown -R www-data:www-data storage bootstrap/cache

exec php-fpm