<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\tipoproductos_ventas;

class tipoproductos_ventasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipoproductos_ventas::create([
            'nombre' => 'Accesorios'
        ]);
        
        tipoproductos_ventas::create([
            'nombre' => 'Juguetes'
        ]);
        tipoproductos_ventas::create([
            'nombre' => 'Alimentos'
        ]);
        tipoproductos_ventas::create([
            'nombre' => 'Medicamentos'
        ]);
    }
}