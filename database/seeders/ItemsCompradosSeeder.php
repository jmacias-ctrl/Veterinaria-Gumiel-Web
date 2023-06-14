<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\items_comprados;

class ItemsCompradosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        productos_ventas::create([
            'nombre' => 'COLONIA ANIMAL HEALTH AMARILLA 150 ML',
            'id_marca' => 1,
            'codigo' => 98432742,
            'descripcion' => 'Colonia para perros con naturales acordes florales y toques de envolvente calidez. Fragancia especialmente formulada para cachorros desde los 2 meses de edad. No altera el olfato del animal.',
            'id_tipo' =>  1,
            'slug' => 'Colonia-Health-Amarilla-150',
            'min_stock' => '5',
            'stock' => '18',
            'producto_enfocado' => 2,
            'precio' => 3499,
            'imagen_path' => 'colonia-amarilla.png'
        ]);

        items_comprados::factory(50)->create();
    }
}
