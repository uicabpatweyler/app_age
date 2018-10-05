<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('escuela_id')->unsigned();
            $table->integer('ciclo_id')->unsigned();
            $table->integer('categoria_id')->unsigned(); //[Libros,Playeras]
            $table->integer('subcategoria_id')->unsigned(); //[Beginners, Intemediate, Advanced, Playera Cuello Redondo, Playera Cuello Polo]
            $table->integer('clasificacion1_id')->unsigned(); //[Beg1,Int1,Adv1..etc, Tallas de las playeras]
            $table->string('nombre'); // [Libro, Playera]
            $table->string('codigo')->nullable(); // [ISBN, Codigo Producto]
            $table->string('descripcion_venta'); //El nombre que se mostrara impreso en la nota de venta
            $table->string('info_adicional')->nullable(); //Editorial del libro, Marca de las playeras
            $table->boolean('disponible')->defatult(true); //Indica si el producto esta disponible
            $table->timestamps();

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('categoria_id')->references('id')->on('categorias_productos');
            $table->foreign('subcategoria_id')->references('id')->on('clasificaciones_productos');
            $table->foreign('clasificacion1_id')->references('id')->on('clasificaciones_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_productos');
    }
}
