# Use official PHP image with Apache
FROM php:8.2-apache

USER root

# Install required extensions and Certbot
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    cron \ 
    # Install cron
    certbot \ 
    # Install Certbot
    python3-certbot-apache \ 
    # Certbot plugin for Apache
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

# Configure Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite ssl # Enable SSL module

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Copy auto-renew script
COPY renew-certs.sh /usr/local/bin/renew-certs.sh
RUN chmod +x /usr/local/bin/renew-certs.sh

# Add cron job for auto-renew
RUN echo "0 0 * * * /usr/local/bin/renew-certs.sh" | crontab -

# Environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false