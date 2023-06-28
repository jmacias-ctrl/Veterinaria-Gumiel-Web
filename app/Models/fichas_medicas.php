<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Mascota;
use App\Models\ReservarCitas;

use Faker\Factory as FakerFactory;

class fichas_medicas extends Model
{
    use HasFactory;

    protected $table = 'fichas_medicas';

    protected $fillable = [
        'id',
        'id_mascota',
        'id_hora_reservada',
        'peso_mascota',
        'edad',
        'observacion',
        'procedimiento',
        'created_at',
        'updated_at'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'id_mascota');
    }

    public function horaReservada()
    {
        return $this->belongsTo(ReservarCitas::class, 'id_hora_reservada');
    }


    // public function run()
    // {
    //     $faker = FakerFactory::create();

    //     for ($i = 0; $i < 10; $i++) {
    //         $ficha = new fichas_medicas();
    //         $ficha->nombre = $faker->firstName;
    //         $ficha->raza = $faker->randomElement(['Labrador', 'Poodle', 'Bulldog', 'Persa']);
    //         $ficha->edad = $faker->numberBetween(1, 10);
    //         $ficha->peso = $faker->randomFloat(1, 2, 30);
    //         $ficha->save();
    //     }
    // }
}
