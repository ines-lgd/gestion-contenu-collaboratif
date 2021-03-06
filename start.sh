#!/bin/sh

cp .env.docker .env
composer clear-cache
composer dumpa
composer install
npm install
docker cp . symfony-com-web:/var/www/project
docker-compose up --build -d
docker exec -it symfony-com-web bash -c "chmod -R 777 /var/www/project/var/cache/dev && chmod -R 777 /var/www/project/var/log && chmod -R 777 /var/log"
docker cp ./public/index.php symfony-com-web:/var/www/project/public/index.php
