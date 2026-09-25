#!/usr/bin/env bash
# ==============================================================================
# Conectarse a la consola interactiva psql de PostgreSQL
# Compatible con Docker y Podman (no requiere psql instalado en el host)
# ==============================================================================

set -e

CONTAINER_NAME="postgres_postulantes"

if command -v docker &> /dev/null && docker ps --format '{{.Names}}' 2>/dev/null | grep -qw "$CONTAINER_NAME"; then
    docker exec -it "$CONTAINER_NAME" psql -U admin -d postulantes_db "$@"
elif command -v podman &> /dev/null && podman ps --format '{{.Names}}' 2>/dev/null | grep -qw "$CONTAINER_NAME"; then
    podman exec -it "$CONTAINER_NAME" psql -U admin -d postulantes_db "$@"
elif command -v psql &> /dev/null; then
    PGPASSWORD=admin psql -h localhost -p 5433 -U admin -d postulantes_db "$@"
else
    echo "❌ Error: No se encontró el contenedor '$CONTAINER_NAME' ni el comando local 'psql'."
    echo "Inicia el contenedor con: docker compose up -d"
    exit 1
fi
