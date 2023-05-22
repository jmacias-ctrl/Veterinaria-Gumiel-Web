<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarcaMedicamentoController extends Controller
{
    public function index_marca(Request $request)
    {
        if($request->ajax()){
            $data = Marcamedicamentos_vacunas::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.marcamedicamentos_vacunas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $marcamedicamentos_vacunas = Marcamedicamentos_vacunas::all();
        return view('admin.marcamedicamentos_vacunas.marcamedicamentos_vacunas', compact('marcamedicamentos_vacunas'));
    }

    public function create()
    {
        return view('admin.marcamedicamentos_vacunas.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $marcamedicamentos_vacunas = Marcamedicamentos_vacunas::create(['nombre' => $request->nombre]);
            return redirect()->route('admin.marcamedicamentos_vacunas.index')->with('success', 'La marca de medicamento ' . $request->nombre . ' fue agregado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $marcamedicamentos_vacunas = Marcamedicamentos_vacunas::find($request->id);
        $marcamedicamentos_vacunas->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {

        $marcamedicamentos_vacunas = Marcamedicamentos_vacunas::find($request->id);
        return view('admin.marcamedicamentos_vacunas.edit', compact('marcamedicamentos_vacunas'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $marcamedicamentos_vacunas = Marcamedicamentos_vacunas::find($request->id);
            $marcamedicamentos_vacunas->nombre = $request->nombre;
            $marcamedicamentos_vacunas->save();
            return redirect()->route('admin.marcamedicamentos_vacunas.index')->with('success', 'La marca de Medicamento ' . $request->nombre . ' fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
