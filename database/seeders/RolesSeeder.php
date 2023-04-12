<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rol' => 'veterinario',
        ]);
        DB::table('roles')->insert([
            'rol' => 'peluquero',
        ]);
        DB::table('roles')->insert([
            'rol' => 'cliente',
        ]);
        DB::table('roles')->insert([
            'rol' => 'administrador',
        ]);
    }
}
