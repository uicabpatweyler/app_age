<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ciclos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ciclo_anioinicial',
        'ciclo_aniofinal'
    ];

    //Relacion 1:M. Lado 1
    //Un CICLO se usa para crear 1 o MUCHOS grupos
    public function Grupos(){
        return $this->hasMany(Grupo::class);
    }

    //Relacion 1:M. Lado 1
    //Un CICLO se usa para crear 1 o MUCHAS CUOTAS DE INSCRIPCION
    public function CuotasDeInscripcion(){
        return $this->hasMany(CuotaInscripcion::class);
    }

    //Relacion 1:M. Lado 1
    //Un CICLO se usa para crear 1 o MUCHAS CUOTAS DE COLEGIATURA
    public function CuotasDeColegiatura(){
        return $this->hasMany(CuotaColegiatura::class);
    }

    //Relacion 070818_1225 : Lado 1
    //Un CICLO se utiliza UNA o MUCHAS veces en la entidad DATOS_INSCRIPCION_ALUMNO
    public function DatosDeInscripcionDelAlumno(){
        return $this->hasMany(DatosInscripcionAlumno::class);
    }
    
    //Relacion 080818_1227: Lado 1
    //Un CICLO se utiliza UNA o MUCHAS veces en la entidad TUTORES_DATOSPERSONALES
    public function TutoresDatosPersonales(){
        return $this->hasMany(TutorDatosPersonales::class);
    }

    //Relacion 100818_1207
    public function GruposAlumnos(){
        return $this->hasMany(GrupoAlumno::class);
    }
}
