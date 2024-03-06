FROM php:fpm
RUN apt-get update && apt-get install -y git unzip libzip-dev
RUN docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer