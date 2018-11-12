<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSalidaProducto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items_salida_producto';

    //Eloquent: Mutators
    protected $dates = [
        'fecha_venta' ,
        'created_at',
        'updated_at'
    ];
}
