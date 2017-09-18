<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Alumno extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alumnos';

    //Eloquent: Mutators
    protected $dates = [
        'created_at',
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }
}
