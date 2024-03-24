FROM php:7.4-fpm

#COPY php.ini /usr/local/etc/php/

RUN apt update
RUN apt install -y wget git unzip libpq-dev

# Install Node.js 12
RUN apt install -y npm \
  && npm install n -g \
  && n 12

# Install PHP Extensions
RUN apt install -y zlib1g-dev mariadb-client libzip-dev libonig-dev \
  && docker-php-ext-install zip pdo_mysql

# Install php-redis using PECL
RUN pecl install redis && \
    docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
  && mv composer.phar /usr/local/bin/composer \
  && composer self-update

# Install xdebug
#RUN pecl install xdebug \
#  && docker-php-ext-enable xdebug

WORKDIR /var/www

# php-fpm runs with default user www-data. https://stackoverflow.com/questions/48619445/permission-denied-error-using-laravel-docker
# If you want to change it, change the username in /usr/local/etc/php-fpm.d/www.conf.
RUN chown -R www-data:www-data /var/www

RUN composer global require "laravel/installer"
