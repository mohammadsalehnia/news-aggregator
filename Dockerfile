FROM php:8.1-fpm-alpine

RUN set -ex \
    && apk --no-cache add libzip-dev zip unzip freetype-dev libpng-dev libjpeg-turbo-dev nodejs yarn npm autoconf build-base \
    && docker-php-ext-install pdo_mysql zip gd opcache pcntl \
    && pecl install redis \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
