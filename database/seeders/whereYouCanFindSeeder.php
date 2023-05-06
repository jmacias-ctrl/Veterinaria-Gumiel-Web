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
    public function run()
    {
        WhereYouCanFind::create([
            'id' => 0,
            'direccion' => 'Villagran 437,Cañete,Chile.', 
            'telefono'=> '56977088874', 
            'horarios'=> 'Lunes a Domingos y Festivos
            09:30 - 14:00 hrs
            15:00 - 19:00 hrs', 
            'instagram'=> 'https://www.instagram.com/vetgumiel/?igshid=YmMyMTA2M2Y%3D', 
            'facebook'=> 'https://m.facebook.com/p/Cl%C3%ADnica-Veterinaria-Gumiel-100083250432886/?_rdr', 
            'whatsapp'=> 'https://api.whatsapp.com/send?phone=56977088874&text=Habla%20con%20nosotros!', 
        ]);
    }
}
