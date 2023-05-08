<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\servicios;
use App\Models\tiposervicios;
use Illuminate\Support\Facades\Validator;



class ServicioController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = servicios::with('tiposervicios')->get()->map(function($servicio){
            $servicio->id_tipo = $servicio->tiposervicios->nombre;
            return $servicio;
        });
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', 'admin.servicio.datatable.action')
            ->rawColumns(['action'])
            ->toJson();
    }
    $servicios=servicios::with('tiposervicios')->get();
    return view('admin.servicio.servicio', compact('servicios'));
}

    public function create()
    {
        $tiposervicios = tiposervicios::all();
        return view('admin.servicio.create', compact('tiposervicios'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'id_tipo' => 'required',
            'precio' => 'required',
        ];
        $attribute = [
            'nombre' => 'Nombre',
            'id_tipo' => 'Tipo',
            'precio' => 'Precio',
        ];
        $message = [
            'required' => ':attribute es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $tiposervicios = tiposervicios::all();
            $servicio = new servicios;
            $servicio->nombre = $request->input('nombre');
            $servicio->id_tipo = $request->input('id_tipo');
            $servicio->precio = $request->input('precio');

            $servicio->save();
            return redirect()->route('admin.servicio', compact('tiposervicios'))->with('success', 'El servicio ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $servicio = servicios::find($request->id);
        $servicio->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $servicio = servicios::find($request->id);
        $tiposervicios = tiposervicios::all();
        return view('admin.servicio.edit', compact('servicio', 'tiposervicios'));
    }

    public function update(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'id_tipo' => 'required',
            'precio' => 'required',
        ];
        $attribute = [
            'nombre' => 'Nombre',
            'id_tipo' => 'Tipo',
            'precio' => 'Precio',
        ];
        $message = [
            'required' => ':attribute es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $tiposervicios = tiposervicios::all();
            $servicio = servicios::find($request->id);
            $servicio->nombre = $request->input('nombre');
            $servicio->id_tipo = $request->input('id_tipo');
            $servicio->precio = $request->input('precio');
            $servicio->save();
            return redirect()->route('admin.servicio')->with('success', 'El servicio ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}
