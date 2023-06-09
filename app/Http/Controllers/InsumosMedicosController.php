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
use Illuminate\Validation\Rule;


class InsumosMedicosController extends Controller
{


    public function index_insumos(Request $request)
    {
        if ($request->ajax()) {
            $data = insumos_medicos::with('marcainsumos','tipoinsumos')->get()->map(function($insumos){
                $insumos->id_marca = $insumos->marcainsumos->nombre;
                $insumos->id_tipo = $insumos->tipoinsumos->nombre;
                return $insumos;
            });
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', 'admin.insumos_medicos.datatable.action')
            ->rawColumns(['action'])
            ->toJson();
        }
        $insumos_medicos = insumos_medicos::with('tipoinsumos', 'marcaInsumos')->get();
        return view('admin.insumos_medicos.insumos', compact('insumos_medicos'));
    }

    public function create()
    {
        $tipoinsumos = Tipoinsumos::all();
        $marcasInsumos = MarcaInsumo::all();
        return view('admin.insumos_medicos.create', compact('tipoinsumos', 'marcasInsumos'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'marca' => 'required',
            'codigo'=> 'string|required|unique:App\Models\insumos_medicos,codigo',
            'id_tipo' => 'required',
            'stock' => 'required|integer',
        ];
        $attribute = [
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'codigo'=> 'Codigo',
            'id_tipo' => 'Tipo',
            'stock' => 'Stock',
        ];
        $message = [
            'required' => ':attribute es obligatorio',
            'integer'=> ':attribute debe ser un numero',
            'unique'=> ':attribute ya se encuentra registrado'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $tipoinsumos = Tipoinsumos::all();
            $insumos_medicos = new insumos_medicos;
            $insumos_medicos->nombre = $request->input('nombre');
            $insumos_medicos->codigo = $request->input('codigo');
            $insumos_medicos->id_marca = $request->input('marca');
            $insumos_medicos->id_tipo = $request->input('id_tipo');
            $insumos_medicos->stock = $request->input('stock');

            $insumos_medicos->save();
            return redirect()->route('admin.insumos_medicos.index', compact('tipoinsumos'))->with('success', 'El insumo ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $insumos_medicos = insumos_medicos::find($request->id);
        $insumos_medicos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $insumos_medicos = insumos_medicos::find($request->id);
        $tipoinsumos = Tipoinsumos::all();
        $marcasInsumos = MarcaInsumo::all();
        return view('admin.insumos_medicos.edit', compact('insumos_medicos', 'tipoinsumos', 'marcasInsumos'));
    }

    public function update(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'marca' => 'required',
            'codigo'=> [
                'string',
                'required',
                Rule::unique('insumos_medicos', 'codigo')->ignore($request->id),
            ],
            'id_tipo' => 'required',
            'stock' => 'required',
        ];
        $attribute = [
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'codigo'=> 'Codigo',
            'id_tipo' => 'Tipo',
            'stock' => 'Stock',
        ];
        $message = [
            'required' => ':attribute es obligatorio',
            'unique'=> ':attribute ya se encuentra registrado'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $tipoinsumos = Tipoinsumos::all();
            $insumos_medicos = insumos_medicos::find($request->id);
            $insumos_medicos->nombre = $request->input('nombre');
            $insumos_medicos->id_marca = $request->input('marca');
            $insumos_medicos->id_tipo = $request->input('id_tipo');
            $insumos_medicos->codigo = $request->input('codigo');
            $insumos_medicos->stock = $request->input('stock');
            $insumos_medicos->save();
            return redirect()->route('admin.insumos_medicos.index')->with('success', 'El insumo medico ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}
