<?php

namespace App\Http\Controllers;

use App\Models\Marcaproducto;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class MarcaproductoController
 * @package App\Http\Controllers
 */
class MarcaproductoController extends Controller
{

    public function index_marca(Request $request)
    {
        if($request->ajax()){
            $data = marcaproducto::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.marcaproductos.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $marcaproductos = marcaproducto::all();
        return view('admin.marcaproductos.marcaproductos', compact('marcaproductos'));
    }

    public function create()
    {
        return view('admin.marcaproductos.create');
    }

    public function store(Request $request)
    {
        // request()->validate(Marcaproducto::$rules);

        // $marcaproducto = Marcaproducto::create($request->all());

        // return redirect()->route('marcaproductos.index')
        //     ->with('success', 'Marcaproducto created successfully.');
        $rule = [
            'nombre' => 'required|string'
        ];
        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $marcaproductos = Marcaproducto::create(['nombre' => $request->nombre]);
            return redirect()->route('admin.marcaproductos.index')->with('success', 'La marca de insumo' . $request->nombre . 'fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $marcaproductos = Marcaproducto::find($request->id);
        $marcaproductos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {
        $marcaproductos = Marcaproducto::find($request->id);
        return view('admin.marcaproductos.edit', compact('marcaproductos'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre' => 'required|string'
        ];
        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $marcaproductos = Marcaproducto::find($request->id);
            $marcaproductos->nombre = $request->nombre;
            $marcaproductos->save();
            return redirect()->route('admin.marcaproductos.index')->with('success', 'La marca de producto ' . $request->nombre . 'fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
