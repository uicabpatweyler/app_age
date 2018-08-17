<?php

use Illuminate\Database\Seeder;

class DatosProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias_productos')->insert([
            'ciclo_id'             => 1,
            'escuela_id'           => 1,
            'categprod_nombre'     => 'Libros',
            'categprod_disponible' => true,
            'categprod_status'     => true
        ]);
        $i=1;

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 0,
            'clasif_nombre'         => 'Beginners',
            'clasif_subcateg_padre' => true,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 0,
            'clasif_nombre'         => 'Intermediate',
            'clasif_subcateg_padre' => true,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);
        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 0,
            'clasif_nombre'         => 'Advanced',
            'clasif_subcateg_padre' => true,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        $i=1;

        DB::table('categorias_productos')->insert([
            'ciclo_id'             => 1,
            'escuela_id'           => 1,
            'categprod_nombre'     => 'Playeras',
            'categprod_disponible' => true,
            'categprod_status'     => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 0,
            'clasif_nombre'         => 'Playera Cuello Redondo',
            'clasif_subcateg_padre' => true,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          => 2,
            'subcategoria'          => 0,
            'clasif_nombre'         => 'Playera Cuello Polo',
            'clasif_subcateg_padre' => true,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);


        ////////////////////////////////////////////////////////////////////////////////

        $i=1;

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 1,
            'clasif_nombre'         => 'Beginners 1',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 1,
            'clasif_nombre'         => 'Beginners 2',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 1,
            'clasif_nombre'         => 'Beginners 3',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        /////////////////////////////////////////////////////

        $i=1;

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 2,
            'clasif_nombre'         => 'Intermediate 1',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 2,
            'clasif_nombre'         => 'Intermediate 2',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 2,
            'clasif_nombre'         => 'Intermediate 3',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        /////////////////////////////////////////////////////

        $i=1;

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 3,
            'clasif_nombre'         => 'Advanced 1',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 3,
            'clasif_nombre'         => 'Advanced 2',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  1,
            'subcategoria'          => 3,
            'clasif_nombre'         => 'Advanced 3',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        /////////////////////////////////////////////////////

        $i=1;

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla 6-8',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla 10-12',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla 14-16',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla CH-36',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla M-38',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla G-40',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 4,
            'clasif_nombre'         => 'Talla EG-42',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        /////////////////////////////////////////////////////

        $i=1;

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          => 2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla 6-8',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla 10-12',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla 14-16',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla CH-36',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla M-38',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla G-40',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);

        DB::table('clasificaciones_productos')->insert([
            'ciclo_id'              => 1,
            'escuela_id'            => 1,
            'categoria_id'          =>  2,
            'subcategoria'          => 5,
            'clasif_nombre'         => 'Talla EG-42',
            'clasif_subcateg_padre' => false,
            'clasif_orden'          => $i++,
            'clasif_disponible'     => true,
            'clasif_status'         => true
        ]);


    }
}
