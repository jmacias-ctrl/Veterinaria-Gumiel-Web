<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class medicamentos_vacunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicamentos_vacunas::create([
            'nombre'=>'Vacunas',
            'id_marca'=>1,
            'id_tipo'=>1,
            'stock'=>50,
        ]);
        Medicamentos_vacunas::create([
            'nombre'=>'Medicamentos',
            'id_marca'=>2,
            'id_tipo'=>1,
            'stock'=>100,
        ]);
        
        
    }
}
