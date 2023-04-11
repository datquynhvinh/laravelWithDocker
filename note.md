## Redis server configuration
- Install: sudo apt-get -y install redis-server
- Check status: sudo service redis-server status
- Or start redis: sudo service redis-server start
- Use command line: redis-cli
- Set a Password: nano /etc/redis/6379.conf => requirepass somePassword
- REDIS_HOST using ipv4

## Change directory permissions
- sudo chown -R $USER:www-data storage
- sudo chown -R $USER:www-data bootstrap/cache

## Error handling 502 bad gateway
- /usr/bin/php -S 0.0.0.0:9000
- telnet app 9000

## Install channel chat realtime
- php artisan serve
- npm run watch (open in another terminal tab)
- php artisan queue:work (open in another terminal tab)
- laravel-echo-server start (open in another terminal tab)
