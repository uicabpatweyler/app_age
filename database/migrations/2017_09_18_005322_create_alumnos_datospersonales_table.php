<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosDatospersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_datospersonales', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('tipo_vialidad',20)->nullable();
            $table->string('nombre_vialidad');
            $table->string('numero_exterior',40);
            $table->string('numero_interior',40)->nullable();
            $table->string('tipo_asentamiento',40);
            $table->string('nombre_asentamiento',120);
            $table->string('codigo_postal',5);
            $table->string('nombre_localidad',40);
            $table->string('delegacion_municipio',40);
            $table->string('entidad_federativa',24);
            $table->string('pais',20);
            $table->string('entre_calles')->nullable();
            $table->string('referencias_adicionales')->nullable();
           

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos_datospersonales');
    }
}
