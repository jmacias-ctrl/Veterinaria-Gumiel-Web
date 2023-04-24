<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcasController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required'
        ]);

        $marca=new Marca;
        $marca->nombre=$request->nombre;
        $marca->save();

        return redirect()->route('marcas')->with('success','Marca guardada correctamente');

    }

    public function index(){
        $marcas = Marca::all();
        return view('marcas.index', ['marcas' => $marcas]);
    }

    public function show($id){
        $marca = Marca::find($id);
        return view('marcas.show', ['marca' => $marca]);
    }

    public function update(Request $request, $id){
        $marca = Marca::find($id);
        $marca->nombre=$request->nombre;
        $marca->save();
        return redirect()->route('marcas')->with('success','Marca actualizada');
        //return view('marcas.index', ['success' => 'Marca actualizada ']);
    }

    public function destroy($id){
        $marca = Marca::find($id);
        $marca->delete();
        return redirect()->route('marcas')->with('success','Marca eliminada');
        
    }
}
