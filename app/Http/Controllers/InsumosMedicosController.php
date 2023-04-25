<?php

namespace App\Http\Controllers;

use App\Models\insumos_medicos;
use App\Models\Tipoinsumos;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Tipoinsumo;
use Illuminate\Support\Facades\DB;
use DataTables;


class InsumosMedicosController extends Controller
{
    

    public function index_insumos()
    {
        $tipoinsumos = Tipoinsumos::all();
        $insumos_medicos = insumos_medicos::with('tipoinsumos')->get();
        return view('admin.insumos_medicos.insumos', compact('tipoinsumos','insumos_medicos'));
    }

    public function create()
    {   
        $tipoinsumos = Tipoinsumos::all();
        return view('admin.insumos_medicos.create',compact('tipoinsumos'));
    }

    public function store(Request $request)
    {   
        $tipoinsumos = Tipoinsumos::all();
        $insumos_medicos = new insumos_medicos;
        $insumos_medicos->nombre = $request->input('nombre');
        $insumos_medicos->marca = $request->input('marca');
        $insumos_medicos->id_tipo = $request->input('id_tipo');
        $insumos_medicos->stock = $request->input('stock');

        $insumos_medicos->save();
        return Redirect()->route('admin.insumos_medicos.index',compact('tipoinsumos'));

    }

    public function delete(Request $request){
        $insumos_medicos = insumos_medicos::find($request->id);
        $insumos_medicos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $insumos_medicos = insumos_medicos::find($request->id);
        $tipoinsumos = Tipoinsumos::all();
        return view('admin.insumos_medicos.edit',compact('insumos_medicos','tipoinsumos'));
    }

    public function update(Request $request)
    {
        $tipoinsumos = Tipoinsumos::all();
        $insumos_medicos = insumos_medicos::find($request->id);
        $insumos_medicos->nombre = $request->input('nombre');
        $insumos_medicos->marca = $request->input('marca');
        $insumos_medicos->id_tipo = $request->input('id_tipo');
        $insumos_medicos->stock = $request->input('stock');
        $insumos_medicos->save();
        return redirect()->route('admin.insumos_medicos.index');
    }
}
