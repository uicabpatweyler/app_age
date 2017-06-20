<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tiposervicio_id')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->string('servicio_nombre',40);
            $table->boolean('servicio_estado')->default(true);
            $table->timestamps();

            //Relacion 1:M
            $table->foreign('tiposervicio_id')->references('id')->on('tiposdeservicio');
            //Relacion 1:M
            $table->foreign('nivel_id')->references('id')->on('niveles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
