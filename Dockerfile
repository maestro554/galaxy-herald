FROM php:8.2-apache

# Установим расширения для MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Копируем проект в контейнер
COPY . /var/www/html/

# Настроим права
RUN chown -R www-data:www-data /var/www/html
