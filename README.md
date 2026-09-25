# Sistema de Postulantes (SIU - SUNEDU) - UNAP

Sistema backend desarrollado con **Laravel** y **PostgreSQL**, contenedorizado mediante **Docker / Podman** para garantizar compatibilidad y portabilidad total en cualquier sistema operativo (**Windows**, **macOS** o **Linux**).

Contiene la base de datos completa de postulantes con **167,872 registros** cargados, optimizados con índices para consultas en milisegundos.

---

## Arquitectura y Tecnologías

* **Backend:** Laravel (PHP 8.4 CLI con soporte nativo `pdo_pgsql`).
* **Base de Datos:** PostgreSQL 16 (Alpine).
* **Contenedores:** Estándar OCI / Compose V2 (`compose.yaml` y `Dockerfile`).
* **ORM:** Eloquent (`App\Models\Postulante`).

```
┌─────────────────────────────────────────────────────────────┐
│ Máquina Local (Host)                                        │
│                                                             │
│   Código fuente sincronizado en vivo (app/, routes/, etc.)  │
│         │                                                   │
│         ▼                                                   │
│   ┌────────────────────────┐      ┌──────────────────────┐  │
│   │ Contenedor Laravel     │      │ Contenedor Postgres  │  │
│   │ (laravel_postulantes)  │─────▶│(postgres_postulantes)│  │
│   │ Puerto: 8000           │      │ Puerto: 5433         │  │
│   └────────────────────────┘      └──────────────────────┘  │
│                                              │              │
│                                       Volumen persistente   │
│                                       (postgres_data)       │
└─────────────────────────────────────────────────────────────┘
```

---

## Portabilidad (¿Cómo correrlo en cualquier máquina?)

El proyecto utiliza la especificación abierta **Compose Specification** (`compose.yaml`). Funciona idénticamente con **Docker** o con **Podman**:

