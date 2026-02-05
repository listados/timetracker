#!/bin/sh
set -e

cd /var/www

# Gerar caches do Laravel (apenas se artisan existir)
if [ -f artisan ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Iniciar PHP-FPM
exec php-fpm
