FROM composer:2 AS composer

WORKDIR /app

# Copiar composer.json y composer.lock
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

FROM php:7.3-apache

USER root

# Configuración de Apache
RUN echo "ServerName 127.0.0.1" >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Instalar extensiones requeridas y otras herramientas necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libpq-dev \
    unzip \
    zip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_pgsql pgsql bcmath \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copiar el proyecto Laravel al contenedor
COPY --chown=www-data:www-data . /var/www/html
COPY --from=composer /app/vendor /var/www/html/vendor

# Configurar permisos para carpetas críticas
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache \
    && touch /var/www/html/storage/logs/laravel.log \
    && chown www-data:www-data /var/www/html/storage/logs/laravel.log

# Configuración de zona horaria
RUN ln -sf /usr/share/zoneinfo/America/Asuncion /etc/localtime

# Configurar Apache
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
