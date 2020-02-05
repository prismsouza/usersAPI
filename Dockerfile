FROM php:7.4-apache

LABEL maintainer="Bruce E. Sueira"

RUN mkdir -p /var/www/html/public

COPY .docker/php/php.ini /usr/local/etc/php/
COPY .docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/php/xdebug-dev.ini /usr/local/etc/php/conf.d/xdebug-dev.ini

RUN docker-php-ext-install pdo_mysql bcmath && \
    docker-php-ext-install opcache && \
    apt-get update && \
    apt-get install libldap2-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

RUN pecl install xdebug-2.9.1
RUN docker-php-ext-enable xdebug
RUN a2enmod rewrite negotiation

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/html

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

RUN php composer-setup.php

RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

# Install GD, Imagick and ImageMagick as image conversion options:
RUN DEBIAN_FRONTEND=noninteractive \
  apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libmagickwand-dev \
    imagemagick \
  && pecl install \
    imagick \
  && docker-php-ext-enable \
    imagick \
  && docker-php-ext-configure \
    gd --with-jpeg=/usr/include/ \
  && docker-php-ext-install \
    gd \
  # Uninstall obsolete packages:
  && apt-get autoremove -y \
    libpng-dev \
    libjpeg-dev \
    libmagickwand-dev \
  # Remove obsolete files:
  && apt-get clean \
  && rm -rf \
    /tmp/* \
    /usr/share/doc/* \
    /var/cache/* \
    /var/lib/apt/lists/* \
    /var/tmp/*
