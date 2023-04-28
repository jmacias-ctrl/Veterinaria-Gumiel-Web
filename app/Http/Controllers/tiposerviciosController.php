<?php

namespace App\Http\Controllers;

use App\Models\tiposervicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tiposerviciosController extends Controller
{
    public function index()
    {
        $tiposervicios = tiposervicios::all();
        return view('admin.tiposervicios.tiposervicios', compact('tiposervicios'));
    }

    public function create()
    {
        return view('admin.tiposervicios.create');
    }

    public function store(Request $request){
        $rule = [
            'nombre'=>'required|string',
        ];
        
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if($validator->passes()){
            $tiposervicios = tiposervicios::create(['nombre'=>$request->nombre]);
            return redirect()->route('admin.tiposervicios.index')->with('success', 'El tipo de servicio ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request){
        $tiposervicios = tiposervicios::find($request->id);
        $tiposervicios->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $tiposervicios = tiposervicios::find($request->id);
        return view('admin.tiposervicios.edit',compact('tiposervicios'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre'=>'required|string',
        ];
        
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if($validator->passes()){
            $tiposervicios = tiposervicios::find($request->id);
            $tiposervicios->nombre = $request->nombre;
            $tiposervicios->save();
            return redirect()->route('admin.tiposervicios.index')->with('success', 'El tipo de servicio ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}
