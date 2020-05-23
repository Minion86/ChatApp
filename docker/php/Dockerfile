FROM php:7.3-apache

COPY php.ini ./
RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev \
&& docker-php-ext-install pdo_mysql mysqli gd iconv \
&& docker-php-ext-install mbstring 

COPY ./httpd.conf /etc/apache2/sites-available/
COPY ./hosts  /etc/hosts
RUN  a2enmod rewrite
RUN service apache2 restart
WORKDIR /etc/apache2/sites-available
RUN a2ensite httpd.conf