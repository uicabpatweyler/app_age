<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alumno_primernombre',120);
            $table->string('alumno_segundonombre',120)->nullable();
            $table->string('alumno_apellidopaterno',120);
            $table->string('alumno_apellidomaterno',120)->nullable();
            $table->string('alumno_curp',20);
            $table->date('alumno_fechanacimiento');
            $table->char('alumno_genero',10);
            $table->boolean('alumno_status')->default(true);
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
        Schema::dropIfExists('alumnos');
    }
}