* En **Windows** o **macOS**: Instalar [Docker Desktop](https://www.docker.com/products/docker-desktop/) y usar comandos `docker compose`.
* En **Linux**: Funciona con `docker compose` o con `podman` (rootless, sin necesidad de permisos `sudo`).

---

## Guía Rápida de Comandos

El sistema cuenta con **auto-inicialización completa**: al encenderlo por primera vez (`up -d --build`), el contenedor se encarga automáticamente de crear el archivo `.env`, instalar las dependencias con Composer (`vendor/`), generar la clave de aplicación `APP_KEY`, esperar la conexión a PostgreSQL, y ejecutar migraciones y seeders de usuarios.

### Opción 1: Con Docker (Ubuntu, Debian, macOS o Windows)

```bash
# 1. Construir imágenes y encender en segundo plano
docker compose up -d --build

# 2. Ver estado de los contenedores
docker compose ps

# 3. Ver logs de Laravel en vivo
docker compose logs -f app

# 4. Ejecutar comandos de Artisan (usando el atajo compatible)
./artisan.sh route:list

# 5. Apagar los contenedores
docker compose down
```

---

### Opción 2: Con Podman (Fedora, AlmaLinux, RHEL o Linux rootless)

```bash
# 1. Construir imágenes y encender en segundo plano
podman compose up -d --build
# (o si ya están creados: podman start postgres_postulantes laravel_postulantes)

# 2. Ver estado de los contenedores
podman ps

# 3. Ver logs de Laravel en vivo
podman logs -f laravel_postulantes

# 4. Ejecutar comandos de Artisan (usando el atajo compatible)
./artisan.sh route:list

# 5. Apagar los contenedores
podman stop laravel_postulantes postgres_postulantes
```

---

## URLs y Accesos

| Servicio | URL / Host | Puerto | Descripción |
| :--- | :--- | :--- | :--- |
| **Aplicación Web** | [http://localhost:8000](http://localhost:8000) | `8000` | Interfaz web principal (redirige a `/login`) |
| **Búsqueda AJAX** | `http://localhost:8000/api/postulantes/buscar` | `8000` | Endpoint JSON paginado |
| **PostgreSQL (Host)**| `localhost` | `5433` | Conexión directa a la BD (usuario: `admin`, clave: `admin`) |

> [!NOTE]
> Se utiliza el puerto **`5433`** hacia el host para no entrar en conflicto con instalaciones locales de PostgreSQL que ya ocupen el puerto por defecto `5432`. Internamente en la red de contenedores se comunican por el puerto estándar `5432`.

---

## Credenciales de Acceso

### 1. Sistema Web (Inicio de Sesión en `/login`)

| Rol | Correo Electrónico | Contraseña | Permisos |
| :--- | :--- | :--- | :--- |
| **Administrador** | `admin@unap.edu.pe` | `admin123` | Acceso total, consultas, exportación y gestión de usuarios |
| **Operador** | `operador@unap.edu.pe` | `operador123` | Consultas, filtros avanzados y exportación a Excel / CSV |

### 2. Base de Datos PostgreSQL

* **Host:** `localhost` (o `postgres_postulantes` dentro de la red Docker)
* **Puerto:** `5433` (desde el host) / `5432` (dentro de los contenedores)
* **Base de datos:** `postulantes_db`
* **Usuario:** `admin`
* **Contraseña:** `admin`

---

## Base de Datos y Persistencia

* **Tabla:** `postulantes` (167,872 registros).
* **Índices de alto rendimiento:**
  * `idx_postulantes_dni` (búsquedas instantáneas por documento de identidad).
  * `idx_postulantes_proceso` (filtros por proceso de admisión ej. 2026-1, 2026-2).
  * `idx_postulantes_programa` (filtros por carrera).
  * `idx_postulantes_postulante` (búsquedas por nombres y apellidos).
  * `idx_postulantes_filial` (filtros por sede / filial).
  * `idx_postulantes_unidad` (filtros por facultad / unidad académica).
  * `idx_postulantes_es_ingresante` (filtros por condición de ingresante).
* **Persistencia:** Gestionada en el volumen `postgres_data`. Los datos no se pierden al apagar los contenedores o reiniciar el servidor.

Para conectarte directamente a la consola SQL de PostgreSQL:
```bash
./conectar_db.sh
```

---

## Importación de Postulantes a PostgreSQL

Para poblar o repoblar la base de datos desde un archivo CSV mediante stream directo (tarda aproximadamente 7 segundos, compatible con Docker y Podman en Ubuntu, AlmaLinux, etc.):

```bash
# Importar el archivo por defecto (postulantes_listado.csv)
./importar_datos.sh

# O especificar otro archivo CSV:
./importar_datos.sh ruta/a/otro_listado.csv
```

---

## Archivos Clave del Proyecto

* [compose.yaml](compose.yaml): Archivo de orquestación de servicios (Laravel + PostgreSQL).
* [Dockerfile](Dockerfile): Imagen PHP 8.4 configurada con Composer y extensiones necesarias.
* [docker-entrypoint.sh](docker-entrypoint.sh): Script de arranque autónomo del contenedor (gestiona `.env`, `composer install`, `APP_KEY`, migraciones y seeders).
* [init_db.sql](init_db.sql): Script DDL con la estructura de tablas e índices.
* [importar_datos.sh](importar_datos.sh): Script para importar el CSV directo a la base de datos en ~7 segundos.
* [.env.example](.env.example): Plantilla de variables de entorno de Laravel.
* [app/Models/Postulante.php](app/Models/Postulante.php): Modelo Eloquent para la tabla de postulantes.
* [routes/web.php](routes/web.php): Definición de rutas web y de autenticación.
* [artisan.sh](artisan.sh): Script auxiliar para ejecutar comandos `artisan` dentro del contenedor (compatible con Docker y Podman).
* [conectar_db.sh](conectar_db.sh): Script auxiliar para entrar a la consola interactiva de PostgreSQL (`psql`).
