# Gunakan image PHP yang memiliki extension yang diperlukan
# FROM php:8.1-fpm
FROM php:8.1


USER root

ARG ENV_BASE64
ARG NODE_VERSION=16.13.0

# Set working directory di dalam container
WORKDIR /var/www

# Menambahkan user baru dalam container dan mengubah kepemilikan
# RUN useradd -ms /bin/bash lumenuser
# RUN chown -R lumenuser:lumenuser /var
RUN chown -R root:root /var/www
# RUN chown -R lumenuser:lumenuser /var/lib/apt/lists 
# RUN chown -R lumenuser:lumenuser /var/cache/apt/archives/partial
# RUN chown -R lumenuser:lumenuser /var/lib/dpkg/lock-frontend

# Install dependencies (misalnya: git, libpng, libjpeg, dll)


RUN apt-get update && apt install -y curl

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"

# Install environment dependencies
RUN apt-get update \
        # gd
        && apt-get install -y build-essential nginx openssl libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev zlib1g-dev libzip-dev gcc g++ make vim unzip curl git jpegoptim optipng pngquant gifsicle locales libonig-dev  \
        && docker-php-ext-configure gd  \
        && docker-php-ext-install gd \

        # gmp
        && apt-get install -y --no-install-recommends libgmp-dev \
        && docker-php-ext-install gmp \
        # pdo_mysql
        && docker-php-ext-install pdo_mysql mbstring \
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

# INSTALL PGSQL
RUN apt-get update \
    && apt-get install -y libpq5 libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get autoremove --purge -y libpq-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install Composer (untuk manajemen dependensi PHP)
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setel COMPOSER_ALLOW_SUPERUSER untuk memungkinkan Composer berjalan dengan hak akses root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy seluruh file aplikasi Lumen ke dalam container
COPY . .


RUN chmod +rwx /var/www

RUN chmod -R 777 /var/www

RUN echo -n $ENV_BASE64 | base64 --decode >> /var/www/.env

RUN composer install --prefer-dist --no-interaction
RUN composer update

RUN php artisan cache:clear

RUN composer dump-autoload

# Install dependensi aplikasi (menggunakan Composer)  --no-dev --optimize-autoloader
# RUN composer install

# Expose port yang digunakan aplikasi (misalnya 8000)
# EXPOSE 8000

# Jalankan PHP-FPM
# CMD ["php-fpm"]

EXPOSE 80

RUN npm install --global pm2

# CMD ["sh", "-c", "pm2 start artisan --name app --interpreter php -- serve --host=0.0.0.0 --port=8000 && nginx"]
CMD ["sh", "-c", "pm2 start 'php -S 0.0.0.0:8000 -t public' --name app && nginx -g 'daemon off;'"]

