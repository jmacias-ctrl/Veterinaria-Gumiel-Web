<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use Illuminate\Support\Facades\Validator;
use DataTables;

class CategoriasController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Categorias::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.categorias.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.categorias.categorias');
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $categoria = new Categorias();
            $categoria->nombre = $request->nombre;
            $categoria->save();
            return redirect()->route('admin.categorias.index')->with('success', 'La categoria ' . $request->nombre . ' fue agregado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $categoria = Categorias::find($request->id);
        $categoria->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {

        $categoria = Categorias::find($request->id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $categoria = Categorias::find($request->id);
            $categoria->nombre = $request->nombre;
            $categoria->save();
            return redirect()->route('admin.categorias.index')->with('success', 'La categoria ' . $request->nombre . ' fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
