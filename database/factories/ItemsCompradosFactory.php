<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemsCompradosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if(rand(0,1) == 0)
        {
            return [
                'id_servicio'=> $this->faker->numberBetween(1,6),
                'id_producto'=> null,
            ];

        }else{
            return [
                'id_servicio'=> null,
                'id_producto'=> $this->faker->numberBetween(1,39),
            ];
        }
    }
}
