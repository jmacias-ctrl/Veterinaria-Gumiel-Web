<?php

namespace App\Http\Controllers;

use App\Models\Marcaproducto;
use Illuminate\Http\Request;

/**
 * Class MarcaproductoController
 * @package App\Http\Controllers
 */
class MarcaproductoController extends Controller
{

    public function index_marca()
    {
        $marcaproductos = Marcaproducto::all();
        return view('admin.marcaproductos.marcaproductos',compact('marcaproductos'));
    }

    public function create()
    {
        return view('admin.marcaproductos.create');
    }

    public function store(Request $request)
    {
        // request()->validate(Marcaproducto::$rules);

        // $marcaproducto = Marcaproducto::create($request->all());

        // return redirect()->route('marcaproductos.index')
        //     ->with('success', 'Marcaproducto created successfully.');

        $marcaproductos = Marcaproducto::create(['nombre'=>$request->nombre]);
        return redirect()->route('admin.marcaproductos.index');
    }
   
    public function delete(Request $request){
        $marcaproductos = Marcaproducto::find($request->id);
        $marcaproductos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $marcaproductos = Marcaproducto::find($request->id);
        return view('admin.marcaproductos.edit', compact('marcaproductos'));
    }

    public function update(Request $request)
    {
        $marcaproductos = Marcaproducto::find($request->id);
        $marcaproductos->nombre = $request->nombre;
        $marcaproductos->save();
        return redirect()->route('admin.marcaproductos.index');
    }
}
