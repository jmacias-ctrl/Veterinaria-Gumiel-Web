<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class tipomedicamentos_vacunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipomedicamentos_vacunas::create([
            'nombre' => 'Perro'
        ]);
        
        Tipomedicamentos_vacunas::create([
            'nombre' => 'Gato'
        ]);

        
    }
}
