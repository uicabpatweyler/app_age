<?php

use Illuminate\Database\Seeder;
use App\Models\TipoDeServicio;
class TipoServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDeServicio::create(['tiposervicio_nombre'=>'Educación Básica','tiposervicio_estado'=>true]);
        TipoDeServicio::create(['tiposervicio_nombre'=>'Educación Especial','tiposervicio_estado'=>true]);
        TipoDeServicio::create(['tiposervicio_nombre'=>'Educación Media Superior','tiposervicio_estado'=>true]);
        TipoDeServicio::create(['tiposervicio_nombre'=>'Capacitación Para El Trabajo','tiposervicio_estado'=>true]);
        TipoDeServicio::create(['tiposervicio_nombre'=>'Educación Superior','tiposervicio_estado'=>true]);
    }
}
