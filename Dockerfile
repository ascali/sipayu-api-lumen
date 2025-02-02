# Gunakan image PHP yang memiliki extension yang diperlukan
FROM php:8.1-fpm


USER root


# Set working directory di dalam container
WORKDIR /var/www/html

# Menambahkan user baru dalam container dan mengubah kepemilikan
# RUN useradd -ms /bin/bash lumenuser
# RUN chown -R lumenuser:lumenuser /var
RUN chown -R root:root /var/www/html
# RUN chown -R lumenuser:lumenuser /var/lib/apt/lists 
# RUN chown -R lumenuser:lumenuser /var/cache/apt/archives/partial
# RUN chown -R lumenuser:lumenuser /var/lib/dpkg/lock-frontend

# Install dependencies (misalnya: git, libpng, libjpeg, dll)

# Install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends libpng-dev libjpeg-dev libfreetype6-dev libzip-dev git unzip

# Install ekstensi PHP yang dibutuhkan oleh Lumen
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

# Install Composer (untuk manajemen dependensi PHP)
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy seluruh file aplikasi Lumen ke dalam container
COPY . .


RUN chmod +rwx /var/www

RUN chmod -R 777 /var/www

RUN composer install --prefer-dist --no-interaction

RUN php artisan cache:clear

RUN composer dump-autoload

# Install dependensi aplikasi (menggunakan Composer)  --no-dev --optimize-autoloader
# RUN composer install

# Expose port yang digunakan aplikasi (misalnya 8000)
EXPOSE 8000

# Jalankan PHP-FPM
CMD ["php-fpm"]
