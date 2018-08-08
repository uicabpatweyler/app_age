<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorDatosPersonales extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tutores_datospersonales';

    //Relacion 080818_1227: Lado M
    // El campo CICLO_ID hace referencia a UNA sola fila en la entidad CICLOS
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'ciclo_id' es la FK que hace referencia al campo 'id' de la tabla CICLOS
    public function CicloTutorDatosPersonales(){
        return $this->belongsTo(Ciclo::class,'ciclo_id', 'id');
    }

    //Relacion 080818_1232: Lado M
    //El campor TUTOR_ID hace referencia a UNA sola fila en la entidad TUTORES
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'tutor_id' es la FK que hace referencia al campo 'id' de la tabla TUTORES
    public function TutorTutoresDatosPersonales(){
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }
}
