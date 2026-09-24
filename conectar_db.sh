#!/bin/bash
# Script para conectarse a la base de datos PostgreSQL en contenedor
PGPASSWORD=admin psql -h localhost -p 5433 -U admin -d postulantes_db "$@"
