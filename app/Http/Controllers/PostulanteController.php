<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

class PostulanteController extends Controller
{
    /**
     * Cargar la vista principal con las opciones de los filtros
     */
    public function index()
    {
        // Obtener valores únicos para poblar los selects
        $filiales = Postulante::whereNotNull('filial')->distinct()->orderBy('filial')->pluck('filial');
        $niveles = Postulante::whereNotNull('nivel_academico')->distinct()->orderBy('nivel_academico')->pluck('nivel_academico');
        $tiposProceso = Postulante::whereNotNull('tipo_proceso')->distinct()->orderBy('tipo_proceso')->pluck('tipo_proceso');
        $convocatorias = Postulante::whereNotNull('numero_convocatoria')->distinct()->orderBy('numero_convocatoria')->pluck('numero_convocatoria');
        $fechasConvocatoria = Postulante::whereNotNull('fecha_convocatorias')->distinct()->orderBy('fecha_convocatorias')->pluck('fecha_convocatorias');
        $unidades = Postulante::whereNotNull('unidad')->distinct()->orderBy('unidad')->pluck('unidad');
        $programas = Postulante::whereNotNull('programa')->distinct()->orderBy('programa')->pluck('programa');
        $modalidades = Postulante::whereNotNull('modalidad_ingreso')->distinct()->orderBy('modalidad_ingreso')->pluck('modalidad_ingreso');

        // Años y números de procesos (ej: 2026-1, 2026-2)
        $procesos = Postulante::whereNotNull('proceso_admision')->distinct()->orderBy('proceso_admision', 'desc')->pluck('proceso_admision');

        $anios = $procesos->map(function ($p) {
            $parts = explode('-', $p);

            return $parts[0] ?? null;
        })->filter()->unique()->values();

        $numerosProceso = $procesos->map(function ($p) {
            $parts = explode('-', $p);

            return $parts[1] ?? null;
        })->filter()->unique()->values();

        $totalGeneral = Postulante::count();

        // Mapa de programas y sus facultades/unidades
        $mapaProgramas = Postulante::whereNotNull('programa')
            ->whereNotNull('unidad')
            ->select('programa', 'unidad')
            ->distinct()
            ->get()
            ->groupBy('programa')
            ->map(fn ($group) => $group->pluck('unidad')->values());

        return view('postulantes', compact(
            'filiales',
            'niveles',
            'tiposProceso',
            'convocatorias',
            'fechasConvocatoria',
            'unidades',
            'programas',
            'modalidades',
            'anios',
            'numerosProceso',
            'totalGeneral',
            'mapaProgramas'
        ));
    }

    /**
     * Endpoint API para búsquedas dinámicas con AJAX y paginación
     */
    public function buscar(Request $request)
    {
        $startTime = microtime(true);
        $query = $this->aplicarFiltros($request);

        // Paginación
        $perPage = in_array((int) $request->input('per_page', 25), [10, 25, 50, 100]) ? (int) $request->input('per_page', 25) : 25;
        $paginador = $query->paginate($perPage);

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);

