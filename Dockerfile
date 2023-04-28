FROM php:7.3-fpm-alpine

# Install required packages
RUN apk add --no-cache git curl libmcrypt-dev libxml2-dev libpng-dev freetype-dev libjpeg-turbo-dev libzip-dev && \
    docker-php-ext-install pdo_mysql soap gd zip exif bcmath pcntl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install node.js and npm
RUN apk add --no-cache nodejs npm

# Establece las variables de entorno necesarias para la conexión con la base de datos
ENV DB_CONNECTION=mysql
ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=farmacia
ENV DB_USERNAME=root
ENV DB_PASSWORD=delfin23

# Instala el cliente de MySQL y establece las variables de entorno necesarias para el cliente de MySQL
RUN apk update && apk add mysql-client

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install PHP dependencies
RUN composer install --no-dev

# Build assets
RUN npm install && npm run production

# Set file permissions
RUN chown -R www-data:www-data /app && \
    chmod -R 755 /app/storage

# Ejecuta el comando de migración de la base de datos
CMD php artisan migrate

# # Define la imagen base de PHP
# FROM php:7.4-apache

# # Establece el directorio de trabajo en el contenedor
# WORKDIR /var/www/html

# # Copia los archivos del proyecto al contenedor
# COPY . .

# # Actualiza el índice de paquetes y luego instala las dependencias necesarias
# RUN apt-get update && \
#     apt-get install -y --no-install-recommends \
#     git \
#     unzip \
#     libzip-dev \
#     && docker-php-ext-install zip \
#     && pecl install xdebug \
#     && docker-php-ext-enable xdebug \
#     && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
#     && composer install --no-scripts --no-autoloader

# # Copia el archivo de configuración de Apache
# COPY docker/apache2.conf /etc/apache2/sites-available/000-default.conf

# # Habilita el módulo mod_rewrite de Apache
# RUN a2enmod rewrite

# # Establece las variables de entorno necesarias para la conexión con la base de datos
# ENV DB_CONNECTION=mysql
# ENV DB_HOST=db
# ENV DB_PORT=3307
# ENV DB_DATABASE=farmacia
# ENV DB_USERNAME=root
# ENV DB_PASSWORD=delfin23

# # Instala el cliente de MySQL y establece las variables de entorno necesarias para el cliente de MySQL
# RUN apt-get update && \
#     apt-get install -y default-mysql-client && \
#     echo "export MYSQL_PWD=${DB_PASSWORD}" >> /etc/apache2/envvars

# # Expone el puerto 80
# EXPOSE 80

# # Ejecuta el comando de migración de la base de datos
# CMD php artisan migrate && apache2-foreground