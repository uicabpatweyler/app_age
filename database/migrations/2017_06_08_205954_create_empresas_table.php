<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa_rfc','20');
            $table->string('empresa_razonsocial',120);
            $table->string('empresa_regimenfiscal',120);
            $table->string('empresa_direccion',120);
            $table->string('empresa_numexterior',60);
            $table->string('empresa_numinterior',60)->nullable();
            $table->string('empresa_referencia',120);
            $table->integer('estado_id')->unsigned();
            $table->integer('delegacion_id')->unsigned();
            $table->string('empresa_localidad', 80);
            $table->integer('colonia_id')->unsigned();
            $table->integer('codigopostal_id')->unsigned();
            $table->string('empresa_pais');
            $table->boolean('empresa_status');
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
        Schema::dropIfExists('empresas');
    }
}
