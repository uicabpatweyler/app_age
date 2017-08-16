<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id')->unsigned();
            $table->integer('escuela_id')->unsigned();
            $table->integer('clasificacion_id')->unsigned();
            $table->string('grupo_nombre',120);
            $table->integer('grupo_alumnospermitidos');
            $table->boolean('grupo_disponible');
            $table->boolean('grupo_status')->default(true);
            $table->timestamps();

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('escuela_id')->references('id')->on('escuelas');
            $table->foreign('clasificacion_id')->references('id')->on('clasificaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
