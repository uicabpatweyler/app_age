<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grupos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ciclo_id',
        'escuela_id',
        'clasificacion_id',
        'grupo_nombre',
        'grupo_alumnospermitidos',
        'grupo_disponible'
    ];

    //Relación 1:M. Lado muchos
    //Un grupo pertenece a UNA sola clasificacion
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'clasificacion_id' es la FK que hace referencia al campo 'id' de la tabla CLASIFICACION
    public function ClasificacionGrupo(){
        return $this->belongsTo(Clasificacion::class,'clasificacion_id', 'id');
    }
}
