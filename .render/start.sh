#!/bin/sh
set -e

# Render provides $PORT; fallback to 10000 if missing
: "${PORT:=10000}"

# Ensure nginx/conf.d directory exists
mkdir -p /etc/nginx/conf.d

# Substitute $PORT into nginx template
envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf

# Start PHP-FPM and Nginx using Supervisor or background
php-fpm -D
nginx -g "daemon off;"
