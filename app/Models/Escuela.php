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

    //Relación 1:M. Lado muchos
    //Una escuela pertenece a UN solo nivel
    //https://laravel.com/docs/5.4/eloquent-relationships#one-to-many
    //El campo 'escuela_nivel' es la FK que hace referencia al campo 'id' de la tabla NIVELES
    public function NivelEscuela(){
        return $this->belongsTo(Nivel::class,'escuela_nivel', 'id');
    }

    //Relacion 1:M. Lado 1
    //Una ESCUELA se usa para crear 1 o MUCHOS grupos
    public function Grupos(){
        return $this->hasMany(Grupo::class);
    }

    //Relacion 1:M. Lado 1
    //Una ESCUELA se usa para crear 1 o MUHCAS CUOTAS DE INSCRIPCION
    public function CuotasDeInscripcion(){
        return $this->hasMany(CuotaInscripcion::class);
    }



}
