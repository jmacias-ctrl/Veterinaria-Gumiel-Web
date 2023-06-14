<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            'title1' => '¿Quiénes somos?',
            'paragraph1' => 'Somos un equipo de profesionales veterinarios altamente capacitados y apasionados por nuestro trabajo, comprometidos con la salud y el bienestar de tus mascotas. Nuestra veterinaria está lista para atender a tu amigo peludo con los cuidados que merece, proporcionando un servicio excepcional y una experiencia única para ti y tus animales.',
            'title2' => '¿Qué estamos haciendo?',
            'paragraph2' => 'Ofrecemos servicios de Consultas Médicas, Vacunaciones, Cirugías y Exámenes de Laboratorio, todos diseñados para mantener a sus mascotas felices, saludables y activas. Nos enorgullece ofrecer una amplia variedad de opciones de tratamiento y atención para asegurarnos de que su mascota reciba la atención que se merece.',
            'title3' => '¿Hacia dónde apuntamos?',
            'paragraph3' => 'En nuestra veterinaria, apuntamos a ser líderes en el cuidado y atención de las mascotas y animales en nuestra comunidad. Nos esforzamos por estar a la vanguardia de la tecnología y la investigación para ofrecer los mejores tratamientos y opciones de cuidado para nuestros clientes y sus animales. Estamos comprometidos con el bienestar de sus mascotas y animales, y estamos aquí para brindarles el mejor servicio y atención posible. ¡Gracias por confiar en nosotros para el cuidado de sus seres queridos peludos!',
        ]);
    }
}
