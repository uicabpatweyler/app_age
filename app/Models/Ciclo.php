<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ciclos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ciclo_anioinicial',
        'ciclo_aniofinal'
    ];

    //Relacion 1:M. Lado 1
    //Un CICLO se usa para crear 1 o MUCHOS grupos
    public function Grupos(){
        return $this->hasMany(Grupo::class);
    }
}
