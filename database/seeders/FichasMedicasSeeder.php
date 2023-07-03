<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

use App\models\fichas_medicas;

class FichasMedicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            fichas_medicas::create([
                'nombre_paciente' => $faker->firstName,
                'propietario' => $faker->name,
                'numero_identificacion' => $faker->unique()->randomNumber(),
                'especie' => $faker->randomElement(['Perro', 'Gato', 'Otro']),
                'antecedentes_medicos' => $faker->paragraph,
                'examen_fisico' => $faker->paragraph,
                'diagnostico_tratamiento' => $faker->paragraph,
                'observaciones_recomendaciones' => $faker->paragraph,
            ]);
        }
    }
}
