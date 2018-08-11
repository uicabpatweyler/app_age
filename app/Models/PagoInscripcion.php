<?php

namespace App\Models;
use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;

class PagoInscripcion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pagos_inscripcion';

    //Eloquent: Mutators
    protected $dates = [
        'created_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    //Relacion 100818_0935 1:M. Lado M
    public function ClasificacionPagoDeInscripcion(){
        return $this->belongsTo(Clasificacion::class, 'clasifgrupo_id','id');
    }

    //Relacion 100818_0944. 1:M Lado M
    public function GrupoPagoDeInscripcion(){
        return $this->belongsTo(Grupo::class, 'grupo_id', 'id');
    }

    //Relacion 100818_0949. 1.M. Lado M
    public function AlumnoPagoDeInscripcion(){
        return $this->belongsTo(Alumno::class,'alumno_id','id');
    }

    //Relacion 100818_1145. 1:M Lado M
    public function CicloPagoDeInscripcion(){
        return $this->belongsTo(Ciclo::class,'ciclo_id','id');
    }

}
