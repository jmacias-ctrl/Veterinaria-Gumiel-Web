<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipoinsumos;

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
            'nombre' => 'Quirúrgicos'
        ]);
        
        Tipoinsumos::create([
            'nombre' => 'Curaciones'
        ]);

        Tipoinsumos::create([
            'nombre' => 'Diagnósticos'
        ]);
    }
}
