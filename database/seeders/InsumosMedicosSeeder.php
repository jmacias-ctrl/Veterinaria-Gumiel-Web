<?php

namespace Database\Seeders;

use App\Models\insumos_medicos;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class InsumosMedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Insumos_medicos::create([
            'nombre'=>'Agujas',
            'codigo'=>4737281,
            'id_marca'=>1,
            'id_tipo'=>1,
            'stock'=>25,
        ]);
        Insumos_medicos::create([
            'nombre'=>'Guantes',
            'codigo'=>98386962,
            'id_marca'=>2,
            'id_tipo'=>1,
            'stock'=>15,
        ]);
        Insumos_medicos::create([
            'nombre'=>'Gasas',
            'codigo'=>7806130010284,
            'id_marca'=>3,
            'id_tipo'=>2,
            'stock'=>30,
        ]);
        Insumos_medicos::create([
            'nombre'=>'Jeringas',
            'codigo'=>4968420726121,
            'id_marca'=>1,
            'id_tipo'=>3,
            'stock'=>10,
        ]);
        
    }
}
