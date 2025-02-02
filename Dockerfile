# Menggunakan image PHP 8.1 CLI
FROM php:8.1-cli

# Set working directory
WORKDIR /var/www/html

# Install dependencies sistem
RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip libssl-dev libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip openssl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy aplikasi ke container
COPY . .

# Install dependensi Composer (tanpa dev dependencies)
RUN composer install --no-dev --optimize-autoloader

# Set permissions untuk storage dan cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80 (HTTP) dan 443 (HTTPS)
EXPOSE 80
EXPOSE 443

# Set environment variables
ENV APP_ENV=local
ENV APP_DEBUG=true
ENV APP_URL=http://localhost

# Start Lumen server menggunakan PHP built-in web server
CMD ["php", "-S", "0.0.0.0:80"]