<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tutores';

    //Relacion 080818_1232: Lado 1
    //Un TUTOR se utiliza UNA o MUCHAS veces en la entidad TUTORES_DATOSPERSONALES
    public function TutoresDatosPersonales(){
        return $this->hasMany(TutorDatosPersonales::class);
    }
}
