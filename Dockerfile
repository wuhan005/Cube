FROM php:7.3-apache
RUN apt-get update
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
COPY public /var/www/html/public
COPY core /var/www/html/core
WORKDIR /var/www/html
EXPOSE 80