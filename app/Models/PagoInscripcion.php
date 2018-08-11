<?php

namespace App\Models;
use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;

class PagoInscripcion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pagos_inscripcion';

    //Eloquent: Mutators
    protected $dates = [
        'created_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

}
