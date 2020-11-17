FROM php:7.3.24-apache-stretch
COPY ./src/* /var/www/html/

CMD service apache2 restart && bash