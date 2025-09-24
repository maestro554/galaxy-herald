# Используем стабильный официальный образ PHP с Apache
FROM php:8.2

# Устанавливаем расширения для работы с MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Копируем проект в корень Apache
COPY . /var/www/html/

# Даем права Apache на файлы
RUN chown -R www-data:www-data /var/www/html

# Включаем mod_rewrite для ЧПУ, если нужно
RUN a2enmod rewrite

# Подавляем предупреждение ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Открываем порт 80
EXPOSE 80
