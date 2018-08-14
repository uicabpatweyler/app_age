<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Alumno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alumnos';

    //Eloquent: Mutators
    protected $dates = [
        'created_at',
        'alumno_fechanacimiento'
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getAlumnoFechanacimientoAttribute($date){
        return new Date($date);
    }

    //Relacion 070818_1105 1:M. Lado 1
    //Una fila de la tabla ALUMNOS se utiliza UNA o MUCHAs veces
    // en la entidad DATOS_INSCRIPCIONALUMNO
    public function DatosDeInscripcionDelAlumno(){
        return $this->hasMany(DatosInscripcionAlumno::class);
    }

    //Relacion 100818_1209
    public function GrupoAlumno(){
        return $this->hasMany(GrupoAlumno::class);
    }

    //Relacion 100818_0949. 1.M. Lado 1
    public function PagosDeInscripcion(){
        return $this->hasMany(PagoInscripcion::class);
    }


}
