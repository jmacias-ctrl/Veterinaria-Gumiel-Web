<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;



class ServicioController extends Controller
{
    public function index()
    {
        $servicio = Servicio::all();
        $tiposervicios = ['Tipo 1', 'Tipo 2', 'Tipo 3']; // Esto es solo un ejemplo, debe obtener los tipos de servicio de su base de datos

        return view('servicio', compact('servicio', 'tiposervicios'));
    }
}

Route::get('/servicio', [ServicioController::class, 'index'])->name('admin.servicio');
