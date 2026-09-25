#!/usr/bin/env bash
# ==============================================================================
# Script de Importación Directa de Postulantes a PostgreSQL
# Compatible con: Ubuntu, Debian, AlmaLinux, Rocky Linux, Fedora, macOS y Windows (WSL/Git Bash)
# Soporta: Docker y Podman
# ==============================================================================

set -euo pipefail

# Archivo CSV por parámetro o por defecto
CSV_FILE="${1:-postulantes_listado.csv}"

# Colores de salida
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # Sin color

echo -e "${BLUE}======================================================${NC}"
echo -e "${BLUE}   UNAP - Importación de Postulantes a PostgreSQL     ${NC}"
echo -e "${BLUE}======================================================${NC}"

# 1. Validar existencia del archivo CSV
if [ ! -f "$CSV_FILE" ]; then
    echo -e "${RED}❌ Error: No se encontró el archivo '$CSV_FILE'.${NC}"
    echo -e "${YELLOW}Uso: $0 [ruta/al/archivo.csv]${NC}"
    echo -e "Asegúrate de copiar tu archivo CSV al servidor o directorio del proyecto."
    exit 1
fi

FILE_SIZE=$(ls -lh "$CSV_FILE" | awk '{print $5}')
echo -e "📄 Archivo seleccionado: ${YELLOW}$CSV_FILE${NC} (${FILE_SIZE})"

# 2. Detectar motor de contenedores (Docker o Podman)
CONTAINER_CMD=""
CONTAINER_NAME="postgres_postulantes"

if command -v docker &> /dev/null && docker ps --format '{{.Names}}' 2>/dev/null | grep -qw "$CONTAINER_NAME"; then
    CONTAINER_CMD="docker"
elif command -v podman &> /dev/null && podman ps --format '{{.Names}}' 2>/dev/null | grep -qw "$CONTAINER_NAME"; then
    CONTAINER_CMD="podman"
elif command -v docker &> /dev/null && docker compose ps --services 2>/dev/null | grep -qw "postgres"; then
    CONTAINER_CMD="docker compose exec -T postgres"
fi

if [ -z "$CONTAINER_CMD" ]; then
    echo -e "${RED}❌ Error: No se encontró el contenedor '$CONTAINER_NAME' en ejecución.${NC}"
    echo -e "${YELLOW}Verifica que tus contenedores estén encendidos con:${NC}"
    echo -e "   docker compose up -d   (o: podman start $CONTAINER_NAME)"
    exit 1
fi

echo -e "🐳 Motor de contenedores detectado: ${GREEN}$CONTAINER_CMD${NC}"

# 3. Leer credenciales (por defecto las de compose.yaml o .env)
DB_USER="admin"
DB_NAME="postulantes_db"

if [ -f ".env" ]; then
    ENV_USER=$(grep -E '^DB_USERNAME=' .env | cut -d '=' -f2- | tr -d ' "' || true)
    ENV_DB=$(grep -E '^DB_DATABASE=' .env | cut -d '=' -f2- | tr -d ' "' || true)
    [ -n "$ENV_USER" ] && DB_USER="$ENV_USER"
    [ -n "$ENV_DB" ] && DB_NAME="$ENV_DB"
fi

# 4. Confirmación e inicio
echo -e "⏳ Truncando tabla 'postulantes' e importando datos vía stream nativo..."
START_TIME=$(date +%s)

# Ejecución del stream COPY directo hacia psql dentro del contenedor
if [[ "$CONTAINER_CMD" == *"compose"* ]]; then
    $CONTAINER_CMD psql -U "$DB_USER" -d "$DB_NAME" -v ON_ERROR_STOP=1 \
        -c "TRUNCATE TABLE postulantes;" \
        -c "\copy postulantes FROM STDIN WITH (FORMAT csv, HEADER true, ENCODING 'UTF8')" \
        < "$CSV_FILE"
else
    $CONTAINER_CMD exec -i "$CONTAINER_NAME" psql -U "$DB_USER" -d "$DB_NAME" -v ON_ERROR_STOP=1 \
        -c "TRUNCATE TABLE postulantes;" \
        -c "\copy postulantes FROM STDIN WITH (FORMAT csv, HEADER true, ENCODING 'UTF8')" \
        < "$CSV_FILE"
fi

END_TIME=$(date +%s)
DURATION=$((END_TIME - START_TIME))

# 5. Obtener total de filas importadas
if [[ "$CONTAINER_CMD" == *"compose"* ]]; then
    TOTAL_ROWS=$($CONTAINER_CMD psql -U "$DB_USER" -d "$DB_NAME" -t -c "SELECT count(*) FROM postulantes;" | tr -d ' ')
else
    TOTAL_ROWS=$($CONTAINER_CMD exec -i "$CONTAINER_NAME" psql -U "$DB_USER" -d "$DB_NAME" -t -c "SELECT count(*) FROM postulantes;" | tr -d ' ')
fi

echo -e "${GREEN}======================================================${NC}"
echo -e "${GREEN}✅ ¡Importación completada con éxito!${NC}"
echo -e "⏱️  Tiempo transcurrido : ${YELLOW}${DURATION} segundos${NC}"
echo -e "📊 Registros en la BD  : ${YELLOW}${TOTAL_ROWS}${NC}"
echo -e "${GREEN}======================================================${NC}"
