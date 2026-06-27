FROM php:8.4-apache

# 1. Instalar extensiones y utilidades necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql intl zip \
    && rm -rf /var/lib/apt/lists/*

# 2. Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# 3. Instalar Composer global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Directorio de trabajo
WORKDIR /var/www/html

# 5. Copiar primero archivos de Composer
COPY composer.json composer.lock ./

# 6. Instalar dependencias sin scripts todavía
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-source \
    --optimize-autoloader \
    --no-scripts

# 7. Copiar el resto del proyecto
COPY . .

# 8. Configurar Apache para servir /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 9. Ejecutar scripts de Laravel ahora que artisan ya existe
RUN php artisan package:discover --ansi

# 10. Publicar assets de Filament y limpiar residuos de cache
# Removidos config:cache y route:cache de manera definitiva para que no rompa Neon DB
RUN php artisan filament:upgrade || true \
    && php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

# 11. Permisos Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
