<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalidaProducto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'salidas_producto';

    //Eloquent: Mutators
    protected $dates = [
        'fecha_venta' ,
        'fecha_cancelacion',
        'created_at',
        'updated_at'
    ];
}
