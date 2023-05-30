<?php

namespace App\Http\Controllers;

use App\Models\Tipoinsumos;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


/**
 * Class TipoinsumoController
 * @package App\Http\Controllers
 */
class TipoinsumosController extends Controller
{
    public function index_tipo(Request $request)
    {
        if($request->ajax()){
            $data = tipoinsumos::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action','admin.tipoinsumos.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $tipoinsumos = Tipoinsumos::all();
        return view('admin.tipoinsumos.tipoinsumos', compact('tipoinsumos'));
    }

    public function create()
    {
        return view('admin.tipoinsumos.create');
    }

    public function store_tipo(Request $request){
        $rule = [
            'nombre'=>'required|string',
        ];
        $atrribute =[
            'nombre' => 'Nombre',
        ];
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message, $atrribute);
        if($validator->passes()){
            $tipoinsumos = Tipoinsumos::create(['nombre'=>$request->nombre]);
            return redirect()->route('admin.tipoinsumos.index')->with('success', 'El tipo de insumo ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request){
        $tipoinsumos = Tipoinsumos::find($request->id);
        $tipoinsumos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $tipoinsumos = Tipoinsumos::find($request->id);
        return view('admin.tipoinsumos.edit',compact('tipoinsumos'));
    }
    
    public function update(Request $request)
    {
        $rule = [
            'nombre'=>'required|string',
        ];
        $atrribute =[
            'nombre' => 'Nombre',
        ];
        $message = ['required'=>':attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message, $atrribute);
        if($validator->passes()){
            $tipoinsumos = Tipoinsumos::find($request->id);
            $tipoinsumos->nombre = $request->nombre;
            $tipoinsumos->save();
            return redirect()->route('admin.tipoinsumos.index')->with('success', 'El tipo de insumo ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}





