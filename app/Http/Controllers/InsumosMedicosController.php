<?php

namespace App\Http\Controllers;

use App\Models\insumos_medicos;
use Illuminate\Http\Request;

class InsumosMedicosController extends Controller
{
    public function index_insumos()
    {
        $insumos_medicos = insumos_medicos::all();

        return view('admin.insumos_medicos.insumos', compact('insumos_medicos'));
    }

    public function create()
    {
        return view('admin.insumos_medicos.create');
    }

    public function store(Request $request)
    {
        $insumos = request()->except('_token');


        return response()->json($insumos);
    }
}
