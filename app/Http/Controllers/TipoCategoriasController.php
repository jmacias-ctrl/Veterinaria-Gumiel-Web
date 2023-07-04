<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\TipoCategorias;
use Illuminate\Support\Facades\Validator;
use DataTables;


class TipoCategoriasController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
           
            $data = TipoCategorias::all();
            foreach($data as $d){
                $d->id_categoria = Categorias::find($d->id_categoria)->nombre;
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.subcategorias.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.subcategorias.subcategorias');
    }

    public function create()
    {
        $Categorias = Categorias::all();
        return view('admin.subcategorias.create', compact('Categorias'));
    }

    public function store(Request $request)
    {
        
        $rule = [
            'nombre' => 'required|string',
            'categoria' => 'required',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $subcategoria = new TipoCategorias();
            $subcategoria->nombre = $request->nombre;
            $subcategoria->id_categoria = $request->input('categoria');

            $subcategoria->save();
            return redirect()->route('admin.subcategorias.index')->with('success', 'La subcategoria ' . $request->nombre . ' fue agregado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $subcategoria = TipoCategorias::find($request->id);
        $subcategoria->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {

        $subcategoria = TipoCategorias::find($request->id);
        return view('admin.subcategorias.edit', compact('subcategoria'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $subcategoria = TipoCategorias::find($request->id);
            $subcategoria->nombre = $request->nombre;
            $subcategoria->save();
            return redirect()->route('admin.subcategorias.index')->with('success', 'La subcategoria ' . $request->nombre . ' fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
