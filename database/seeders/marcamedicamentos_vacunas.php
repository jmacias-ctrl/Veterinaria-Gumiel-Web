<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class marcamedicamentos_vacunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarcaInsumo::create([
            'nombre' => '.'
        ]);
        
        MarcaInsumo::create([
            'nombre' => '.'
        ]);

        MarcaInsumo::create([
            'nombre' => 'L.'
        ]);
    }
}
