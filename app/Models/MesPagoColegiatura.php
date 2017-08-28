<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class MesPagoColegiatura extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meses_pago_colegiatura';

    //Eloquent: Mutators
    protected $dates = [
        'fecha1_sin_recargo',
        'fecha2_sin_recargo',
        'fecha3_con_recargo',
        'fecha4_con_recargo'
    ];

    public function getFecha1SinRecargoAttribute($date)
    {
        return new Date($date);
    }

    public function getFecha2SinRecargoAttribute($date)
    {
        return new Date($date);
    }

    public function getFecha3ConRecargoAttribute($date)
    {
        return new Date($date);
    }

    public function getFecha4ConRecargoAttribute($date)
    {
        return new Date($date);
    }


}
//http://vegibit.com/easy-php-dates-and-times-with-carbon/#create-a-new-carbon-instance
//http://php.net/manual/es/function.date.php
//https://github.com/jenssegers/date
//https://www.youtube.com/watch?v=OtW18xcnGzI
//https://laravel.com/docs/5.4/eloquent-mutators