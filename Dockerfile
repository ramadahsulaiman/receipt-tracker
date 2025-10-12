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
# ⬆️ This will generate web/css/site.css using your Tailwind config

# ──────────────
# 2️⃣ PHP runtime
# ──────────────
FROM php:8.2-fpm-alpine AS php
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    libpq \
    postgresql-dev \
    mysql-dev
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy your Yii2 app source
COPY . .

# Copy built Tailwind CSS from first stage
COPY --from=assets /app/web/css/site.css /var/www/html/web/css/site.css

# Install PHP dependencies (this downloads Yii2 etc.)
RUN composer install --no-dev --optimize-autoloader
# 🔧 If your composer.json is in a subfolder (e.g., /src), update path accordingly

# ──────────────
# 3️⃣ Nginx runtime
# ──────────────
FROM nginx:alpine
COPY --from=php /var/www/html /var/www/html
COPY ./.render/nginx.conf /etc/nginx/conf.d/default.conf
# 🔧 Make sure you have this nginx.conf inside a folder named `.render`

WORKDIR /var/www/html
EXPOSE 10000

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
