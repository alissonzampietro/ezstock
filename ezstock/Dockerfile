FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring exif pcntl bcmath xml

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ezstock/composer.json /var/www/html
COPY . /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install

RUN chmod +x /var/www/html/ezstock/bin/console

RUN php bin/console lexik:jwt:generate-keypair --skip-if-exists

EXPOSE 9000
CMD ["php-fpm"]
