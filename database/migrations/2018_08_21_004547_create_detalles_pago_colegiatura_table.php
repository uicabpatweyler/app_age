<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesPagoColegiaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_pago_colegiatura', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('pagocolegiatura_id')->unsigned(); //De la tabla PAGOS_COLEGIATURA. Se puede repetir UNA o MUCHAS VECES
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('clasifgrupo_id')->unsigned();


            $table->tinyInteger('orden_mes');
            $table->string('nombre_mes',12);
            $table->float('cantidad_concepto'); //1
            $table->float('importe_colegiatura');

            $table->float('porcentaje_recargo');
            $table->float('recargo_pesos');
            $table->float('porcentaje_descuento');
            $table->float('descuento_pesos');
            $table->date('fecha_pago');
            $table->boolean('pago_cancelado')->default(false);

            $table->timestamps();

            $table->foreign('pagocolegiatura_id')->references('id')->on('pagos_colegiatura');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('clasifgrupo_id')->references('id')->on('clasificaciones');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_pago_colegiatura');
    }
}