        return response()->json([
            'success' => true,
            'total' => $paginador->total(),
            'current_page' => $paginador->currentPage(),
            'last_page' => $paginador->lastPage(),
            'per_page' => $paginador->perPage(),
            'from' => $paginador->firstItem() ?? 0,
            'to' => $paginador->lastItem() ?? 0,
            'data' => $paginador->items(),
            'execution_time_ms' => $executionTime,
        ]);
    }

    /**
     * Exportar postulantes según los filtros aplicados en formato Excel (.xlsx) o CSV (.csv)
     */
    public function exportar(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        $formato = strtolower($request->input('formato', 'xlsx'));
        $query = $this->aplicarFiltros($request);
        $fechaActual = date('Ymd_His');

        $totalRegistros = (clone $query)->count();

        $headers = [
            'N°',
            'ID Postulante',
            'GUID',
            'Sede / Filial',
            'Tipo Proceso',
            'Proceso Admisión',
            'N° Convocatoria',
            'Fecha Convocatoria',
            'DNI',
            'Postulante',
            'Nivel Académico',
            'Facultad / Unidad',
            'Programa / Carrera',
            'Modalidad de Ingreso',
            '¿Es Ingresante?',
            'Fecha de Registro',
            'Entidad',
            'ID Persona',
            'Fila CSV Origen',
        ];

        if ($formato === 'csv') {
            $nombreArchivo = "postulantes_{$fechaActual}.csv";

            return response()->streamDownload(function () use ($query, $headers) {
                $handle = fopen('php://output', 'w');
                // Agregar BOM UTF-8 para compatibilidad nativa con Excel
                fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($handle, $headers);

                $i = 1;
                foreach ($query->cursor() as $p) {
                    if (connection_aborted()) {
                        break;
                    }

                    $dni = preg_replace('/^[A-Za-z\s.:-]+/', '', $p->documento_identidad ?? '');
                    $dni = ! empty($dni) ? $dni : ($p->documento_identidad ?? '-');

                    fputcsv($handle, [
                        $i++,
                        $p->id_postulante,
                        $p->guid,
                        $p->filial,
                        $p->tipo_proceso,
                        $p->proceso_admision,
                        $p->numero_convocatoria,
                        $p->fecha_convocatorias,
                        $dni,
                        $p->postulante,
                        $p->nivel_academico,
                        $p->unidad,
                        $p->programa,
                        $p->modalidad_ingreso,
                        $p->es_ingresante,
                        $p->fecha_registro,
                        $p->entidad,
                        $p->id_persona,
                        $p->row_num,
                    ]);
                }
                fclose($handle);
            }, $nombreArchivo, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
                'X-Total-Count' => (string) $totalRegistros,
                'Access-Control-Expose-Headers' => 'Content-Disposition, X-Total-Count',
            ]);
        }

        // Formato XLSX (Excel) con OpenSpout de alto rendimiento
        $nombreArchivo = "postulantes_{$fechaActual}.xlsx";

        return response()->streamDownload(function () use ($query, $headers) {
            $writer = new Writer;
            $writer->openToFile('php://output');

            $writer->addRow(Row::fromValues($headers));

            $i = 1;
            foreach ($query->cursor() as $p) {
                if (connection_aborted()) {
                    break;
                }

                $dni = preg_replace('/^[A-Za-z\s.:-]+/', '', $p->documento_identidad ?? '');
                $dni = ! empty($dni) ? $dni : ($p->documento_identidad ?? '-');

                $writer->addRow(Row::fromValues([
                    $i++,
                    $p->id_postulante,
                    $p->guid,
                    $p->filial,
                    $p->tipo_proceso,
                    $p->proceso_admision,
                    $p->numero_convocatoria,
                    $p->fecha_convocatorias,
                    $dni,
                    $p->postulante,
                    $p->nivel_academico,
                    $p->unidad,
                    $p->programa,
                    $p->modalidad_ingreso,
                    $p->es_ingresante,
                    $p->fecha_registro,
                    $p->entidad,
                    $p->id_persona,
                    $p->row_num,
                ]));
            }

            $writer->close();
        }, $nombreArchivo, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'X-Total-Count' => (string) $totalRegistros,
            'Access-Control-Expose-Headers' => 'Content-Disposition, X-Total-Count',
        ]);
    }

    /**
     * Construir la consulta de postulantes con los filtros aplicados
     */
    private function aplicarFiltros(Request $request): Builder
    {
        $query = Postulante::query();

        // 1. Buscador Global Inteligente (por DNI, Nombre o Carrera)
        if ($request->filled('search_global')) {
            $term = trim($request->search_global);
            $query->where(function ($q) use ($term) {
                $q->where('postulante', 'ilike', '%'.$term.'%')
                    ->orWhere('documento_identidad', 'like', '%'.$term.'%')
                    ->orWhere('programa', 'ilike', '%'.$term.'%')
                    ->orWhere('unidad', 'ilike', '%'.$term.'%');
            });
        }

        // 2. Sede / Filial
        if ($request->filled('filial')) {
            $query->where('filial', $request->filial);
        }

        // 3. Nivel Académico
        if ($request->filled('nivel_academico')) {
            $query->where('nivel_academico', $request->nivel_academico);
        }

        // 4. Tipo Proceso de Admisión
        if ($request->filled('tipo_proceso')) {
            $query->where('tipo_proceso', $request->tipo_proceso);
        }

        // 5. Proceso de Admisión - Año y Número
        if ($request->filled('proceso_anio') && $request->filled('proceso_num')) {
            $query->where('proceso_admision', $request->proceso_anio.'-'.$request->proceso_num);
        } elseif ($request->filled('proceso_anio')) {
            $query->where('proceso_admision', 'like', $request->proceso_anio.'-%');
        } elseif ($request->filled('proceso_num')) {
            $query->where('proceso_admision', 'like', '%-'.$request->proceso_num);
        }

        // 6. Número Convocatoria
        if ($request->filled('numero_convocatoria')) {
            $query->where('numero_convocatoria', $request->numero_convocatoria);
        }

        // 7. Fecha de Convocatoria
        if ($request->filled('fecha_convocatorias')) {
            $query->where('fecha_convocatorias', $request->fecha_convocatorias);
        }

        // 8. Facultad / Unidad de Posgrado
        if ($request->filled('unidad')) {
            $query->where('unidad', $request->unidad);
        }

        // 9. Programa Primera Opción
        if ($request->filled('programa')) {
            $query->where('programa', $request->programa);
        }

        // 10. Modalidad de Admisión
        if ($request->filled('modalidad_ingreso')) {
            $query->where('modalidad_ingreso', $request->modalidad_ingreso);
        }

        // 11. Nombre de Postulante o DNI específico
        if ($request->filled('buscar_postulante')) {
            $term = trim($request->buscar_postulante);
            $query->where(function ($q) use ($term) {
                $q->where('postulante', 'ilike', '%'.$term.'%')
                    ->orWhere('documento_identidad', 'like', '%'.$term.'%');
            });
        }

        // 12. Es Ingresante
        if ($request->filled('es_ingresante')) {
            $val = strtoupper($request->es_ingresante);
            if ($val === 'SI' || $val === 'SÍ') {
                $query->whereIn('es_ingresante', ['SI', 'SÍ']);
            } elseif ($val === 'NO') {
                $query->where('es_ingresante', 'NO');
            }
        }

        // 13. Rango de Fechas de Registro
        if ($request->filled('fecha_inicio')) {
            $query->whereRaw("to_date(fecha_registro, 'DD/MM/YYYY') >= ?::date", [$request->fecha_inicio]);
        }
        if ($request->filled('fecha_fin')) {
            $query->whereRaw("to_date(fecha_registro, 'DD/MM/YYYY') <= ?::date", [$request->fecha_fin]);
        }

        // 14. Ordenamiento configurable
        $orden = $request->input('ordenar_por', 'recientes');
        switch ($orden) {
            case 'antiguos':
                $query->orderBy('id_postulante', 'asc');
                break;
            case 'nombre_asc':
                $query->orderBy('postulante', 'asc');
                break;
            case 'nombre_desc':
                $query->orderBy('postulante', 'desc');
                break;
            case 'carrera_asc':
                $query->orderBy('programa', 'asc');
                break;
            case 'recientes':
            default:
                $query->orderBy('id_postulante', 'desc');
                break;
        }

        return $query;
    }
}
