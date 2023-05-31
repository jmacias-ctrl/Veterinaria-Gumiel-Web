<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\proveedores;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = proveedores::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action','proveedores.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('proveedores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.crear');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ([
            'nombre' => 'required',
        ]);
        $attributes = ([
            'nombre' => 'Nombre',
        ]);
        $message = ([
            'required' => ':attribute es obligatorio.',
        ]);
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $proveedor = new proveedores();
            $proveedor->nombre = $request->input('nombre');
            $proveedor->save();

            return redirect()->route('proveedores.index')->with('success', 'Proveedor agregado exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = proveedores::find($id);
        return view('proveedores.editar', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = ([
            'nombre' => 'required',
        ]);
        $attributes = ([
            'nombre' => 'Nombre',
        ]);
        $message = ([
            'required' => ':attribute es obligatorio.',
        ]);
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $proveedor = proveedores::find($request->id);
            $proveedor->nombre = $request->input('nombre');
            $proveedor->save();
            return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente');
        }
        return back()->withErrors($validator)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $proveedor = proveedores::findOrFail($request->id);
        $proveedor->delete();

        return response()->json(['success' => true], 200);
    }
}
