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
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->char('alumno_edad',3);
            $table->string('direccion_calle',120);
            $table->string('direccion_numerointerior',40);
            $table->string('direccion_numeroexterior',40)->nullable();
            $table->string('direccion_referencias',120)->nullable();
            $table->string('direccion_colonia',120)->nullable();
            $table->string('direccion_codigopostal',5)->nullable();
            $table->string('direccion_localidad',40);
            $table->string('direccion_delegacion',40);
            $table->string('direccion_estado',22);
            $table->string('contacto_telefonocasa',30)->nullable();
            $table->string('contacto_telefonotutor',30)->nullable();
            $table->string('contacto_telefonocelular',30)->nullable();
            $table->string('contacto_telefono_otro',30)->nullable();
            $table->string('contacto_nombre_escuela')->nullable();
            $table->string('contacto_lugartrabajo')->nullable();
            $table->string('alumno_ultimogrado');
            $table->string('alumno_email',60)->nullable();
            $table->boolean('alumno_status')->default(true);
            $table->timestamps();

            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
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
