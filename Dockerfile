FROM php:8.4-cli-alpine

RUN apk add --no-cache postgresql-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

WORKDIR /var/www/html

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
