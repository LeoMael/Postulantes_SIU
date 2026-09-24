-- Script de inicialización para Sistema de Postulantes (SIU - SUNEDU) con soporte para PostgREST

-- Crear rol anónimo para consultas vía PostgREST
DO $$
BEGIN
   IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'web_anon') THEN
      CREATE ROLE web_anon NOLOGIN;
   END IF;
END
$$;

GRANT USAGE ON SCHEMA public TO web_anon;

-- Crear tabla postulantes
CREATE TABLE IF NOT EXISTS postulantes (
    id_postulante BIGINT PRIMARY KEY,
    guid UUID,
    row_num INT,
    id_entidad INT,
    entidad VARCHAR(255),
    id_filial INT,
    filial VARCHAR(100),
    id_nivel_academico INT,
    nivel_academico VARCHAR(100),
    tipo_proceso VARCHAR(50),
    proceso_admision VARCHAR(50),
    numero_convocatoria INT,
    fecha_convocatorias VARCHAR(50),
    id_persona BIGINT,
    documento_identidad VARCHAR(50),
    postulante VARCHAR(255),
    unidad VARCHAR(255),
    programa VARCHAR(255),
    es_ingresante VARCHAR(10),
    modalidad_ingreso VARCHAR(100),
    fecha_registro VARCHAR(50)
);

-- Índices recomendados para búsquedas rápidas
CREATE INDEX IF NOT EXISTS idx_postulantes_dni ON postulantes(documento_identidad);
CREATE INDEX IF NOT EXISTS idx_postulantes_proceso ON postulantes(proceso_admision);
CREATE INDEX IF NOT EXISTS idx_postulantes_programa ON postulantes(programa);
CREATE INDEX IF NOT EXISTS idx_postulantes_postulante ON postulantes(postulante);
CREATE INDEX IF NOT EXISTS idx_postulantes_filial ON postulantes(filial);
CREATE INDEX IF NOT EXISTS idx_postulantes_unidad ON postulantes(unidad);
CREATE INDEX IF NOT EXISTS idx_postulantes_es_ingresante ON postulantes(es_ingresante);

-- Permisos para que PostgREST pueda leer los datos
GRANT SELECT ON ALL TABLES IN SCHEMA public TO web_anon;
ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT SELECT ON TABLES TO web_anon;
