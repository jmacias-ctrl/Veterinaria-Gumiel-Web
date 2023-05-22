<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tiposervicios;
use App\Models\User;

class tiposerviciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tiposervicios::create([
            'nombre' => 'Peluquería',

        ]);
        
        tiposervicios::create([
            'nombre' => 'Atención medica',

        ]);

    }
   
}