<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();

            $table->string('serie_entrada',20); ////Campo 'serie' de la tabla SERIES_FOLIOS
            $table->string('folio_entrada',20); //Folio consecutivo interno. Campo 'folio' de la tabla SERIES_FOLIOS
            $table->string('tipo_entrada',20);  //Campo 'tipo' de la tabla SERIES_FOLIOS

            $table->string('nombre_proveedor');
            $table->dateTime('fecha_aplicacion')->nullable(); //Se actualiza despues por el usuario

            $table->string('tipo_documento',120);  //Factura, Recibo, Remision, Nota de Compra
            $table->string('folio_documento',120); //Numero de identificacion
            $table->date('fecha_documento');
            $table->string('referencia_documento')->nullable();

            $table->integer('usuario_id')->unsigned(); //Quien esta creando la entrada
            $table->integer('cancelado_por')->unsigned(); //Quien la esta cancelando
            $table->boolean('entrada_cancelada')->default(false);
            $table->dateTime('fecha_cancelacion')->nullable();
            $table->string('motivo_cancelacion')->nullable();
            $table->timestamps();

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('usuario_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas_productos');
    }
}
