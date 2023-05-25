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
            'nombre'=>'Jeringa insulina Omnican 40 U.I 1ml (100 Ud) Braun',
            'codigo'=>9647372,
            'id_marca'=>1,
            'id_tipo'=>1,
            'medicamentos_enfocados'=>2,
            'gramos'=>1,
            'mililitros'=>30,
            'stock'=>50,
        ]);
        Medicamentos_vacunas::create([
            'nombre'=>'Alzer Pet S.O. 150 ml',
            'codigo'=>98347412,
            'medicamentos_enfocados'=>1,
            'gramos'=>350,
            'mililitros'=>150,
            'id_marca'=>2,
            'id_tipo'=>3,
            'stock'=>100,
        ]);
        Medicamentos_vacunas::create([
            'nombre'=>'DHA Pet Support 400 mg 60 Perlas Blister',
            'codigo'=>43244231,
            'id_marca'=>4,
            'id_tipo'=>2,
            'medicamentos_enfocados'=>1,
            'gramos'=>400,
            'stock'=>50,
        ]);
        
    }
}
