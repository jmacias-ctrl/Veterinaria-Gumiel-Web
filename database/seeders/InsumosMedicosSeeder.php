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
            'id_marca'=>1,
            'id_tipo'=>1,
            'stock'=>25,
        ]);
        Insumos_medicos::create([
            'nombre'=>'Guantes',
            'id_marca'=>2,
            'id_tipo'=>1,
            'stock'=>15,
        ]);
        Insumos_medicos::create([
            'nombre'=>'Gasas',
            'id_marca'=>3,
            'id_tipo'=>2,
            'stock'=>30,
        ]);
        Insumos_medicos::create([
            'nombre'=>'Jeringas',
            'id_marca'=>1,
            'id_tipo'=>3,
            'stock'=>10,
        ]);
        
    }
}
