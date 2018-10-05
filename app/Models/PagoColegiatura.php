<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;
use Carbon\Carbon;

class PagoColegiatura extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pagos_colegiatura';

    //Eloquent: Mutators
    protected $dates = [
        'fecha_pago' ,
        'fecha_cancelacion',
        'created_at',
        'updated_at'
    ];

    //Relacion 220818_1040. Lado M
    public function CicloPagoColegiatura(){
        return $this->belongsTo(Ciclo::class,'ciclo_id','id');
    }

    //Relacion 220818_1048. Lado M
    public function GrupoPagoColegiatura(){
        return $this->belongsTo(Grupo::class,'grupo_id','id');
    }

    //Relacion 220818_1055. Lado M
    public function ClasificacionPagosDeColegiatura(){
        return $this->belongsTo(Clasificacion::class,'clasifgrupo_id','id');
    }

    //Relacion 220818_1105. Lado M
    public function AlumnoPagosDeColegiatura(){
        return $this->belongsTo(Alumno::class,'alumno_id','id');
    }

    public function getFechaPagoAttribute($date)
    {
        return new Date($date);
    }

    public function getFechaCancelacionAttribute($date)
    {
        return new Date($date);
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
}
