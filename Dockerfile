# Use official frankenPHP image 
FROM dunglas/frankenphp:php8.2

USER root

# Install required extensions, OpenSSL, and Certbot
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    cron \
    certbot \
    python3-certbot-apache \
    msmtp \
    msmtp-mta \
    openssl \
    ca-certificates \
    && update-ca-certificates \
    && docker-php-ext-install pdo pdo_pgsql \
    && pecl install mailparse \
    && docker-php-ext-enable mailparse \
    # gd
    && apt-get install -y build-essential nginx openssl libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev  \
    && docker-php-ext-configure gd  \
    && docker-php-ext-install gd \
    # gmp
    && apt-get install -y --no-install-recommends libgmp-dev \
    && docker-php-ext-install gmp \
    # pdo_mysql
    # && docker-php-ext-install pdo_mysql mbstring \
    && docker-php-ext-install mbstring \
    # pdo
    && docker-php-ext-install pdo \
    # opcache
    && docker-php-ext-enable opcache \
    # exif
    && docker-php-ext-install exif \
    && docker-php-ext-install sockets \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
    # zip
    && docker-php-ext-install zip \
    && apt-get autoclean -y \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/pear/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Copy PHP configuration file for SMTP
COPY php.ini /usr/local/etc/php/conf.d/php.ini

# Environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false

# EXPOSE 9090/tcp
ENTRYPOINT ["frankenphp", "run", "-c", "caddy/Caddyfile"]
