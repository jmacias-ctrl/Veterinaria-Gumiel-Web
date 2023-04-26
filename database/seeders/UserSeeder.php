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
        ])->assignRole('Veterinario');
        User::create([
            'name' => 'Peluquero Demo',
            'rut' => '22222222-2',
            'email' => 'peluquero@vetgumiel.cl',
            'password' => bcrypt('asdf123'),
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

        Horarios::create([
            'title'=>'Veterinario Demo',
            'id_usuario'=>'1',
            'start'=>'2023-04-27 08:00:00',
            'end'=>'2023-04-27 18:00:00',
        ]);
        Horarios::create([
            'title'=>'Peluquero Demo',
            'id_usuario'=>'2',
            'start'=>'2023-04-27 08:00:00',
            'end'=>'2023-04-27 18:00:00',
        ]);
    }
}
