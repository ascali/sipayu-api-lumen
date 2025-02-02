# Gunakan image PHP yang memiliki extension yang diperlukan
FROM php:8.1-fpm

# Install dependencies (misalnya: git, libpng, libjpeg, dll)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang dibutuhkan oleh Lumen
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

# Install Composer (untuk manajemen dependensi PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory di dalam container
WORKDIR /var/www/html

# Copy seluruh file aplikasi Lumen ke dalam container
COPY . .

# Install dependensi aplikasi (menggunakan Composer)
RUN composer install --no-dev --optimize-autoloader

# Expose port yang digunakan aplikasi (misalnya 8000)
EXPOSE 8000

# Jalankan PHP-FPM
CMD ["php-fpm"]
