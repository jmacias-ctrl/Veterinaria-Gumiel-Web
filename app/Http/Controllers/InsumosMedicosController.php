<?php

namespace App\Http\Controllers;

use App\Models\insumos_medicos;
use App\Models\Tipoinsumos;
use App\Models\MarcaInsumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Tipoinsumo;
use Illuminate\Support\Facades\DB;
use DataTables;


class InsumosMedicosController extends Controller
{
    

    public function index_insumos()
    {
        $tipoinsumos = Tipoinsumos::all();
        $marcaInsumos = MarcaInsumo::all();
        $insumos_medicos = insumos_medicos::with('tipoinsumos', 'marcaInsumos')->get();
        return view('admin.insumos_medicos.insumos', compact('tipoinsumos', 'marcaInsumos','insumos_medicos'));
    }

    public function create()
    {   
        $tipoinsumos = Tipoinsumos::all();
        $marcasInsumos = MarcaInsumo::all();
        return view('admin.insumos_medicos.create',compact('tipoinsumos', 'marcasInsumos'));
    }

    public function store(Request $request)
    {   
        $rules = [
            'nombre'=>'required|string',
            'marca'=>'required',
            'id_tipo'=>'required',
            'stock'=>'requierd',
        ];
        $attribute = [
            'nombre'=>'Nombre',
            'marca'=>'Marca',
            'id_tipo'=>'Tipo',
            'stock'=>'Stock',
        ];
        $message = [
            'required'=>':attribute es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if($validator->passes()){
            $tipoinsumos = Tipoinsumos::all();
            $insumos_medicos = new insumos_medicos;
            $insumos_medicos->nombre = $request->input('nombre');
            $insumos_medicos->id_marca = $request->input('marca');
            $insumos_medicos->id_tipo = $request->input('id_tipo');
            $insumos_medicos->stock = $request->input('stock');
    
            $insumos_medicos->save();
            return redirect()->route('admin.insumos_medicos.index',compact('tipoinsumos'))->with('success', 'El insumo ' . $request->nombre . ' fue agregado de manera satisfactoria');
    
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request){
        $insumos_medicos = insumos_medicos::find($request->id);
        $insumos_medicos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $insumos_medicos = insumos_medicos::find($request->id);
        $tipoinsumos = Tipoinsumos::all();
        $marcasInsumos = MarcaInsumo::all();
        return view('admin.insumos_medicos.edit',compact('insumos_medicos','tipoinsumos', 'marcasInsumos'));
    }

    public function update(Request $request)
    {
        $tipoinsumos = Tipoinsumos::all();
        $insumos_medicos = insumos_medicos::find($request->id);
        $insumos_medicos->nombre = $request->input('nombre');
        $insumos_medicos->id_marca = $request->input('marca');
        $insumos_medicos->id_tipo = $request->input('id_tipo');
        $insumos_medicos->stock = $request->input('stock');
        $insumos_medicos->save();
        return redirect()->route('admin.insumos_medicos.index')->with('success', 'El insumo medico ' . $request->nombre . ' fue modificado de manera satisfactoria');
    }
}
