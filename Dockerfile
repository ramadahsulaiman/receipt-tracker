# ---------- ASSETS BUILD (Tailwind) ----------
FROM node:20-alpine AS assets
WORKDIR /app

# Install deps
COPY package.json package-lock.json* ./
RUN npm install

# Bring in only what's needed to build CSS
COPY tailwind.config.js postcss.config.js ./
COPY web/css ./web/css
COPY views ./views
COPY vendor/yiisoft/yii2 ./vendor/yiisoft/yii2

# Build CSS
RUN npm run build

# ---------- PHP-FPM ----------
FROM php:8.2-fpm-alpine AS php
WORKDIR /var/www/html

# PHP extensions (pdo_mysql for local, pdo_pgsql for Supabase)
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php

# Copy app
COPY . .

# Copy built CSS from assets stage
COPY --from=assets /app/web/css/site.css /var/www/html/web/css/site.css

# Install PHP deps (no dev for prod image)
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# Optional: set PHP limits for uploads (receipts)
RUN { \
      echo "file_uploads=On"; \
      echo "memory_limit=256M"; \
      echo "upload_max_filesize=20M"; \
      echo "post_max_size=21M"; \
      echo "max_execution_time=120"; \
   } > /usr/local/etc/php/conf.d/uploads.ini

# ---------- NGINX RUNTIME ----------
FROM nginx:alpine
WORKDIR /var/www/html

# Copy app and PHP-FPM runtime from previous stage
COPY --from=php /var/www/html /var/www/html

# Nginx config template + start script
COPY ./.render/nginx.conf.template /etc/nginx/templates/default.conf.template
COPY ./.render/start.sh /start.sh
RUN chmod +x /start.sh

# Nginx expects static root
ENV NGINX_ENVSUBST_OUTPUT_DIR=/etc/nginx/conf.d

# Expose (Render sets $PORT; we still expose 10000 for local test)
EXPOSE 10000

# Start: substitute $PORT into nginx template, run php-fpm + nginx
CMD ["/bin/sh", "/start.sh"]
