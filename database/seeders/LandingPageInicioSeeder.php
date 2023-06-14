<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPageInicio;

class LandingPageInicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandingPageInicio::create([
            'titulo_bienvenida'=>"Servicios de Veterinaria y Peluqueria",
            'agenda_hora_titulo'=>"Agenda Tu Hora",
            'agenda_hora_texto'=>"¿Tu mascota necesita una consulta veterinaria o un corte de pelo? ¡Estás en el lugar correcto! Puedes solicitar una hora con nuestros expertos de manera fácil y rápida",
        ]);
    }
}
