#!/bin/bash
# Atajo para ejecutar comandos de Artisan dentro del contenedor de Laravel
podman exec -it laravel_postulantes php artisan "$@"
