FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
        cron \
        curl \
        git \
        jq \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libonig-dev \
        libpcre3-dev \
        libsodium-dev \
        libssl-dev \
        libxslt-dev \
        pkg-config \
        rsyslog \
        wget \
        zlib1g-dev \
    && a2enmod \
        rewrite

RUN ACCEPT_EULA=y \
        DEBIAN_FRONTEND=noninteractive \
        apt-get install --yes \
        ffmpeg \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure \
        gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
    && docker-php-ext-install \
        gd \
        mbstring \
        mysqli \
        pdo_mysql \
    && pecl install \
        mongodb \
        xdebug \
    && docker-php-ext-enable \
        mongodb

#Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

#Php.ini
ADD php.ini /usr/local/etc/php
