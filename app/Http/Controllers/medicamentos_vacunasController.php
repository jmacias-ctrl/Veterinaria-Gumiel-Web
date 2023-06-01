<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicamentos_vacunas;
use App\Models\TipoMedicamento;
use App\Models\marca_medicamentos_vacunas;
use App\Models\Especie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;

class medicamentos_vacunasController extends Controller
{
    public function index_medicamentos_vacunas(Request $request)
    {
        
        if ($request->ajax()) {
            $data = medicamentos_vacunas::with('marca_medicamentos_vacunas','tipo_medicamentos_vacunas', 'especies')->get()->map(function($medicamentos_vacunas){
                $medicamentos_vacunas->id_marca = $medicamentos_vacunas->marca_medicamentos_vacunas->nombre;
                $medicamentos_vacunas->medicamentos_enfocados = $medicamentos_vacunas->especies->nombre;
                $medicamentos_vacunas->id_tipo = $medicamentos_vacunas->tipo_medicamentos_vacunas->nombre;
                if(!isset($medicamentos_vacunas->mililitros)){
                    $medicamentos_vacunas->mililitros = 'No definido';
                }
                if(!isset($medicamentos_vacunas->gramos)){
                    $medicamentos_vacunas->gramos = "No definido";
                }
                return $medicamentos_vacunas;
            });
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', 'admin.medicamentos_vacunas.datatable.action')
            ->rawColumns(['action'])
            ->toJson();
        }
        return view('admin.medicamentos_vacunas.medicamentos_vacunas');
    }

    public function create()
    {
        $tipomedicamentos  = TipoMedicamento::all();
        $marcasMedicamentos  = marca_medicamentos_vacunas::all();
        $especies = Especie::all();
        return view('admin.medicamentos_vacunas.create', compact('tipomedicamentos', 'marcasMedicamentos', 'especies'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'marca' => 'required',
            'codigo'=> 'string|required|unique:App\Models\medicamentos_vacunas,codigo',
            'id_tipo' => 'required',
            'stock' => 'required|integer',
            'medicamento_enfocado'=> 'required'
        ];
        $attribute = [
            'nombre' => 'Nombre',
            'codigo'=> 'Codigo',
            'marca' => 'Marca',
            'id_tipo' => 'Tipo',
            'stock' => 'Stock',
            'medicamento_enfocado' => 'Enfoque del medicamento'
        ];
        $message = [
            'required' => ':attribute es obligatorio',
            'integer'=> ':attribute debe ser un numero'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $tipomedicamentos_vacunas = TipoMedicamento::all();
            $medicamentos_vacunas = new medicamentos_vacunas();
            $medicamentos_vacunas->codigo = $request->input('codigo');
            $medicamentos_vacunas->nombre = $request->input('nombre');
            $medicamentos_vacunas->id_marca = $request->input('marca');
            $medicamentos_vacunas->medicamentos_enfocados = $request->input('medicamento_enfocado');
            $medicamentos_vacunas->id_tipo = $request->input('id_tipo');
            $medicamentos_vacunas->stock = $request->input('stock');

            $medicamentos_vacunas->save();
            return redirect()->route('admin.medicamentos_vacunas.index', compact('tipomedicamentos_vacunas'))->with('success', 'El medicamento ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $medicamentos_vacunas = medicamentos_vacunas::find($request->id);
        $medicamentos_vacunas->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $medicamentos = medicamentos_vacunas::find($request->id);
        $tipomedicamentos = TipoMedicamento::all();
        $marcasMedicamentos = marca_medicamentos_vacunas::all();
        $especies = Especie::all();
        return view('admin.medicamentos_vacunas.edit', compact('medicamentos', 'tipomedicamentos', 'marcasMedicamentos', 'especies'));
    }

    public function update(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'marca' => 'required',
            'codigo'=> [
                'string',
                'required',
                Rule::unique('medicamentos_vacunas', 'codigo')->ignore($request->id),
            ],
            'id_tipo' => 'required',
            'stock' => 'required',
            'medicamento_enfocado'=> 'required'
        ];
        $attribute = [
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'id_tipo' => 'Tipo',
            'stock' => 'Stock',
            'medicamento_enfocado' => 'Enfoque del medicamento'
        ];
        $message = [
            'required' => ':attribute es obligatorio'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $tipomedicamentos_vacunas = TipoMedicamento::all();
            $medicamentos_vacunas = medicamentos_vacunas::find($request->id);
            $medicamentos_vacunas->codigo = $request->input('codigo');
            $medicamentos_vacunas->nombre = $request->input('nombre');
            $medicamentos_vacunas->id_marca = $request->input('marca');
            $medicamentos_vacunas->medicamentos_enfocados = $request->input('medicamento_enfocado');
            $medicamentos_vacunas->id_tipo = $request->input('id_tipo');
            $medicamentos_vacunas->stock = $request->input('stock');
            $medicamentos_vacunas->save();
            return redirect()->route('admin.medicamentos_vacunas.index')->with('success', 'El Medicamento ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}
