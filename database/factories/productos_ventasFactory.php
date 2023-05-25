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
            'nombre'=> $this->faker->words(4, true),
            'id_marca'=> $this->faker->numberBetween(1,4),
            'codigo'=> $this->faker->ean8(),
            'descripcion'=>$this->faker->text(),
            'slug'=> $this->faker->slug(),
            'id_tipo'=> $this->faker->numberBetween(1,4),
            'producto_enfocado'=> $this->faker->numberBetween(1,3),
            'stock'=> $this->faker->numberBetween(15,30),
            'min_stock'=> $this->faker->numberBetween(5,10),
            'precio'=> $this->faker->numberBetween(1000, 25000),
            'imagen_path' => $this->faker->randomElement(['seresto-collar.png','correa-automatica.png','arnes-perro.png','colonia-amarilla.png'])

        ];
    }
}
