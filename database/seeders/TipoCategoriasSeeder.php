<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoCategorias;

class TipoCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoCategorias::create([
            'nombre' => 'chico',
            'id_categoria' => '1'
        ]);
        TipoCategorias::create([
            'nombre' => 'grande',
            'id_categoria' => '1'
        ]);
        TipoCategorias::create([
            'nombre' => 'mediano',
            'id_categoria' => '1'
        ]);
        TipoCategorias::create([
            'nombre' => 'cachorro',
            'id_categoria' => '2'
        ]);
        TipoCategorias::create([
            'nombre' => 'adulto',
            'id_categoria' => '2'
        ]);
        TipoCategorias::create([
            'nombre' => 'senior',
            'id_categoria' => '2'
        ]);
        TipoCategorias::create([
            'nombre' => 'blanco',
            'id_categoria' => '3'
        ]);
        TipoCategorias::create([
            'nombre' => 'negro',
            'id_categoria' => '3'
        ]);
        TipoCategorias::create([
            'nombre' => 'amarillo',
            'id_categoria' => '3'
        ]);
    }
}
