FROM php:apache

RUN apt-get update && apt-get install nano

WORKDIR /var/www/html

COPY . .

RUN cd services \
    && chown -R www-data:www-data /var/www/html/

EXPOSE 80