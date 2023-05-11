<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class productos_ventasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=> $this->faker->name(),
            'id_marca'=> $this->faker->numberBetween(1,4),
            'descripcion'=>$this->faker->text(),
            'slug'=> $this->faker->name(),
            'tipo'=> $this->faker->randomElement(['alimento','accesorio']),
            'producto_enfocado'=> $this->faker->randomElement(['gato','perro','ambos']),
            'stock'=> $this->faker->numberBetween(15,30),
            'min_stock'=> $this->faker->numberBetween(5,10),
            'precio'=> $this->faker->numberBetween(1000, 25000),
            'imagen_path' => $this->faker->randomElement(['seresto-collar.png','correa-automatica.png','arnes-perro.png','colonia-amarilla.png'])

        ];
    }
}
