FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Копируем весь проект в DocumentRoot
COPY . /var/www/html/

# Даем права Apache
RUN chown -R www-data:www-data /var/www/html

# Включаем mod_rewrite, если нужны ЧПУ
RUN a2enmod rewrite
