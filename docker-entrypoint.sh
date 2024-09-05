#!/bin/bash

# Run composer
composer install --no-interaction --no-plugins --no-scripts

# Generate app key if not set
php artisan key:generate --no-interaction --force

# Clear cache and optimize
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan optimize

# Set correct permissions
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Start PHP-FPM
php-fpm
