<?php

namespace Database\Seeders;

use App\Models\productos_ventas;
use Illuminate\Database\Seeder;
use App\Models\Marcaproducto;

class ProductosVentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marcaproducto::create([
            'nombre'=>'Drag Pharma',
        ]);
        Marcaproducto::create([
            'nombre'=>'Generico',
        ]);
        Marcaproducto::create([
            'nombre'=>'OEM',
        ]);
        Marcaproducto::create([
            'nombre'=>'Seresto',
        ]);
        productos_ventas::create([
            'nombre' => 'COLONIA ANIMAL HEALTH AMARILLA 150 ML',
            'id_marca' => 1,
            'codigo'=> 98432742,
            'descripcion' => 'Colonia para perros con naturales acordes florales y toques de envolvente calidez. Fragancia especialmente formulada para cachorros desde los 2 meses de edad. No altera el olfato del animal.',
            'id_tipo' =>  1, 
            'slug'=>'Colonia-Health-Amarilla-150',
            'min_stock'=>'5',
            'stock' => '18',
            'producto_enfocado' => 2,
            'precio' => 3499,
            'imagen_path' => 'colonia-amarilla.png'
        ]);
        productos_ventas::create([
            'nombre' => 'Arnes de cuerpo para perros incluye correa talla s macho',
            'id_marca' => 2,
            'codigo'=> 49301232,
            'descripcion' => 'Arnés para razas pequeñas con reflectante. Con Anillo en forma D para ajustar Correa.Material reflectante y colores visibles en la noche para la seguridad de tu mascota.',
            'id_tipo' => 1, 
            'slug'=>'Arnes-Cuerpo-Perro-S',
            'min_stock'=>'5',
            'stock' => '30',
            'producto_enfocado' => 2,
            'precio' => 5999,
            'imagen_path' => 'arnes-perro.png'
        ]);
        productos_ventas::create([
            'nombre' => 'Correa Automática Perros correa extensible de Mascota',
            'id_marca' => 3,
            'codigo'=> 213123,
            'descripcion' => 'Camina libremente con tu mascota en un área abierta con un sistema de frenado, liberación y retroceso manual, que permite ajustar la correa a una longitud cómoda y con facilidad. La correa retráctil extiende un máximo de hasta 5 metros. fuerte y duradera, hecha para uso diario, con un resorte fuerte para retracción suave de correa de perro. Camina a un ritmo que tanto tú como tu perro disfruten, mantén la correa retráctil de esa manera pulsando el botón hasta abajo para bloquear la correa.',
            'slug'=>'Correa-Automatica-Perro-Extensible',
            'id_tipo' => 1,
            'min_stock'=>'5',
            'stock' => '30',
            'producto_enfocado' => 2,
            'precio' => 6499,
            'imagen_path' => 'correa-automatica.png'
        ]);
        productos_ventas::create([
            'nombre' => 'Collar Perro pequeño 38 cm 8 Meses De Duración',
            'codigo'=> 3823124,
            'id_marca' => 4,
            'slug'=>'Collar-Perro-38',
            'descripcion' => 'El collar de acaba con las pulgas de tu perro y sus larvas del entorno, y repele y elimina las garrapatas. es distinto de los collares convencionales contra pulgas y garrapatas. Utiliza una novedosa combinación de materiales que permite la liberación controlada de dosis adecuadas de los principios activos hasta 8 meses. Esto confiere una excelente protección de tu perro, no solo porque mata las pulgas y garrapatas, sino también porque repele las garrapatas antes de que le lleguen a picar e ingerir sangre, lo que ayuda a proteger a tu mascota de las enfermedades que estos parásitos pueden transmitir.',
            'id_tipo' => 1, 
            'min_stock'=>'5',
            'stock' => '20',
            'producto_enfocado' => 2,
            'precio' => 34990,
            'imagen_path' => 'seresto-collar.png'
        ]);
        productos_ventas::factory(35)->create();
}
}