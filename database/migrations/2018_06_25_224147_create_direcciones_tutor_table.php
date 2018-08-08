<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones_tutor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciclo_id')->unsigned();
            $table->integer('tutor_id')->unsigned();
            $table->string('tipo_vialidad',20)->nullable();
            $table->string('nombre_vialidad');
            $table->string('numero_exterior',40);
            $table->string('numero_interior',40)->nullable();
            $table->string('tipo_asentamiento',40);
            $table->string('nombre_asentamiento',120);
            $table->string('codigo_postal',5);
            $table->string('nombre_localidad',40);
            $table->string('delegacion_municipio',40);
            $table->string('entidad_federativa',24);
            $table->string('pais',20);
            $table->string('entre_calles')->nullable();
            $table->string('referencias_adicionales')->nullable();
            $table->string('telefono_casa',30)->nullable();
            $table->string('referencia1',30)->nullable();
            $table->string('telefono_trabajo',30)->nullable();
            $table->string('referencia2',30)->nullable();
            $table->string('telefono_celular',30)->nullable();
            $table->string('referencia3',30)->nullable();
            $table->string('telefono_otro',30)->nullable();
            $table->string('referencia4',30)->nullable();

            $table->timestamps();

            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->foreign('tutor_id')->references('id')->on('tutores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
