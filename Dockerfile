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

# 3. Optimizar el límite de memoria interna de PHP en Apache
# Esto le da un límite seguro a los scripts dentro de Render
RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory-limit.ini

# 4. Instalar Composer global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Directorio de trabajo
WORKDIR /var/www/html

# 6. Copiar primero archivos de Composer
COPY composer.json composer.lock ./

# 7. CAMBIO CLAVE: Instalar dependencias optimizadas sin usar Git (--prefer-dist)
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# 8. Copiar el resto del proyecto
COPY . .

# 9. Configurar Apache para servir /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 10. Ejecutar scripts de Laravel ahora que artisan ya existe
RUN php artisan package:discover --ansi

# 11. Publicar assets de Filament y limpiar residuos de cache
# Agregada optimización de vistas que reduce lecturas de disco y uso de RAM
RUN php artisan filament:upgrade || true \
    && php artisan config:clear || true \
    && php artisan cache:clear || true \
    && php artisan route:clear || true \
    && php artisan view:cache || true

# 12. Permisos Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
