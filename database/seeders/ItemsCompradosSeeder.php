<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\items_comprados;

class ItemsCompradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        items_comprados::factory(50)->create();
    }
}
