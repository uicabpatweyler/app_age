<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsSalidaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_salida_producto', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('salidaprod_id')->unsigned(); //De la tabla SALIDAS_PRODUCTO. Se puede repetir UNA o MUCHAS VECES

            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('alumno_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->tinyInteger('numero_linea');
            $table->integer('categoria_id')->unsigned(); //[Libros,Playeras]
            $table->integer('producto_id')->unsigned();
            $table->float('precio_unitario');
            $table->integer('cantidad')->unsigned();
            $table->date('fecha_venta');
            $table->boolean('venta_cancelada')->default(false);

            $table->timestamps();

            $table->foreign('salidaprod_id')->references('id')->on('salidas_producto');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('alumno_id')->references('id')->on('alumnos');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('categoria_id')->references('id')->on('categorias_productos');
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
        Schema::dropIfExists('items_salida_producto');
    }
}
