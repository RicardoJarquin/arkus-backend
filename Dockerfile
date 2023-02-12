FROM php:8.2-fpm-alpine3.17

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN docker-php-ext-install opcache

COPY ./php-extension/opcache.ini /usr/local/etc/php/conf.d/

COPY ./nginx/server.conf /etc/nginx/conf.d/default.conf
