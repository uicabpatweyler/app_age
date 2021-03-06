<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'niveles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tiposervicio_id',
        'nivel_nombre',
        'nivel_estado'
    ];

    //Relacion 1:M. Lado 1
    //Un NIVEL se usa en 1 o MUCHAS escuelas
    public function Escuelas(){
        return $this->hasMany(Escuela::class);
    }
}
