# ---------- ASSETS BUILD (Tailwind) ----------
FROM node:20-alpine AS assets
WORKDIR /app

# Install deps
COPY package.json package-lock.json* ./
RUN npm install

# Copy Tailwind configs
COPY tailwind.config.js postcss.config.js ./

# Copy source files (make sure folder exists)
RUN mkdir -p web/css
COPY web/css ./web/css
COPY views ./views

# Optional — only if Yii2 vendor widgets are needed for Tailwind scanning
RUN mkdir -p vendor/yiisoft/yii2
COPY vendor/yiisoft/yii2 ./vendor/yiisoft/yii2

# Build CSS (this creates /app/web/css/site.css)
RUN npm run build || (echo "Tailwind build failed" && exit 1)

# Verify output exists (for debugging)
RUN ls -l web/css

# ---------- PHP-FPM ----------
FROM php:8.2-fpm-alpine AS php
WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer && rm composer-setup.php

COPY . .

# Copy compiled CSS from assets stage
COPY --from=assets /app/web/css/site.css /var/www/html/web/css/site.css

RUN composer install --no-dev --optimize-autoloader

# ---------- NGINX ----------
FROM nginx:alpine
WORKDIR /var/www/html

# Add envsubst
RUN apk add --no-cache gettext

# Copy files
COPY --from=php /var/www/html /var/www/html
COPY ./.render/nginx.conf.template /etc/nginx/templates/default.conf.template
COPY ./.render/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 10000

CMD ["/bin/sh", "/start.sh"]
