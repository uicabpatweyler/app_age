<?php

use Illuminate\Database\Seeder;
use App\Models\Nivel;

class NivelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nivel::create([
            'tiposervicio_id'=>1, 'nivel_nombre'=>'Preescolar','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>1, 'nivel_nombre'=>'Primaria','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>1, 'nivel_nombre'=>'Secundaria','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>2, 'nivel_nombre'=>'USAER','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>2, 'nivel_nombre'=>'CAM','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>3, 'nivel_nombre'=>'Bachillerato','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>3, 'nivel_nombre'=>'Profesional Técnico','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>4, 'nivel_nombre'=>'Capacitación para el Trabajo','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>5, 'nivel_nombre'=>'Licenciatura','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>5, 'nivel_nombre'=>'Licenciatura S.A.','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>5, 'nivel_nombre'=>'Posgrado','nivel_estado'=>true
        ]);

        Nivel::create([
            'tiposervicio_id'=>5, 'nivel_nombre'=>'Posgrado S.A.','nivel_estado'=>true
        ]);
    }
}
