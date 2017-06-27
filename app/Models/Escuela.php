<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'escuelas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'escuela_tiposervicio',
        'escuela_nivel',
        'escuela_servicio',
        'escuela_ciclo',
        'escuela_nombre',
        'escuela_clavect',
        'escuela_numincorporacion',
        'escuela_direccion',
        'escuela_numexterior',
        'escuela_numinterior',
        'escuela_referencia',
        'escuela_colonia',
        'escuela_codpost',
        'escuela_telefono',
        'escuela_email',
        'escuela_delegacion',
        'escuela_localidad',
        'escuela_estado',
        'escuela_pais',
        'escuela_status',
    ];



}
