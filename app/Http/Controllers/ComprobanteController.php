<?php

namespace App\Http\Controllers;
use App\Models\Comprobante;

use Illuminate\Http\Request;

class ComprobanteController extends Controller
{
    // public function show($id)
    // {
    //     $comprobante = Comprobante::findOrFail($id);
    //     return view('comprobante', ['comprobante' => $comprobante]);
    // }

    public function generarComprobante(){
        $comprobante = new Comprobante(); // cambiarlo por la instancia de una cosa real
        $comprobante->numero = '0001';
        $comprobante->fecha = '2021-10-01';
        $comprobante->cliente = 'Juan Perez';
        $comprobante->monto = '100.00';
        return view('comprobante', ['comprobante' => $comprobante]);
    }
}
