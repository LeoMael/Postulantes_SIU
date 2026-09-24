# Sistema de Postulantes (SIU - SUNEDU) - UNAP

Sistema backend desarrollado con **Laravel** y **PostgreSQL**, contenedorizado mediante **Docker / Podman** para garantizar compatibilidad y portabilidad total en cualquier sistema operativo (**Windows**, **macOS** o **Linux**).

Contiene la base de datos completa de postulantes con **167,872 registros** cargados, optimizados con índices para consultas en milisegundos.

---

## 🚀 Arquitectura y Tecnologías

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

## 💻 Portabilidad (¿Cómo correrlo en cualquier máquina?)

El proyecto utiliza la especificación abierta **Compose Specification** (`compose.yaml`). Funciona idénticamente con **Docker** o con **Podman**:

* En **Windows** o **macOS**: Instalar [Docker Desktop](https://www.docker.com/products/docker-desktop/) y usar comandos `docker compose`.
* En **Linux**: Funciona con `docker compose` o con `podman` (rootless, sin necesidad de permisos `sudo`).

---

## 🛠️ Guía Rápida de Comandos

### Opción 1: Con Docker (Windows, macOS o Linux)

```bash
# 1. Construir imágenes y encender en segundo plano
docker compose up -d --build

# 2. Ver estado de los contenedores
docker compose ps

# 3. Ver logs de Laravel en vivo
docker compose logs -f app

# 4. Ejecutar comandos de Laravel Artisan
docker compose exec app php artisan route:list
docker compose exec app php artisan make:controller PostulanteController

# 5. Apagar los contenedores
docker compose down
```

---

### Opción 2: Con Podman (Linux / Fedora)

```bash
# 1. Encender los contenedores existentes
podman start postgres_postulantes laravel_postulantes

# 2. Ver estado de los contenedores
podman ps

# 3. Ver logs de Laravel en vivo
podman logs -f laravel_postulantes

# 4. Ejecutar comandos de Artisan (usando el atajo)
./artisan.sh route:list
./artisan.sh make:controller PostulanteController

# 5. Apagar los contenedores
podman stop laravel_postulantes postgres_postulantes
```

---

## 🌐 URLs y Accesos

| Servicio | URL / Host | Credenciales / Puerto |
| :--- | :--- | :--- |
| **Laravel App** | [http://localhost:8000](http://localhost:8000) | Puerto `8000` |
| **API Postulantes** | [http://localhost:8000/postulantes](http://localhost:8000/postulantes) | JSON paginado |
| **PostgreSQL (Host)**| `localhost` | Puerto `5433` (BD: `postulantes_db`, Usuario: `admin`, Clave: `admin`) |

> [!NOTE]
> Se utiliza el puerto **`5433`** hacia el host para no entrar en conflicto con instalaciones locales de PostgreSQL que ya ocupen el puerto por defecto `5432`. Internamente en la red de contenedores se comunican por el puerto estándar `5432`.

---

## 📡 Endpoints de Prueba

Puedes probar las rutas directamente en el navegador o mediante `curl`:

#### 1. Listado general de postulantes (paginado a 20 registros):
```bash
curl -s "http://localhost:8000/postulantes"
```

#### 2. Búsqueda por DNI:
```bash
curl -s "http://localhost:8000/postulantes?dni=60746497"
```

#### 3. Filtro por carrera o programa académico:
```bash
curl -s "http://localhost:8000/postulantes?programa=Sistemas"
```

---

## 🗄️ Base de Datos y Persistencia

* **Tabla:** `postulantes` (167,872 registros provenientes de `postulantes_listado.csv`).
* **Índices de alto rendimiento:**
  * `idx_postulantes_dni` (búsquedas instantáneas por documento de identidad).
  * `idx_postulantes_proceso` (filtros por proceso de admisión ej. 2026-1, 2026-2).
  * `idx_postulantes_programa` (filtros por carrera).
  * `idx_postulantes_postulante` (búsquedas por nombres y apellidos).
* **Persistencia:** Gestionada en el volumen `postgres_data`. **Los datos nunca se pierden al apagar los contenedores o reiniciar la computadora.**

Para conectarte directamente a la consola SQL de PostgreSQL:
```bash
./conectar_db.sh
```

---

## 📁 Archivos Clave del Proyecto

* [compose.yaml](compose.yaml): Archivo de orquestación de servicios (Laravel + PostgreSQL).
* [Dockerfile](Dockerfile): Imagen PHP 8.4 configurada con la extensión PostgreSQL `pdo_pgsql`.
* [init_db.sql](init_db.sql): Script DDL con la estructura de tablas e índices.
* [.env.example](.env.example): Plantilla de variables de entorno de Laravel configuradas para la conexión de base de datos.
* [app/Models/Postulante.php](app/Models/Postulante.php): Modelo Eloquent para interactuar con la tabla de postulantes.
* [routes/web.php](routes/web.php): Rutas HTTP donde está configurado el endpoint de consulta.
* [artisan.sh](artisan.sh): Script auxiliar para ejecutar comandos `artisan` dentro del contenedor.
* [conectar_db.sh](conectar_db.sh): Script auxiliar para entrar a la consola interactiva de PostgreSQL (`psql`).
