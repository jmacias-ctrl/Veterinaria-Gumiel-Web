<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;
use Illuminate\Support\Facades\Validator;
use DataTables;

class EspecieController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Especie::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.especies.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.especies.especies');
    }

    public function create()
    {
        return view('admin.especies.create');
    }

    public function store(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $especie = new Especie();
            $especie->nombre = $request->nombre;
            $especie->save();
            return redirect()->route('admin.especies.index')->with('success', 'La especie ' . $request->nombre . ' fue agregado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $especie = Especie::find($request->id);
        $especie->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request)
    {

        $especie = Especie::find($request->id);
        return view('admin.especies.edit', compact('especie'));
    }

    public function update(Request $request)
    {
        $rule = [
            'nombre' => 'required|string',
        ];

        $message = ['required' => 'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message);
        if ($validator->passes()) {
            $especie = Especie::find($request->id);
            $especie->nombre = $request->nombre;
            $especie->save();
            return redirect()->route('admin.especies.index')->with('success', 'La especie ' . $request->nombre . ' fue modificado de manera satisfactoria');;
        }
        return back()->withErrors($validator)->withInput();
    }
}
