#!/bin/bash
set -e

# Start Laravel Octane in background
php /var/www/artisan octane:start --server=swoole --host=0.0.0.0 --port=8085 &

# Start Supervisor in foreground (this will keep container running)
/usr/bin/supervisord -n
