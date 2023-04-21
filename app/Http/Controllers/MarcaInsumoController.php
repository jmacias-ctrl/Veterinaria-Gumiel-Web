<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaInsumo;

/**
 * Class MarcaInsumoController
 * @package App\Http\Controllers
 */
class MarcaInsumoController extends Controller
{

    public function index_marca()
    {
        $marcaInsumo = MarcaInsumo::all();
        return view('admin.marcaInsumo.marcaInsumo',compact('marcaInsumo'));
    }

    public function create()
    {
        return view('admin.marcaInsumo.create');
    }

    public function store(Request $request)
    {

        $marcaInsumo = MarcaInsumo::create(['nombre'=>$request->nombre]);
        return redirect()->route('admin.marcaInsumos.index');
    }
   
    public function delete(Request $request){
        $marcaInsumo = MarcaInsumo::find($request->id);
        $marcaInsumo->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $marcaInsumo = MarcaInsumo::find($request->id);
        return view('admin.marcaInsumo.edit', compact('marcaInsumo'));
    }

    public function update(Request $request)
    {
        $marcaInsumo = MarcaInsumo::find($request->id);
        $marcaInsumo->nombre = $request->nombre;
        $marcaInsumo->save();
        return redirect()->route('admin.marcaInsumos.index');
    }
}
