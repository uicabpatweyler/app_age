<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosColegiaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_colegiatura', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('clasifgrupo_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->string('serie_recibo',10)->nullable();
            $table->integer('folio_recibo')->unsigned();

           $table->date('fecha_pago');
            $table->boolean('pago_cancelado')->default(false);
            $table->date('fecha_cancelacion')->nullable();
            $table->integer('cancelado_por')->unsigned();
            $table->string('motivo_cancelacion')->nullable();

            $table->string('moneda',10); //MXN Peso Mexicano - USD Dolar Americano
            $table->float('cantidad_recibida_mxn'); //Lo que se recibe del cliente en MXN. En este caso es el total a pagar.
            $table->float('cantidad_recibida_usd'); //Lo que se recibe del cliente en Dolares
            $table->float('usd_tipodecambio');
            $table->string('forma_de_pago',4); //01-Efectivo, 04-Tarjeta de crédito, 48 - Tarjeta de débito
            $table->string('referencia_pago')->nullable(); //Para los pagos con TDC o TDD
            $table->string('tipo_tarjeta',20)->nullable(); //Visa o MasterCard

            $table->timestamps();
            
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('clasifgrupo_id')->references('id')->on('clasificaciones');
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
        Schema::dropIfExists('pagos_colegiatura');
    }
}
