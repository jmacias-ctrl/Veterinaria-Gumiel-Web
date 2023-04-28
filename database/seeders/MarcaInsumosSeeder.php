<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarcaInsumo;

class MarcaInsumosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarcaInsumo::create([
            'nombre' => 'Shinova'
        ]);
        
        MarcaInsumo::create([
            'nombre' => 'ADC'
        ]);

        MarcaInsumo::create([
            'nombre' => 'Littmann'
        ]);
    }
}
