<?php

namespace Database\Seeders;

use App\Models\insumos_medicos;
use App\Models\Tipoinsumos as ModelsTipoinsumos;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Tipoinsumos;
use Spatie\Permission\Models\Permission;

class TipoinsumosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipoinsumos::create([
            'nombre' => 'Curaciones',
        ]);
        Tipoinsumos::create([
            'nombre' => 'Quirúrgicos',
        ]);
        Tipoinsumos::create([
            'nombre' => 'Equipo médico',
        ]);
        Tipoinsumos::create([
            'nombre' => 'Examenes',
        ]);
    }
}






