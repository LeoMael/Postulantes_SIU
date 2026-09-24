<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $table = 'postulantes';

    protected $primaryKey = 'id_postulante';

    public $incrementing = false;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'id_postulante',
        'guid',
        'row_num',
        'id_entidad',
        'entidad',
        'id_filial',
        'filial',
        'id_nivel_academico',
        'nivel_academico',
        'tipo_proceso',
        'proceso_admision',
        'numero_convocatoria',
        'fecha_convocatorias',
        'id_persona',
        'documento_identidad',
        'postulante',
        'unidad',
        'programa',
        'es_ingresante',
        'modalidad_ingreso',
        'fecha_registro',
    ];
}
