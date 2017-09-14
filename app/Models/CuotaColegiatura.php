<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuotaColegiatura extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cuotas_colegiatura';

    //Relacion 1:M. Lado Muchos
    //Una CUOTA DE COLEGIATURA pertenece a una solo CICLO
    //Resuelve la siguiente relacion: Esta cuota de colegiatura pertenece a un determinado ciclo
    public function CicloCDC(){
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id');
    }

    //Relacion 1:M. Lado Muchos
    //Una CUOTA DE COLEGIATURA pertenece a una sola ESCUELA
    //Resuelve la siguiente relacion: Esta cuota de colegiatura pertenece a una determinada escuela
    public function EscuelaCDC(){
        return $this->belongsTo(Escuela::class, 'escuela_id', 'id');
    }
}
