<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_inscripcion', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->integer('direccion_id')->unsigned();
            $table->char('alumno_edad',2);

            $table->string('telefono_casa',30)->nullable();
            $table->string('referencia1',30)->nullable();
            $table->string('telefono_tutor',30)->nullable();
            $table->string('referencia2',30)->nullable();
            $table->string('telefono_celular',30)->nullable();
            $table->string('referencia3',30)->nullable();
            $table->string('telefono_otro',30)->nullable();
            $table->string('referencia4',30)->nullable();

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
            $table->foreign('direccion_id')->references('id')->on('direcciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_direccion');
    }
}
