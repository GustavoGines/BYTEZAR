# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Habilita mod_rewrite por si usás URLs amigables
RUN a2enmod rewrite

# Habilitar PDO PostgreSQL
RUN docker-php-ext-install pdo_pgsql

# Copia todo tu proyecto al directorio raíz de Apache
COPY . /var/www/html/

# Establece permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expone el puerto 80 (usado por Apache)
EXPOSE 80
