<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tiposervicio_id')->unsigned();
            $table->string('nivel_nombre',40);
            $table->boolean('nivel_estado')->default(true);
            $table->timestamps();

            //Relacion 1:M
            $table->foreign('tiposervicio_id')->references('id')->on('tiposdeservicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('niveles');
    }
}
