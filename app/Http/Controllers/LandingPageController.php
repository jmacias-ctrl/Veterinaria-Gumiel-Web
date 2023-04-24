<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function index2()
    {
        // $configuracion = Configuracion::all();
        // return view('pagina', ['configuracion' => $configuracion]);
    }
}
