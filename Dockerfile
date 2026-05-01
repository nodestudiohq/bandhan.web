# ---------- base ----------
FROM php:8.4-fpm

# ---------- install packages ----------
RUN apt-get update && apt-get install -y \
    nginx \
    libicu-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd intl pdo pdo_mysql mysqli zip \
    && docker-php-ext-install intl zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ---------- install composer ----------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------- workdir ----------
WORKDIR /var/www/html

# ---------- copy project ----------
COPY . /var/www/html

# ---------- install dependencies ----------
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# ---------- permissions ----------
RUN mkdir -p writable/cache writable/logs writable/session writable/uploads \
    && chmod -R 777 writable \
    && chown -R www-data:www-data /var/www/html

# ---------- nginx config ----------
COPY nginx.conf /etc/nginx/sites-available/default

# ---------- expose ----------
EXPOSE 80

# ---------- start services ----------
CMD service nginx start && php-fpm