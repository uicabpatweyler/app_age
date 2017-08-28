<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesesPagoColegiaturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meses_pago_colegiatura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('colegiatura_id')->unsigned();
            $table->tinyInteger('orden_mes');
            $table->string('nombre_mes', 10);
            $table->date('fecha1_sin_recargo');
            $table->date('fecha2_sin_recargo');
            $table->date('fecha3_con_recargo');
            $table->date('fecha4_con_recargo');
            $table->decimal('porcentaje_recargo', 5, 2);
            $table->timestamps();

            $table->foreign('colegiatura_id')->references('id')->on('cuotas_colegiatura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meses_pago_colegiatura');
    }
}
