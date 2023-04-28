#!/bin/bash

composer self-update
composer install

php artisan migrate --force
php artisan db:seed --force
# php artisan optimize

chgrp www-data -R storage/
chmod 664 storage/logs/*

./vendor/bin/pint

apache2-foreground