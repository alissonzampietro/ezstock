FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    libxml2-dev \
    librabbitmq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip mbstring exif pcntl bcmath xml \
    && pecl install amqp \
    && docker-php-ext-enable amqp

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY ezstock/. /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install

RUN chmod +x /var/www/html/bin/console

RUN php bin/console lexik:jwt:generate-keypair --skip-if-exists

EXPOSE 9000
CMD ["php-fpm"]
