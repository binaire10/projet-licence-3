FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install xdebug-2.9.5 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
COPY conf/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN rm -rf /var/www/*