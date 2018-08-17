<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasificacionesProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificaciones_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id')->unsigned();
            $table->integer('escuela_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('subcategoria')->unsigned();

            $table->string('clasif_nombre',120);
            $table->boolean('clasif_subcateg_padre');
            $table->integer('clasif_orden');
            $table->boolean('clasif_disponible')->default(true);
            $table->boolean('clasif_status')->default(true);

            $table->timestamps();

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('categoria_id')->references('id')->on('categorias_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clasificaciones_productos');
    }
}
