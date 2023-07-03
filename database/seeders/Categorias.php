<?php

namespace Database\Seeders;

use App\Models\Categorias as ModelsCategorias;
use Illuminate\Database\Seeder;

class Categorias extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsCategorias::factory(10)->create();
    }
}
