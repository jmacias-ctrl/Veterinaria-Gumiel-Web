<?php

namespace App\Http\Controllers;

use App\Models\tipo_consulta_tamanios;
use App\Models\tiposervicios;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class tipo_consulta_tamanioController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = tipo_consulta_tamanios::with('tiposervicios')->get()->map(function($tipoconsulta_tam){
                $tipoconsulta_tam->tiposervicio_id = $tipoconsulta_tam->tiposervicios->nombre;
                $tipoconsulta_tam->precio = '$'.number_format($tipoconsulta_tam->precio, 0, ',', '.');
                return $tipoconsulta_tam;
            });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action','admin.Tipoconsulta_tamanio.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $tipoconsultas_tam = tipo_consulta_tamanios::with('tiposervicios')->get();
        return view('admin.Tipoconsulta_tamanio.tipoconsulta_tamanio', compact('tipoconsultas_tam'));
    }

    public function create()
    {
        $tiposervicios = tiposervicios::all();
        return view('admin.tipoconsulta_tamanio.create', compact('tiposervicios'));
    }

    public function store(Request $request){
        $rule = [
            'nombre'=>'required|string',
            'duracion'=>'required|integer',
            'tiposervicio_id'=>'required'
        ];
        $atrribute =[
            'nombre' => 'Nombre',
            'duracion'=> 'Duración',
            'tiposervicio_id'=>'tiposervicio_id'
        ];
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message, $atrribute);
        
        if ($validator->passes()) {
            $tiposervicios = tiposervicios::all();
            $tipoconsulta_tam = new tipo_consulta_tamanios();
            $tipoconsulta_tam->nombre = $request->input('nombre');
            $tipoconsulta_tam->duracion = $request->input('duracion');
            $tipoconsulta_tam->tiposervicio_id = $request->input('tiposervicio_id');

            $tipoconsulta_tam->save();
            return redirect()->route('admin.tipoconsulta_tamanio.index', compact('tiposervicios'))->with('success', 'El tipo de consulta/Tamaño ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $tipoconsulta_tam = tipo_consulta_tamanios::find($request->id);
        $tipoconsulta_tam->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $tipoconsulta_tam = tipo_consulta_tamanios::find($request->id);
        $tiposervicios = tiposervicios::all();
        return view('admin.tipoconsulta_tamanio.edit', compact('tipoconsulta_tam', 'tiposervicios'));
    }

    public function update(Request $request){
        $rule = [
            'nombre'=>'required|string',
            'duracion'=>'required|integer',
            'tiposervicio_id'=>'required'
        ];
        $atrribute =[
            'nombre' => 'Nombre',
            'duracion'=> 'Duración',
            'tiposervicio_id'=>'tiposervicio_id'
        ];
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message, $atrribute);
        
        if ($validator->passes()) {
            $tiposervicios = tiposervicios::all();
            $tipoconsulta_tam = tipo_consulta_tamanios::find($request->id);
            $tipoconsulta_tam->nombre = $request->input('nombre');
            $tipoconsulta_tam->duracion = $request->input('duracion');
            $tipoconsulta_tam->tiposervicio_id = $request->input('tiposervicio_id');

            $tipoconsulta_tam->save();
            return redirect()->route('admin.tipoconsulta_tamanio.index')->with('success', 'El tipo de consulta/Tamaño ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}
