FROM php:8.4-cli-alpine

# Instalar dependencias del sistema requeridas por Laravel y Composer
RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    git \
    curl \
    unzip \
    bash \
    && docker-php-ext-install pdo pdo_pgsql zip pcntl bcmath

# Instalar Composer oficial desde imagen multi-stage (con registro explícito para compatibilidad con Podman y Docker)
COPY --from=docker.io/library/composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

# Copiar script de arranque automático
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
