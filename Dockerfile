FROM php:7.3-apache


RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev \
&& docker-php-ext-install pdo_mysql mysqli gd iconv \
&& docker-php-ext-install mbstring 

MAINTAINER Nelson Martinez

COPY . /srv/app
COPY docker/php/httpd-vhosts.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app \
    && a2enmod rewrite