<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clasificaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ciclo_id',
        'escuela_id',
        'clasificacion_nombre'
    ];

    //Relacion 1:M. Lado 1
    //Una CLASIFICACION se usa para crear 1 o MUCHOS grupos
    public function Grupos(){
        return $this->hasMany(Grupo::class);
    }

    //Relacion 100818_0103
    public function GrupoAlumno(){
        return $this->hasMany(GrupoAlumno::class);
    }

    //Relacion 100818_0935 1:M. Lado 1
    public function PagosDeInscripcion(){
        return $this->hasMany(PagoInscripcion::class);
    }

    //Relacion 220818_1055. Lado 1
    public function PagosDeColegiatura(){
        return $this->hasMany(PagoColegiatura::class);
    }

}
