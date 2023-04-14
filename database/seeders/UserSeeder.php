<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Veterinario Demo',
            'rut' => '11111111-1',
            'email' => 'veterinario@vetgumiel.cl',
            'id_rol' => '1',
            'password' => 'asdf123',
        ]);
        DB::table('users')->insert([
            'name' => 'Peluquero Demo',
            'rut' => '22222222-2',
            'email' => 'peluquero@vetgumiel.cl',
            'id_rol' => '2',
            'password' => 'asdf123',
        ]);
        DB::table('users')->insert([
            'name' => 'Cliente Demo',
            'rut' => '33333333-3',
            'email' => 'cliente@vetgumiel.cl',
            'id_rol' => '3',
            'password' => 'asdf123',
        ]);
        DB::table('users')->insert([
            'name' => 'Administrador Demo',
            'rut' => '44444444-4',
            'email' => 'admin@vetgumiel.cl',
            'id_rol' => '4',
            'password' => 'asdf123',
        ]);
    }
}
