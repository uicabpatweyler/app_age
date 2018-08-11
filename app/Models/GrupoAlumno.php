<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class GrupoAlumno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grupos_alumnos';

    //Eloquent: Mutators
    protected $dates = [
        'created_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    //Relacion 100818_1205
    public function EscuelaGrupoAlumno(){
        return $this->belongsTo(Escuela::class, 'escuela_id', 'id');
    }

    //Relacion 100818_1207
    public function CicloGrupoAlumno(){
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id');
    }

    //Relacion 100818_1209
    public function AlumnoGrupoAlumno(){
        return $this->belongsTo(Alumno::class, 'alumno_id', 'id');
    }

    //Relacion 100818_1214
    public function GrupoDeGrupoAlumno(){
        return $this->belongsTo(Grupo::class,'grupo_id','id');
    }

    //Relacion 100818_0103
    public function ClasifGrupoAlumno(){
        return $this->belongsTo(Clasificacion::class,'clasifgrupo_id','id');
    }
}
