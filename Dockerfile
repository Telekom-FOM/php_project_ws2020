FROM httpd
ADD ./src/ /var/www/html/
RUN apt-get update && apt-get install -y php libapache2-mod-php php-mysql 
RUN sed -i 's/"127.0.0.1"/"mariadb"/g' /var/www/html/php_include/db_basic.php
CMD service apache2 restart && tail -f /var/log/apache2/access.log
