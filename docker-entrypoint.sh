#!/bin/sh
set -e

# 1. Asegurar archivo .env
if [ ! -f /var/www/html/.env ]; then
    echo "⚙️  Archivo .env no encontrado. Creando a partir de .env.example..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# 2. Instalar dependencias de Composer si falta vendor
if [ ! -f /var/www/html/vendor/autoload.php ]; then
    echo "📦 Directorio 'vendor' no encontrado. Instalando dependencias con Composer..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# 3. Generar APP_KEY si está vacía
if ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    echo "🔑 Generando clave de aplicación (APP_KEY)..."
    php artisan key:generate --force
fi

# 4. Esperar a que la base de datos PostgreSQL esté lista para recibir conexiones
DB_HOST="${DB_HOST:-postgres_postulantes}"
DB_PORT="${DB_PORT:-5432}"
DB_DATABASE="${DB_DATABASE:-postulantes_db}"
DB_USERNAME="${DB_USERNAME:-admin}"
DB_PASSWORD="${DB_PASSWORD:-admin}"

MAX_TRIES=30
COUNT=0
until php -r "try { new PDO('pgsql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); exit(0); } catch (Exception \$e) { exit(1); }" 2>/dev/null; do
    COUNT=$((COUNT + 1))
    if [ $COUNT -ge $MAX_TRIES ]; then
        echo "⚠️  Aviso: Tiempo límite esperando a PostgreSQL (${DB_HOST}:${DB_PORT})."
        break
    fi
    sleep 1
done

# 5. Ejecutar migraciones y seeders automáticamente
if php -r "try { new PDO('pgsql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}'); exit(0); } catch (Exception \$e) { exit(1); }" 2>/dev/null; then
    echo "🔄 Ejecutando migraciones..."
    php artisan migrate --force --isolated
    echo "🌱 Ejecutando seeders de usuarios..."
    php artisan db:seed --force
fi

echo "🚀 Iniciando servidor..."
exec "$@"
