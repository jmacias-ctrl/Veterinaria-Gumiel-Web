<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaInsumo;
use DataTables;
use Illuminate\Support\Facades\Validator;

/**
 * Class MarcaInsumoController
 * @package App\Http\Controllers
 */
class MarcaInsumoController extends Controller
{

    public function index_marca(Request $request)
    {
        if($request->ajax()){
            $data = MarcaInsumo::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.marcaInsumo.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $marcaInsumo = MarcaInsumo::all();
        return view('admin.marcaInsumo.marcaInsumo', compact('marcaInsumo'));
    }

    public function create()
    {
        return view('admin.marcaInsumo.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $marcaInsumo = MarcaInsumo::create(['nombre' => $request->nombre]);
            return redirect()->route('admin.marcaInsumos.index')->with('success', 'La marca de insumo medico' . $request->nombre . ' fue agregado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $marcaInsumo = MarcaInsumo::find($request->id);
        $marcaInsumo->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {

        $marcaInsumo = MarcaInsumo::find($request->id);
        return view('admin.marcaInsumo.edit', compact('marcaInsumo'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $marcaInsumo = MarcaInsumo::find($request->id);
            $marcaInsumo->nombre = $request->nombre;
            $marcaInsumo->save();
            return redirect()->route('admin.marcaInsumos.index')->with('success', 'La marca de insumo medico ' . $request->nombre . ' fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
