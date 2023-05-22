<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\marca_medicamentos_vacunas;
class marcamedicamentos_vacunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        marca_medicamentos_vacunas::create([
            'nombre' => '.'
        ]);
        
        marca_medicamentos_vacunas::create([
            'nombre' => '.'
        ]);

        marca_medicamentos_vacunas::create([
            'nombre' => 'L.'
        ]);
    }
}
