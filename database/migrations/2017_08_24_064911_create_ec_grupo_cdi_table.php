<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//EC  = Entidad Compuesta
//CDI = Cuota de Inscripción
class CreateEcGrupoCdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ec_grupo_cdi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grupo_id')->unsigned();
            $table->integer('cuotainscripcion_id')->unsigned();
            $table->boolean('ec_grupo_cdi_disponible');
            $table->boolean('ec_grupo_cdi_status');
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('cuotainscripcion_id')->references('id')->on('cuotas_inscripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ec_grupo_cdi');
    }
}
