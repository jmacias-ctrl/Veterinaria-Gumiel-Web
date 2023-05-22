<?php

namespace Database\Seeders;

use App\Models\HorarioFuncionarios;
use Illuminate\Database\Seeder;

class HorariosFuncionariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<7; ++$i){
            HorarioFuncionarios::create([
                'day'=>$i,
                'active' => ($i==0),
                'morning_start' => ($i==0 ? '09:30:00' : '07:00:00'),
                'morning_end' => ($i==0 ? '14:00:00' : '07:00:00'),
                'afternoon_start' => ($i==0 ? '15:00:00' : '15:00:00'),
                'afternoon_end' => ($i==0 ? '19:00:00' : '20:00:00'),
                'user_id' => 1
            ]);
        }
    }
}
