<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservarCitasController extends Controller
{
    public function create(){
        return view('ReservarCitas.create');
    }
}
