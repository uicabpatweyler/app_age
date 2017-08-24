<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuotasInscripcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas_inscripcion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id')->unsigned();
            $table->integer('escuela_id')->unsigned();
            $table->string('cuotainscripcion_nombre', 120);
            $table->float('cuotainscripcion_cuota');
            $table->boolean('cuotainscripcion_disponible');
            $table->boolean('cuotainscripcion_status')->default(true);
            $table->timestamps();

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('escuela_id')->references('id')->on('escuelas');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuotas_inscripcion');
    }
}
