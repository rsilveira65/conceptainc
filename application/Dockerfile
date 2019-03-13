FROM php:7.1-apache

MAINTAINER Rafael Silveira <me@rsilveira.dev>

ARG UID=1000
ARG environment

ENV APP=/var/www/html
ENV WP_CORE_DIR=$APP

RUN a2enmod rewrite expires

# Copy a new .ini to php conf.d/ folder
COPY ./application.ini /usr/local/etc/php/conf.d/application.ini

RUN apt-get update && apt-get install -y --no-install-recommends \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libmemcached-dev \
  zlib1g-dev \
  vim \
  wget \
  sendmail \
  && apt-get clean; rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
  && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
  && docker-php-ext-install gd pdo_mysql mysqli \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug


COPY ./ $APP/

RUN usermod -u ${UID:-1000} www-data \
  && chown -R www-data:www-data $APP/* \
  && rm $APACHE_CONFDIR/sites-enabled/*

COPY ./apache_conf/$environment/apache.conf $APACHE_CONFDIR/sites-available/apache.conf
RUN a2enmod ssl \
    && a2ensite apache.conf

VOLUME $APP
