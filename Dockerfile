# ---------- ASSETS BUILD (Tailwind) ----------
FROM node:20-alpine AS assets
WORKDIR /var/www/html

# Install envsubst (from gettext)
RUN apk add --no-cache gettext

# Install deps for Tailwind + DaisyUI
COPY package.json package-lock.json* ./
RUN npm install

# Copy required Tailwind sources
COPY tailwind.config.js postcss.config.js ./
COPY web/css ./web/css
COPY views ./views
# COPY widgets ./widgets
# COPY components ./components

# Build CSS
RUN npm run build

# ---------- PHP-FPM ----------
FROM php:8.2-fpm-alpine AS php
WORKDIR /var/www/html

# Install PHP extensions
# RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql
    
# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php

# Copy app source code
COPY . .

# Copy built CSS from assets stage
COPY --from=assets /app/web/css/site.css /var/www/html/web/css/site.css

# Install PHP dependencies (no dev)
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# PHP upload limits
RUN { \
      echo "file_uploads=On"; \
      echo "memory_limit=256M"; \
      echo "upload_max_filesize=20M"; \
      echo "post_max_size=21M"; \
      echo "max_execution_time=120"; \
   } > /usr/local/etc/php/conf.d/uploads.ini

# ---------- FINAL IMAGE (Nginx + PHP-FPM in one container) ----------
FROM php:8.2-fpm-alpine

# Install Nginx + PostgreSQL dev libs
RUN apk add --no-cache nginx supervisor postgresql-dev

# Setup working directory
WORKDIR /var/www/html

# Copy app from PHP stage
COPY --from=php /var/www/html /var/www/html

# Copy nginx + startup config
COPY --from=php /var/www/html /var/www/html
COPY ./.render/nginx.conf.template /etc/nginx/templates/default.conf.template
COPY ./.render/start.sh /start.sh
RUN chmod +x /start.sh

# Expose Render port
EXPOSE 10000

# Start both services (Nginx + PHP-FPM)
CMD ["/bin/sh", "/start.sh"]
