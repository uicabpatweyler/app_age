<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_rfc',
        'empresa_razonsocial',
        'empresa_regimenfiscal',
        'empresa_direccion',
        'empresa_numexterior',
        'empresa_numinterior',
        'empresa_referencia',
        'empresa_colonia',
        'empresa_codigopostal',
        'empresa_telefono',
        'empresa_email',
        'empresa_delegacion',
        'empresa_localidad',
        'empresa_estado',
        'empresa_pais'
    ];

}
