FROM php:8-fpm

RUN apt-get update

# Install PDO and MariaDB Drivers
RUN apt-get install -y mariadb-client libmariadb-dev \
  && docker-php-ext-install pdo_mysql