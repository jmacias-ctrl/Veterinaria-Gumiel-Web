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
            'nombre' => 'Avianvet'
        ]);
        
        marca_medicamentos_vacunas::create([
            'nombre' => 'Bioibérica'
        ]);

        marca_medicamentos_vacunas::create([
            'nombre' => 'Advance'
        ]);
        marca_medicamentos_vacunas::create([
            'nombre' => 'Cenavisa'
        ]);
        marca_medicamentos_vacunas::create([
            'nombre' => 'Catalysis'
        ]);
    }
}
