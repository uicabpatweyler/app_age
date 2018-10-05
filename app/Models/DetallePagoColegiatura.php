<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class DetallePagoColegiatura extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalles_pago_colegiatura';

    //Eloquent: Mutators
    protected $dates = [
        'fecha_pago',
        'created_at',
        'updated_at'
    ];

    public function getFechaPagoAttribute($date)
    {
        return new Date($date);
    }

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

}
