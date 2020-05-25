FROM php:7.4-apache
RUN apt-get update \
 && apt-get install -y zlib1g-dev libicu-dev ssl-cert && docker-php-ext-configure intl && docker-php-ext-install intl \
 && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install xdebug-2.9.5 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=1" >> /usr/local/etc/php/php.ini
RUN a2enmod rewrite
#RUN openssl req -new -x509 -days 12000 -nodes -subj "/C=FR/ST=Denial/L=Paris/O=Dis/CN=localhost" -out /etc/ssl/certs/mailserver.crt -keyout /etc/ssl/private/mailserver.key && chmod 440 /etc/ssl/private/mailserver.key && a2enmod ssl
RUN rm -rf /var/www/html
RUN make-ssl-cert generate-default-snakeoil --force-overwrite
#RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -out /etc/ssl/certs/ssl-cert-snakeoil.pem -keyout /etc/ssl/private/ssl-cert-snakeoil.key -subj "/C=AT/ST=Vienna/L=Vienna/O=Security/OU=Development/CN=localhost" && chmod 440 /etc/ssl/private/ssl-cert-snakeoil.key
RUN a2ensite default-ssl && a2enmod ssl
COPY conf/httpd/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY conf/httpd/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
