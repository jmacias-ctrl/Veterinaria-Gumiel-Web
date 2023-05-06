<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\servicios;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        servicios::create([
            'nombre' => 'Control',
            'id_tipo'=>2,
            'precio'=>11000,
        ]);
        
        servicios::create([
            'nombre' => 'Corte de pelo',
            'id_tipo'=>1,
            'precio'=>18000,
        ]);

        servicios::create([
            'nombre' => 'Servicio completo(Corte, lavado,limado)',
            'id_tipo'=>1,
            'precio'=>25000,
        ]);
    }
        
}
