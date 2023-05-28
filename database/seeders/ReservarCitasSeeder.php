<?php

namespace Database\Seeders;

use App\Models\ReservarCitas;
use Illuminate\Database\Seeder;

class ReservarCitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReservarCitas::create([
            'scheduled_date' => '2023-05-29',
            'sheduled_time' => '11:00:00',
            'type'=> 'Consulta',
            'description'=> 'Vomitos y nauseas',
            'funcionario_id'=> 1,
            'paciente_id'=>3,
            'tiposervicio_id'=>2,
            'status'=>'Reservada'
        ]);

        ReservarCitas::create([
            'scheduled_date' => '2023-06-05',
            'sheduled_time' => '12:15:00',
            'type'=> 'Grande',
            'description'=> 'Raza: pastor alemán',
            'funcionario_id'=> 2,
            'paciente_id'=>3,
            'tiposervicio_id'=>1,
            'status'=>'Confirmada'
        ]);
    }
}
