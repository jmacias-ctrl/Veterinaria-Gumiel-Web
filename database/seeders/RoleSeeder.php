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

        Permission::create(['name'=>'acceder panel']);

        Permission::create(['name'=>'ver usuario']);
        Permission::create(['name'=>'ingresar usuario']);
        Permission::create(['name'=>'eliminar usuario']);
        Permission::create(['name'=>'asignar roles usuario']);
        
        Permission::create(['name'=>'ver roles']);
        Permission::create(['name'=>'ingresar roles']);
        Permission::create(['name'=>'modificar roles']);
        Permission::create(['name'=>'eliminar roles']);

        Permission::create(['name'=>'ver productos']);
        Permission::create(['name'=>'ingresar productos']);
        Permission::create(['name'=>'modificar productos']);
        Permission::create(['name'=>'eliminar productos']);

        Permission::create(['name'=>'ver servicios']);
        Permission::create(['name'=>'ingresar servicios']);
        Permission::create(['name'=>'modificar servicios']);
        Permission::create(['name'=>'eliminar servicios']);

        Permission::create(['name'=>'ver insumos medicos']);
        Permission::create(['name'=>'ingresar insumos medicos']);
        Permission::create(['name'=>'modificar insumos medicos']);
        Permission::create(['name'=>'eliminar insumos medicos']);

        Permission::create(['name'=>'ver citas']);
        Permission::create(['name'=>'modificar citas']);
        Permission::create(['name'=>'eliminar citas']);
        Permission::create(['name'=>'ver medicamentos vacunas']);

        Permission::create(['name'=>'ver gestionvet']);

        Permission::create(['name'=>'ver estadisticas']);

        Permission::create(['name'=>'ver citasvet']);

        Role::create(['name'=>'Admin'])->syncPermissions(['ver medicamentos vacunas','acceder panel','ver productos', 'modificar productos', 'eliminar productos', 'ingresar productos','ver servicios','ingresar servicios','modificar servicios', 'eliminar servicios', 'ver insumos medicos', 'ingresar insumos medicos', 'modificar insumos medicos', 'eliminar insumos medicos','ver estadisticas']);
        Role::create(['name'=>'Veterinario'])->syncPermissions(['acceder panel', 'ver gestionvet','ver estadisticas']);
        Role::create(['name'=>'Peluquero'])->syncPermissions(['acceder panel','ver gestionvet','ver estadisticas']);
        Role::create(['name'=>'Inventario'])->syncPermissions(['acceder panel','ver estadisticas']);
        Role::create(['name'=>'Cliente'])->syncPermissions(['acceder panel','ver citasvet']);
        Role::create(['name'=>'RolePrueba1'])->syncPermissions(['acceder panel','ver productos', 'modificar productos', 'eliminar productos', 'ingresar productos']);
        Role::create(['name'=>'RolePrueba2'])->syncPermissions(['acceder panel','ver servicios', 'modificar servicios', 'eliminar servicios', 'ingresar servicios']);

        Permission::create(['name'=>'admin.usuarios.index']);

    }
}
