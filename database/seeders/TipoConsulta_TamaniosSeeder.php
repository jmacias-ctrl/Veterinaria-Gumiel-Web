<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\tipo_consulta_tamanios;


class TipoConsulta_TamaniosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipo_consulta_tamanios::create([
            'nombre' => 'Consulta',
            'duracion'=> 15,
            'precio'=>10000,
            'tiposervicio_id'=>2
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Consulta+vacuna',
            'duracion'=> 30,
            'precio'=>10000,
            'tiposervicio_id'=>2
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Cirugía',
            'duracion'=> 180,
            'precio'=>10000,
            'tiposervicio_id'=>2
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Grande',
            'duracion'=> 60,
            'precio'=>10000,
            'tiposervicio_id'=>1
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Mediano',
            'duracion'=> 90,
            'precio'=>10000,
            'tiposervicio_id'=>1
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Pequeño',
            'duracion'=> 120,
            'precio'=>10000,
            'tiposervicio_id'=>1
        ]);
    }
}
