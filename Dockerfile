FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
