<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('escuelas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipodeservicio_id')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->integer('servicio_id')->unsigned();
            $table->integer('ciclo_id')->unsigned()->default(0);
            $table->string('escuela_nombre');
            $table->string('escuela_clavect',20);
            $table->string('escuela_numincorporacion',20)->nullable();
            $table->string('escuela_direccion');
            $table->string('escuela_numexterior',60);
            $table->string('escuela_numinterior',60)->nullable();
            $table->string('escuela_referencia');
            $table->string('escuela_colonia');
            $table->string('escuela_codpost',5);
            $table->string('escuela_telefono',20)->nullable();
            $table->string('escuela_email',60)->nullable();
            $table->string('escuela_delegacion');
            $table->string('escuela_localidad');
            $table->string('escuela_estado');
            $table->string('escuela_pais');
            $table->boolean('escuela_status')->default(true);
            $table->timestamps();

            $table->foreign('tipodeservicio_id')->references('id')->on('tiposdeservicio');
            $table->foreign('nivel_id')->references('id')->on('niveles');
            $table->foreign('servicio_id')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('escuelas');
    }
}
