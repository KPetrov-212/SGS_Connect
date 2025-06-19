# Използваме PHP + Apache образ
FROM php:8.2-apache

# Активираме модула mysqli за MySQL свързаност
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql

# Копираме файловете в контейнера
COPY . /var/www/html/

# Даваме правилни права
RUN chown -R www-data:www-data /var/www/html