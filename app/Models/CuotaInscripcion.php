<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuotaInscripcion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cuotas_inscripcion';

    //Relacion 1:M. Lado MUCHOS
    //Una CUOTA DE INSCRIPCION pertenece a un solo CICLO ESCOLAR
    //Resuelve la siguiente relacion: Esta cuota de inscripcion pertenece a determinado ciclo escolar
    public function CicloCDI(){
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id');
    }
}
