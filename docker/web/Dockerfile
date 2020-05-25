FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
        cron \
        rsyslog \
        curl \
        wget \
        git \
        jq \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxslt-dev \
        libicu-dev \
        libmcrypt-dev \
        libsodium-dev \
        zlib1g-dev \
        libpcre3-dev \
        libcurl4-openssl-dev \
        pkg-config \
        libssl-dev \
        libonig-dev

RUN a2enmod \
        rewrite

RUN ACCEPT_EULA=y \
        DEBIAN_FRONTEND=noninteractive \
        apt-get install --yes \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev

RUN docker-php-ext-configure \
        gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/

RUN docker-php-ext-install \
        gd \
        mbstring \
        mysqli \
        pdo_mysql

RUN pecl install \
        mongodb \
        xdebug

RUN docker-php-ext-enable \
        mongodb

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

#Php.ini
ADD php.ini /usr/local/etc/php
