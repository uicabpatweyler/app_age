<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosInscripcionAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_inscripcion_alumno', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->integer('datospersonales_id')->unsigned();

            $table->string('alumno_escuela',120)->nullable();
            $table->string('alumno_ultimogrado',120)->nullable();
            $table->string('alumno_lugartrabajo')->nullable();
            $table->string('alumno_email',60)->nullable();

            $table->string('encuesta_pregunta1',60)->nullable();
            $table->string('encuesta_pregunta2',60)->nullable();

            $table->timestamps();

            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('datospersonales_id')->references('id')->on('alumnos_datospersonales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
