<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoMedicamento;
class tipomedicamentos_vacunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoMedicamento::create([
            'nombre' => 'Vacuna'
        ]);
        
        TipoMedicamento::create([
            'nombre' => 'Pastillas'
        ]);
        TipoMedicamento::create([
            'nombre' => 'Via Oral'
        ]);
        
    }
}
