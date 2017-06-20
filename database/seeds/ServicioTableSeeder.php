<?php

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>1, 'servicio_nombre'=>'CENDI', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>1, 'servicio_nombre'=>'Preescolar General', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>1, 'servicio_nombre'=>'Preescolar Indígena', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>1, 'servicio_nombre'=>'Preescolar CONAFE', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>2, 'servicio_nombre'=>'Primaria General', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>2, 'servicio_nombre'=>'Primaria Indigena', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>2, 'servicio_nombre'=>'Primaria CONAFE', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>3, 'servicio_nombre'=>'Secundaria General', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>3, 'servicio_nombre'=>'Secundaria Técnica', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>3, 'servicio_nombre'=>'Telesecundaria', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>3, 'servicio_nombre'=>'Secundaria Comunitaria', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>3, 'servicio_nombre'=>'Secundaria Migrante', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>1, 'nivel_id'=>3, 'servicio_nombre'=>'Secundaria Para Trabajadores', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>2, 'nivel_id'=>4, 'servicio_nombre'=>'USAER', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>2, 'nivel_id'=>5, 'servicio_nombre'=>'CAM', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>3, 'nivel_id'=>6, 'servicio_nombre'=>'Bachillerato General', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>3, 'nivel_id'=>6, 'servicio_nombre'=>'Bachillerato Técnico', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>3, 'nivel_id'=>6, 'servicio_nombre'=>'Profesional Técnico B', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>3, 'nivel_id'=>7, 'servicio_nombre'=>'Profesional Técnico', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>4, 'nivel_id'=>8, 'servicio_nombre'=>'Formación para el Trabajo', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>9, 'servicio_nombre'=>'Lic. Univ. y Téc.', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>9, 'servicio_nombre'=>'Técnico Superior', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>9, 'servicio_nombre'=>'Normal', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>10, 'servicio_nombre'=>'Lic. Univ. y Téc. S.A.', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>10, 'servicio_nombre'=>'Técnico Superior S.A.', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>11, 'servicio_nombre'=>'Especialidad', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>11, 'servicio_nombre'=>'Maestría', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>11, 'servicio_nombre'=>'Doctorado', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>12, 'servicio_nombre'=>'Especialidad S.A.', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>12, 'servicio_nombre'=>'Maestría S.A.', 'servicio_estado'=>true]);
        Servicio::create(['tiposervicio_id'=>5, 'nivel_id'=>12, 'servicio_nombre'=>'Doctorado S.A.', 'servicio_estado'=>true]);
    }
}
