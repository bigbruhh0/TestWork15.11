FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

COPY php.ini /usr/local/etc/php/

WORKDIR /var/www/html
