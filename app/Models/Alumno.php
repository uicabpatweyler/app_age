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

    //Relacion 070818_1105 1:M. Lado 1
    //Una fila de la tabla ALUMNOS se utiliza UNA o MUCHAs veces
    // en la entidad DATOS_INSCRIPCIONALUMNO
    public function DatosDeInscripcionDelAlumno(){
        return $this->hasMany(DatosInscripcionAlumno::class);
    }



}
