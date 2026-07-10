#!/usr/bin/env bash
echo "Menginstal dependency Laravel..."
composer install --no-dev --working-dir=/var/www/html

echo "Mengoptimalkan cache Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Menjalankan migrasi database..."
php artisan migrate --force