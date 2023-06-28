<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function guardarDatosMascota(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'id_cliente' => 'required',
            'nombre' => 'required',
            'especie' => 'required',
            'sexo' => 'required',
            'fecha_nacimiento' => 'required',
        ]);

        // Crear una nueva instancia del modelo Mascota y asignar los valores recibidos
        $mascota = new Mascota();
        $mascota->id_cliente = $request->input('id_cliente');
        $mascota->nombre = $request->input('nombre');
        $mascota->id_especie = $request->input('especie');
        $mascota->sexo = $request->input('sexo');
        $mascota->fecha_nacimiento = $request->input('fecha_nacimiento');

        // Guardar la mascota en la base de datos
        $mascota->save();

        $notification = 'La mascota se registro correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
    }
}
