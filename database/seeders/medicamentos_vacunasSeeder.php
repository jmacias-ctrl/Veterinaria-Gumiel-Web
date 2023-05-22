<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\medicamentos_vacunas;
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
            'medicamentos_enfocados'=>'perros',
            'mililitros'=>250,
            'stock'=>50,
        ]);
        Medicamentos_vacunas::create([
            'nombre'=>'Medicamentos',
            'medicamentos_enfocados'=>'gatos',
            'gramos'=>350,
            'stock'=>50,
            'id_marca'=>2,
            'id_tipo'=>1,
            'stock'=>100,
        ]);
        
        
    }
}
