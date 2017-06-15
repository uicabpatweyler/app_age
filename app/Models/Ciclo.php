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
}
