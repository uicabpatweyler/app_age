<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
     * Dirección. *** Componentes principales ***
     *
     * tipo_vialidad : Se refiere a la clasificación que se le da la vialidad, en función del transito
     *                 vehicular y/o peatonal, esta clasificación puede ser:
     *                 Ampliación, Andador, Avenida, Boulevard, Calle, Callejon, Calzada, Cerrada, Circuito,
     *                 Circunvalacion, Continuación, Corredor, Diagonal, Eje, Pasaje, Peatonal, Periferico,
     *                 Privada, Prolongación, Retorno y Viaducto.
     *
     * nombre_vialidad : Nombre propio que identifica a la vialidad dado por la autoridad o la costumbre, ejemplo:
     *                   90 Av., Calle 50, Av. Lic. Benito Juarez entre otros.
     *
     * numero_exterior : Se refiere a los caracteres alfanuméricos y simbolos que identifican a un inmueble en
     *                   una vialidad, ejemplo:
     *                   125, 1098, 572‐A, DOMICILIO CONOCIDO, MANZANA 15, LOTE 23, entre otros.
     *
     * numero_interior : Se refiere a los caracteres alfanuméricos y símbolos que identifican a uno o más
     *                   inmuebles pertenecientes a un número exterior
     *
     * tipo_asentamiento : Se refiere a la clasificación que se da al asentamiento. Ejemplo:
     *                     AEROPUERTO, AMPLIACIÓN, BARRIO, CAMPAMENTO, COLONIA, CONDOMINIO, CONGREGACIÓN,
     *                     CONJUNTO HABITACIONAL, EJIDO, ESTACIÓN, EQUIPAMIENTO, EXHACIENDA, FINCA,
     *                     FRACCIONAMIENTO, GRANJA, HACIENDA, INGENIO, PARQUE INDUSTRIAL,
     *                     POBLADO COMUNAL, PUEBLO, RANCHO O RANCHERÍA, RESIDENCIAL, UNIDAD HABITACIONAL
     *                     VILLA, ZONA COMERCIAL, ZONA FEDERAL, ZONA INDUSTRIAL, ZONA MILITAR,
     *                     ZONA NAVAL, CLUB DE GOLF
     *
     * nombre_asentamiento : Nombre propio asignado al asentamiento para su identificación, dado por la autoridad
     *                       o la costumbre. (Nombre de la colonia, por ejemplo). Ejemplo:
     *                       JARDINES DEL LAGO, CENTRO, VILLAS, TAURINAS, entre otros.
     *
     * codigo_postal : Número que identifica al código postal, constituido por cinco dígitos, obtenido de la
     *                 información oficial de Correos de México
     *
     * nombre_localidad: Nombre propio que identifica a la localidad.
     *
     * delegacion_municipio: Nombre propio que identifica al Municipio y en el caso del Distrito Federal
     *                       a las Delegaciones
     *
     * entidad_federativa : Nombre propio que identifica a los Estados y al Distrito Federal
     *
     *  *** Componentes Complementarios
     *
     *  entre_calles : Hace referencia al tipo y nombre de las vialidades entre las cuales se ubica una Dirección, que
     *                 corresponden a aquellas vialidades que generalmente son perpendiculares a la vialidad en
     *                 donde está establecido el domicilio.
     *
     *  referencias_adicionales : Se refiere a rasgos naturales o culturales (edificaciones) que aportan información
     *                            adicional para facilitar la ubicación del domicilio geográfico, esto es fundamental
     *                            en vialidades sin nombre y sin número exterior, en caminos, terracerías, brechas,
     *                            veredas, localidades rurales de difícil acceso, elementos del territorio insular,
     *                            cadenamiento original y que ha sido sustituido por la numeración oficial,
     *                            derivado del crecimiento de una zona urbana y “domicilios conocidos”.
     */
    public function up()
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('direcciones');
    }
}
