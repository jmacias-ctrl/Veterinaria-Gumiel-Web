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
            'nombre' => 'Consulta',
            'duracion'=> 15,
            'precio'=>10000,
            'tiposervicio_id'=>2
        ]);

        servicios::create([
            'nombre' => 'Consulta+vacuna',
            'duracion'=> 30,
            'precio'=>10000,
            'tiposervicio_id'=>2
        ]);

        servicios::create([
            'nombre' => 'Cirugía',
            'duracion'=> 180,
            'precio'=>10000,
            'tiposervicio_id'=>2
        ]);

        servicios::create([
            'nombre' => 'Grande',
            'duracion'=> 60,
            'precio'=>10000,
            'tiposervicio_id'=>1
        ]);

        servicios::create([
            'nombre' => 'Mediano',
            'duracion'=> 90,
            'precio'=>10000,
            'tiposervicio_id'=>1
        ]);

        servicios::create([
            'nombre' => 'Pequeño',
            'duracion'=> 120,
            'precio'=>10000,
            'tiposervicio_id'=>1
        ]);
    }
        
}
