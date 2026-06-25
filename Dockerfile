FROM php:8.4-apache

# 1. Instalar extensiones de PostgreSQL, intl, zip y utilidades del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql intl zip \
    && rm -rf /var/lib/apt/lists/*

# 2. Habilitar mod_rewrite de Apache para las rutas de Laravel
RUN a2enmod rewrite

# 3. Instalar Composer de forma global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configurar el directorio de trabajo y copiar el código
WORKDIR /var/www/html
COPY . .

# 5. Redirigir el servidor Apache a la carpeta public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 6. Instalar dependencias Composer
RUN composer install --no-interaction --optimize-autoloader

# 7. Asignar permisos requeridos a las carpetas de caché
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# 8. Al arrancar, enciende Apache directamente de forma segura
CMD ["apache2-foreground"]