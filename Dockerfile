FROM php:7.3.24-apache-stretch
ADD ./src/ /var/www/html/

CMD service apache2 restart && tail -f /var/log/apache2/access.log