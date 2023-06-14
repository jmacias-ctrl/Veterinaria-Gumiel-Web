<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DisponibilidadVeterinaria;

class DisponibilidadVeterinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 7; ++$i) {
            DisponibilidadVeterinaria::create([
                'day' => $i,
                'active' => 1,
                'morning_start' =>  '09:30:00',
                'morning_end' => '14:00:00' ,
                'afternoon_start' =>'15:00:00',
                'afternoon_end' =>'19:00:00',
            ]);
        }
    }
}
