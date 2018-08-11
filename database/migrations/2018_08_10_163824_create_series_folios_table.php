<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriesFoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_folios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie',10)->nullable();
            $table->integer('folio')->unsigned();
            $table->integer('tipo')->unsigned();
            $table->string('descripcion_',120)->nullable();
            $table->boolean('status')->default(true);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series_folios');
    }
}
