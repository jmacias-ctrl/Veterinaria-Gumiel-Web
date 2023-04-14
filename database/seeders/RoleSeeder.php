<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create(['name'=>'Admin']);
        Role::create(['name'=>'Veterinario']);
        Role::create(['name'=>'Peluquero']);
        Role::create(['name'=>'Inventario']);
        Role::create(['name'=>'Cliente']);

        Permission::create(['name'=>'admin.usuarios.index']);

    }
}
