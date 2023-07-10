<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Horarios;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Veterinario Demo',
            'rut' => '11111111-1',
            'email' => 'veterinario@vetgumiel.cl',
            'password' => bcrypt('asdf123'),
            'tiposervicio_id' => '2'
        ])->assignRole('Veterinario');
        User::create([
            'name' => 'Peluquero Demo',
            'rut' => '22222222-2',
            'email' => 'peluquero@vetgumiel.cl',
            'password' => bcrypt('asdf123'),
            'tiposervicio_id' => '1'
        ])->assignRole('Peluquero');
        User::create([
            'name' => 'Cliente Demo',
            'rut' => '33333333-3',
            'email' => 'cliente@vetgumiel.cl',
            'password' => bcrypt('asdf123'),
        ])->assignRole('Cliente');
        User::create([
            'name' => 'Administrador Demo',
            'rut' => '44444444-4',
            'email' => 'admin@vetgumiel.cl',
            'password' => bcrypt('asdf123'),
        ])->assignRole('Admin');
        User::create([
            'name' => 'Inventario Demo',
            'rut' => '55555555-5',
            'email' => 'inventario@vetgumiel.cl',
            'password' => bcrypt('asdf123'),
        ])->assignRole('Inventario');
    }
}
