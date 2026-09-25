#!/usr/bin/env bash
# ==============================================================================
# Atajo para ejecutar comandos de Artisan dentro del contenedor
# Compatible con Docker y Podman en Ubuntu, Debian, AlmaLinux, Fedora, etc.
# ==============================================================================

set -e

CONTAINER_NAME="laravel_postulantes"

# Determinar si se usa docker o podman
if command -v docker &> /dev/null && docker ps --format '{{.Names}}' 2>/dev/null | grep -qw "$CONTAINER_NAME"; then
    CMD="docker"
elif command -v podman &> /dev/null && podman ps --format '{{.Names}}' 2>/dev/null | grep -qw "$CONTAINER_NAME"; then
    CMD="podman"
elif command -v docker &> /dev/null && docker compose ps --services 2>/dev/null | grep -qw "app"; then
    CMD="docker compose exec app"
fi

if [ -z "${CMD:-}" ]; then
    echo "❌ Error: El contenedor '$CONTAINER_NAME' no está en ejecución."
    echo "Inicia los contenedores con: docker compose up -d"
    exit 1
fi

if [[ "$CMD" == *"compose"* ]]; then
    $CMD php artisan "$@"
else
    # Si la terminal es interactiva (TTY), pasar -it, de lo contrario -i
    if [ -t 0 ] && [ -t 1 ]; then
        $CMD exec -it "$CONTAINER_NAME" php artisan "$@"
    else
        $CMD exec -i "$CONTAINER_NAME" php artisan "$@"
    fi
fi
