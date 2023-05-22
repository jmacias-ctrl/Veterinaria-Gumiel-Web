<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicamentos_vacunas;
use App\Models\TipoMedicamento;
use App\Models\marca_medicamentos_vacunas;
use Illuminate\Support\Facades\Validator;
use DataTables;

class MarcaMedicamentoController extends Controller
{
    public function index_marca(Request $request)
    {
        if($request->ajax()){
            $data = marca_medicamentos_vacunas::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.marcamedicamentos_vacunas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.marcamedicamentos_vacunas.marcamedicamentos_vacunas');
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
            $marcamedicamentos_vacunas = marca_medicamentos_vacunas::create(['nombre' => $request->nombre]);
            return redirect()->route('admin.marcamedicamentos_vacunas.index')->with('success', 'La marca de medicamento ' . $request->nombre . ' fue agregado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $marcamedicamentos_vacunas = marca_medicamentos_vacunas::find($request->id);
        $marcamedicamentos_vacunas->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {

        $marcamedicamentos_vacunas = marca_medicamentos_vacunas::find($request->id);
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
            $marcamedicamentos_vacunas = marca_medicamentos_vacunas::find($request->id);
            $marcamedicamentos_vacunas->nombre = $request->nombre;
            $marcamedicamentos_vacunas->save();
            return redirect()->route('admin.marcamedicamentos_vacunas.index')->with('success', 'La marca de Medicamento ' . $request->nombre . ' fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
