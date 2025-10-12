#!/bin/sh
set -e

# Render provides $PORT; fall back to 10000 if absent (local runs)
: "${PORT:=10000}"

# Generate nginx conf from template with $PORT
envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf

# Start PHP-FPM in background, then Nginx in foreground
php-fpm -D
nginx -g 'daemon off;'
