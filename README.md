<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Build (Required)
1. Clone project
- git clone https://github.com/datquynhvinh/laravelWithDocker.git
- cd /laravelWithDocker
- cp .env.example .env

2. Run docker
- docker-compose build --no-cache
- docker-compose up -d

3. Web
- localhost:8888

## Mysql infomation
- DB_PORT: 3310
- DB Name: laravel_with_docker
- Username: admin
- Password: admin

## Commandline
- docker exec -it Laravel-app bash

## Password Grant Tokens
- php artisan passport:client --password
- generate development to redirect: php artisan serv

## Redis server configuration
- Install: sudo apt-get -y install redis-server
- Check status: sudo service redis-server status
- Or start redis: sudo service redis-server start
- Use command line: redis-cli
- Set a Password: nano /etc/redis/6379.conf => requirepass somePassword
- REDIS_HOST using ipv4
