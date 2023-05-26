<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrazabilidadController extends Controller
{
    // public function index(Request $request)
    // {
    //     return view('admin.tiposervicios.tiposervicios', compact('tiposervicios'));
    // }

    public function generarTrazabiliadVentasYServicios()
    {
        return view('trazabilidad.trazabilidad-main');
    }
}
