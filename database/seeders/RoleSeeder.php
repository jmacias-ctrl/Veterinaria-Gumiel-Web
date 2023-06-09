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

        Permission::create(['name'=>'ver categorias']);
        Permission::create(['name'=>'ingresar categorias']);
        Permission::create(['name'=>'modificar categorias']);
        Permission::create(['name'=>'eliminar categorias']);

        Permission::create(['name'=>'ver subcategorias']);
        Permission::create(['name'=>'ingresar subcategorias']);
        Permission::create(['name'=>'modificar subcategorias']);
        Permission::create(['name'=>'eliminar subcategorias']);

        Permission::create(['name'=>'ver especies']);
        Permission::create(['name'=>'ingresar especies']);
        Permission::create(['name'=>'modificar especies']);
        Permission::create(['name'=>'eliminar especies']);

        Permission::create(['name'=>'ver medicamentos vacunas']);
        Permission::create(['name'=>'ingresar medicamentos vacunas']);
        Permission::create(['name'=>'modificar medicamentos vacunas']);
        Permission::create(['name'=>'eliminar medicamentos vacunas']);

        Permission::create(['name'=>'ver proveedores']);
        Permission::create(['name'=>'ingresar proveedores']);
        Permission::create(['name'=>'modificar proveedores']);
        Permission::create(['name'=>'eliminar proveedores']);

        Permission::create(['name'=>'ver citas']);
        Permission::create(['name'=>'modificar citas']);
        Permission::create(['name'=>'eliminar citas']);
        
        Permission::create(['name'=>'modificar landing page']);

        Permission::create(['name'=>'ver gestionvet']);
        Permission::create(['name'=>'ver gestionpeluqueria']);
        Permission::create(['name'=>'ver estadisticas']);

        Permission::create(['name'=>'ver citasvet']);

        Permission::create(['name'=>'acceso administracion de stock']);
        Permission::create(['name'=>'acceso punto de venta']);
        Permission::create(['name'=>'acceso ventas']);

        Role::create(['name'=>'Admin'])->syncPermissions(['modificar landing page','ver roles','modificar roles','ingresar roles','eliminar proveedores','modificar proveedores','ingresar proveedores','ver proveedores','acceso punto de venta','acceso ventas','acceso administracion de stock','eliminar roles','ver usuario','ingresar usuario','eliminar usuario','asignar roles usuario','ver subcategorias','ingresar subcategorias', 'modificar subcategorias', 'eliminar subcategorias','ver categorias','ingresar categorias', 'modificar categorias', 'eliminar categorias','ver especies','ingresar especies', 'modificar especies', 'eliminar especies','ver medicamentos vacunas','ingresar medicamentos vacunas', 'modificar medicamentos vacunas', 'eliminar medicamentos vacunas','acceder panel','ver productos', 'modificar productos', 'eliminar productos', 'ingresar productos','ver servicios','ingresar servicios','modificar servicios', 'eliminar servicios', 'ver insumos medicos', 'ingresar insumos medicos', 'modificar insumos medicos', 'eliminar insumos medicos','ver estadisticas']);
        Role::create(['name'=>'Veterinario'])->syncPermissions(['acceder panel', 'ver gestionvet','ver estadisticas']);
        Role::create(['name'=>'Peluquero'])->syncPermissions(['ver gestionpeluqueria','acceder panel','ver gestionvet','ver estadisticas']);
        Role::create(['name'=>'Inventario'])->syncPermissions(['ver proveedores','ingresar proveedores','modificar proveedores','eliminar proveedores','acceso punto de venta','acceso ventas','acceder panel','ver estadisticas', 'acceso administracion de stock']);
        Role::create(['name'=>'Cliente'])->syncPermissions(['acceder panel','ver citasvet']);
        Role::create(['name'=>'Invitado']);
        Role::create(['name'=>'RolePrueba1'])->syncPermissions(['acceder panel','ver productos', 'modificar productos', 'eliminar productos', 'ingresar productos']);
        Role::create(['name'=>'RolePrueba2'])->syncPermissions(['acceder panel','ver servicios', 'modificar servicios', 'eliminar servicios', 'ingresar servicios']);

        Permission::create(['name'=>'admin.usuarios.index']);

    }
}
