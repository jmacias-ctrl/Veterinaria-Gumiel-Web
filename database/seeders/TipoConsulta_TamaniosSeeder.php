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
            'tiposervicio_id'=>2
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Consulta+vacuna',
            'duracion'=> 30,
            'tiposervicio_id'=>2
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Cirugía',
            'duracion'=> 180,
            'tiposervicio_id'=>2
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Grande',
            'duracion'=> 60,
            'tiposervicio_id'=>1
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Mediano',
            'duracion'=> 90,
            'tiposervicio_id'=>1
        ]);

        tipo_consulta_tamanios::create([
            'nombre' => 'Pequeño',
            'duracion'=> 120,
            'tiposervicio_id'=>1
        ]);
    }
}
