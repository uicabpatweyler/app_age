<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosInscripcionAlumno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'datos_inscripcion_alumno';

    //Relacion 070818_1105 1:M. Lado Muchos
    //Una o Muchas filas de la entidad DATOS_INSCRIPCION_ALUMNO del campo DATOSPERSONALES_ID
    //hace referencia a una sola fila en la tabla ALUMNOS_DATOSPERSONALES
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'datospersonales_id' es la FK que hace referencia al campo 'id' de la tabla ALUMNOS_DATOSPERSONALES
    public function AlumnoDatosPersonalesDatosInscripcionAlumno(){
        return $this->belongsTo(AlumnoDatosPersonales::class,'datospersonales_id', 'id');
    }
    
    //Relacion 070818_1139 : Lado Muchos
    //Una o Muchas filas de la entidad DATOS_INSCRIPCION_ALUMNO del campo DATOSPERSONALES_ID
    //hace referencia a una sola fila en la tabla ALUMNOS
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'alumno_id' es la FK que hace referencia al campo 'id' de la tabla ALUMNOS
    public function AlumnoDatosInscripcionAlumno(){
        return $this->belongsTo(Alumno::class, 'alumno_id', 'id');
    }

    //Relacion 070818_1225 : Lado Muchos
    //Una o Muchas filas de la entidad DATOS_INSCRIPCION_ALUMNO del campo CICLO_ID
    //hace referencia a una sola fila en la tabla CICLOS
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'ciclo_id' es la FK que hace referencia al campo 'id' de la tabla CICLOS
    public function CicloDatosInscripcionAlumno(){
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id');
    }

    //Relacion 080818_0155: Lado M
    //El campo 'escuela_id' es la FK que hace referencia al campo 'id' de la tabla ESCUELAS
    public function EscuelaDatosInscripcionAlumno(){
        return $this->belongsTo(Escuela::class, 'escuela_id','id');
    }
}
