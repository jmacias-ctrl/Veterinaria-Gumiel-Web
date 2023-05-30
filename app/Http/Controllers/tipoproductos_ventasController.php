<?php

namespace App\Http\Controllers;

use App\Models\tipoproductos_ventas;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tipoproductos_ventasController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = tipoproductos_ventas::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action','admin.tipoproductos_ventas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $tipoproductos_ventas = tipoproductos_ventas::all();
        return view('admin.tipoproductos_ventas.tipoproductos_ventas', compact('tipoproductos_ventas'));
    }

    public function create()
    {
        return view('admin.tipoproductos_ventas.create');
    }

    public function store(Request $request){
        $rule = [
            'nombre'=>'required|string',
        ];
        
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if($validator->passes()){
            $tipoproductos_ventas = tipoproductos_ventas::create(['nombre'=>$request->nombre]);
            return redirect()->route('admin.tipoproductos_ventas.index')->with('success', 'El tipo de producto ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request){
        $tipoproductos_ventas = tipoproductos_ventas::find($request->id);
        $tipoproductos_ventas->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $tipoproductos_ventas = tipoproductos_ventas::find($request->id);
        return view('admin.tipoproductos_ventas.edit',compact('tipoproductos_ventas'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre'=>'required|string',
        ];
        
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if($validator->passes()){
            $tipoproductos_ventas = tipoproductos_ventas::find($request->id);
            $tipoproductos_ventas->nombre = $request->nombre;
            $tipoproductos_ventas->save();
            return redirect()->route('admin.tipoproductos_ventas.index')->with('success', 'El tipo de producto ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}