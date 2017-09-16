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
            $table->string('alumno_primernombre',30);
            $table->string('alumno_segundonombre',30)->nullable();
            $table->string('alumno_apellidopaterno',30);
            $table->string('alumno_apellidomaterno',30)->nullable();
            $table->string('alumno_rfc', 20);
            $table->string('alumno_curp',20);
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
