#!/bin/bash
echo '### Require code style ###'
composer require --dev squizlabs/php_codesniffer
composer require --dev nunomaduro/larastan
echo

echo '### Install composer ###'
composer install
echo

echo '### Install npm ###'
npm i --legacy-peer-deps
echo

echo '### Build frontend ###'
npm run build
echo

echo '### Generate app key ###'
php artisan key:generate
echo
chmod -R 777 storage
echo
php artisan storage:link
echo
php artisan optimize
echo

php-fpm
