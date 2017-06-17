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
            $table->string('empresa_rfc',20);
            $table->string('empresa_razonsocial');
            $table->string('empresa_regimenfiscal');
            $table->string('empresa_direccion');
            $table->string('empresa_numexterior',60);
            $table->string('empresa_numinterior',60)->nullable();
            $table->string('empresa_referencia');
            $table->string('empresa_colonia');
            $table->string('empresa_codigopostal',5);
            $table->string('empresa_telefono',5)->nullable();
            $table->string('empresa_email',60)->nullable();
            $table->string('empresa_delegacion');
            $table->string('empresa_localidad');
            $table->string('empresa_estado');
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
