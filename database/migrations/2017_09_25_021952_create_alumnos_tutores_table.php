<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos_tutores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->string('tutor_primernombre', 120);
            $table->string('tutor_segundonombre', 120)->nullable();
            $table->string('tutor_primerapellido', 120);
            $table->string('tutor_segundoapellido', 120)->nullable();
            $table->string('tutor_email',60)->nullable();
            $table->string('tutor_direccion_calle',120);
            $table->string('tutor_direccion_numinterior',40);
            $table->string('tutor_direccion_numexterior',40);
            $table->string('tutor_direccion_referencias',120);
            $table->string('tutor_direccion_colonia',120);
            $table->string('tutor_direccion_codigopostal',5);
            $table->string('tutor_direccion_localidad',40);
            $table->string('tutor_direccion_delegacion',40);
            $table->string('tutor_direccion_estado',40);
            $table->string('tutor_telefonocasa',40)->nullable();
            $table->string('tutor_telefonotrabajo',40)->nullable();
            $table->string('tutor_telefonocelular',40)->nullable();
            $table->string('tutor_telefono_otro',40)->nullable();
            $table->string('tutor_ocupacion',120)->nullable();
            $table->string('tutor_lugardetrabajo',120)->nullable();
            $table->string('tutor_ldt_calle',120)->comment('ldt=Lugar de Trabajo')->nullable();
            $table->string('tutor_ldt_numinterior',40)->nullable();
            $table->string('tutor_ldt_numexterior',40)->nullable();
            $table->string('tutor_ldt_referencias',120)->nullable();
            $table->string('tutor_ldt_colonia',120)->nullable();
            $table->string('tutor_ldt_codigopostal',5)->nullable();
            $table->string('tutor_ldt_localidad',40)->nullable();
            $table->string('tutor_ldt_delegacion',40)->nullable();
            $table->string('tutor_ldt_estado',40)->nullable();
            $table->boolean('tutor_status')->default(true);
            $table->timestamps();

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
        Schema::dropIfExists('alumnos_tutores');
    }
}
