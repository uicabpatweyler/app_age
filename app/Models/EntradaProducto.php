<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class EntradaProducto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'entradas_productos';

    //Eloquent: Mutators
    protected $dates = [
        'fecha_aplicacion',
        'fecha_factura',
        'created_at',
        'updated_at'
    ];

    public function getFechaAplicacionAttribute($date)
    {
        return new Date($date);
    }

    public function getFechaFacturaAttribute($date)
    {
        return new Date($date);
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getUpdatedAtAttribute($date)
    {
        return new Date($date);
    }
}
