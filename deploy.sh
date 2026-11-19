#!/usr/bin/env bash
set -e
cd /var/www/tickets
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
sudo chmod -R 775 storage bootstrap/cache
echo "Deployed."
