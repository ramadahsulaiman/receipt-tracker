# ──────────────
# 1️⃣ Build Tailwind assets
# ──────────────
FROM node:20-alpine AS assets
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY tailwind.config.js postcss.config.js ./
COPY web/css ./web/css
RUN npm run build
# ⬆️ Generates web/css/site.css using your Tailwind config

# ──────────────
# 2️⃣ PHP runtime (build app + deps)
# ──────────────
FROM php:8.2-fpm-alpine AS php
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    libpq \
    postgresql-dev \
    mysql-dev

# Install PHP extensions (PDO for MySQL & Postgres)
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy Yii2 source
COPY . .

# Copy built Tailwind CSS from the first stage
COPY --from=assets /app/web/css/site.css /var/www/html/web/css/site.css

# Install PHP dependencies (Yii2 etc.)
RUN composer install --no-dev --optimize-autoloader

# ──────────────
# 3️⃣ Final runtime (PHP + Nginx together)
# ──────────────
FROM php:8.2-fpm-alpine

# Install Nginx
RUN apk add --no-cache nginx

# Copy app built in PHP stage
COPY --from=php /var/www/html /var/www/html

# Remove default nginx configs and add our own
RUN rm -rf /etc/nginx/http.d/* /etc/nginx/conf.d/*
COPY ./.render/nginx.conf /etc/nginx/http.d/default.conf

# Ensure runtime and assets folders exist and writable
RUN mkdir -p /var/www/html/runtime /var/www/html/web/assets \
    && chmod -R 777 /var/www/html/runtime /var/www/html/web/assets

WORKDIR /var/www/html
EXPOSE 10000

# Start both services
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"

# Debug: show PHP modules at startup (for free-tier log visibility)
RUN echo "php -m" > /start.sh && \
    echo "php -m" >> /start.sh && \
    echo "php -i | grep 'PDO support'" >> /start.sh && \
    echo "php -r \"echo 'Render PHP build ready.';\"" >> /start.sh && \
    chmod +x /start.sh

CMD ["sh", "-c", "php -m && php -r 'echo \"\\nRender container ready.\";' && php-fpm -D && nginx -g 'daemon off;'"]

