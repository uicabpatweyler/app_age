<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosPreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_precios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->float('precio_venta');
            $table->boolean('precio_actual')->default(true);
            

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_precios');
    }
}
