# Imagen base: PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para PostgreSQL y PDO
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Activar mod_rewrite (opcional pero útil)
RUN a2enmod rewrite

# Copiar el código fuente al directorio de Apache
COPY . /var/www/html/

# Establecer permisos correctos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80

