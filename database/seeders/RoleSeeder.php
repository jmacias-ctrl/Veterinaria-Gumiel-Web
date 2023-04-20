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

        Permission::create(['name'=>'ver productos']);
        Permission::create(['name'=>'modificar productos']);
        Permission::create(['name'=>'eliminar productos']);

        Permission::create(['name'=>'ver servicios']);
        Permission::create(['name'=>'modificar servicios']);
        Permission::create(['name'=>'eliminar servicios']);

        Permission::create(['name'=>'ver citas']);
        Permission::create(['name'=>'modificar citas']);
        Permission::create(['name'=>'eliminar citas']);

        Role::create(['name'=>'Admin'])->syncPermissions(['ver productos', 'modificar productos', 'eliminar productos', 'modificar servicios', 'eliminar servicios']);
        Role::create(['name'=>'Veterinario']);
        Role::create(['name'=>'Peluquero']);
        Role::create(['name'=>'Inventario']);
        Role::create(['name'=>'Cliente']);

        Permission::create(['name'=>'admin.usuarios.index']);

    }
}
