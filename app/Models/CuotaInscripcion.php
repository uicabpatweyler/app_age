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

    //Relacion 1:M. Lado Muchos
    //Una CUOTA DE INSCRIPCION pertenece a una sola ESCUELA
    //Resuelve la siguiente relacion: Esta cuota de inscripción pertenece a determinada escuela
    public function EscuelaCDI(){
        return $this->belongsTo(Escuela::class, 'escuela_id', 'id');
    }
}
