FROM httpd
ADD ./src/ /var/www/html/
RUN apt-get update && apt-get install -y php libapache2-mod-php php-mysql
CMD service apache2 restart && tail -f /var/log/apache2/access.log