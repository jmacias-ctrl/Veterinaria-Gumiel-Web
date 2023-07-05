<?php

namespace Database\Seeders;

use App\Models\whereYouCanFind;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class whereYouCanFindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //php artisan migrate:fresh --seed

    public function run()
    {
        whereYouCanFind::create([
            'id' => 0,
            'nombre' => 'Veterinaria Gumiel',
            'direccion' => 'Villagran 437, Cañete, Chile.',
            'horario_header' => 'Lunes a Viernes : 09:30 AM a 14:00 PM - 15:00 PM - 19:00 PM',
            'telefono'=> '977088874',
            'correo' => 'veterinariagumiel@gmail.com',
            'instagram'=> 'https://www.instagram.com/vetgumiel/?igshid=YmMyMTA2M2Y%3D', 
            'facebook'=> 'https://m.facebook.com/p/Cl%C3%ADnica-Veterinaria-Gumiel-100083250432886/?_rdr', 
            'whatsapp'=> 'https://api.whatsapp.com/send?phone=56977088874&text=Habla%20con%20nosotros!', 
            'twitter'=> null,
        ]);
    }
}
