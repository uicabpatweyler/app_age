<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDeServicio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tiposdeservicio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tiposervicio_nombre',
        'tiposervicio_estado'
    ];
}
