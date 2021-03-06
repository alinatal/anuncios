#!/bin/sh
set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down --message 'La aplicación está siendo (rápidamente!) actualizada. Por favor, intentelo de nuevo en un minuto.') || true
    # Update codebase
#    git fetch origin master
 #   git reset --hard origin/master

    # Install dependencies based on lock file
    #composer install --no-interaction --prefer-dist --optimize-autoloader

    # Migrate database
    #php artisan migrate

    # Note: If you're using queue workers, this is the place to restart them.
    # ...

    # Clear cache
    php artisan optimize

    # Reload PHP to update opcache
    #echo "" | sudo -S service php7.4-fpm reload
    #echo "" | sudo -S service php7.3-fpm reload
# Exit maintenance mode
php artisan up

echo "Application deployed! / Aplicación desplegada!"
