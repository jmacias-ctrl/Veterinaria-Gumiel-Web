<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as FakerFactory;

class fichas_medicas extends Model
{
    use HasFactory;

    protected $table = 'fichas_medicas';
    
    protected $fillable = [
        'nombre_paciente',
        'propietario',
        'numero_identificacion',
        'especie',
        'antecedentes_medicos',
        'examen_fisico',
        'diagnostico_tratamiento',
        'observaciones_recomendaciones',
    ];

    public function run()
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {
            $ficha = new fichas_medicas();
            $ficha->nombre = $faker->firstName;
            $ficha->raza = $faker->randomElement(['Labrador', 'Poodle', 'Bulldog', 'Persa']);
            $ficha->edad = $faker->numberBetween(1, 10);
            $ficha->peso = $faker->randomFloat(1, 2, 30);
            $ficha->save();
        }
    }
}
