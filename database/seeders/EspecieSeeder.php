<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especie;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especie::create([
            'nombre' => 'Gato'
        ]);
        
        Especie::create([
            'nombre' => 'Perro'
        ]);

        Especie::create([
            'nombre' => 'Conejo'
        ]);
    }
}
