<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('pago_inscripcion')->default(false);
            $table->boolean('alumno_status')->default(true);
            $table->boolean('alumno_baja')->default(false);
            $table->boolean('alumno_becario')->default(false);
            $table->timestamps();

            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos_alumnos');
    }
}
