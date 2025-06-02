#!/bin/bash

echo "Estableciendo permisos a storage y bootstrap/cache..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Ejecuta PHP-FPM
exec php-fpm
