<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPageGaleria;
class LandingPageGaleriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandingPageGaleria::create([
            'imagen'=>'images/vet03.png',
            'titulo_imagen'=>"Clientes Conformes",
        ]);
        LandingPageGaleria::create([
            'imagen'=>'images/vet04.png',
            'titulo_imagen'=>"Proceso Veterinaria",
        ]);
        LandingPageGaleria::create([
            'imagen'=>'images/vet05.png',
            'titulo_imagen'=>"Clientes Satisfecho",
        ]);
        LandingPageGaleria::create([
            'imagen'=>'images/vet06.png',
            'titulo_imagen'=>"Nuestro Equipo",
        ]);
        LandingPageGaleria::create([
            'imagen'=>'images/vet07.png',
            'titulo_imagen'=>"Clientes Conformes",
        ]);
        LandingPageGaleria::create([
            'imagen'=>'images/vet08.png',
            'titulo_imagen'=>"Clientes Conformes",
        ]);
    }
}
