FROM php:8.0-fpm

RUN apt-get update && \
    apt-get install -y libpq-dev libzip-dev git supervisor libxml2-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip soap mysqli pdo_mysql

RUN apt-get update && apt-get install -y libpng-dev

RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
    -with-webp \
    -with-jpeg \
    -with-xpm \
    -with-freetype

RUN docker-php-ext-install gd

RUN pecl install xdebug; \
        docker-php-ext-enable xdebug;

ADD xdebug.ini /usr/local/etc/php/conf.d/custom-xdebug.ini

RUN curl -sSL https://getcomposer.org/installer --insecure | php \
    && mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install -y cron procps nano

RUN apt-get install -y nodejs npm
