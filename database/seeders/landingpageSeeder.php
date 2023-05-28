<?php

namespace Database\Seeders;

use App\Models\landingpage_config;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class landingpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //php artisan migrate:fresh --seed

    public function run()
    {
        landingpage_config::create([
            'id' => 0,
            'aboutUs' => 'something to say about us',
        ]);
    }
}
