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
}
