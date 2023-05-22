<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicamentos_vacunas;
use App\Models\TipoMedicamento;
use App\Models\marca_medicamentos_vacunas;
use Illuminate\Support\Facades\Validator;
use DataTables;

class tipomedicamentos_vacunasController extends Controller
{
    public function index_tipo(Request $request)
    {
        if($request->ajax()){
            $data = TipoMedicamento::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action','admin.tipomedicamentos_vacunas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.tipomedicamentos_vacunas.tipomedicamentos_vacunas');
    }

    public function create()
    {
        return view('admin.tipomedicamentos_vacunas.create');
    }

    public function store_tipo(Request $request){
        $rule = [
            'nombre'=>'required|string',
        ];
        $atrribute =[
            'nombre' => 'Nombre',
        ];
        $message = ['required'=>'El :attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message, $atrribute);
        if($validator->passes()){
            $tipomedicamentos_vacunas = TipoMedicamento::create(['nombre'=>$request->nombre]);
            return redirect()->route('admin.tipomedicamentos_vacunas.index')->with('success', 'El tipo de medicamento' . $request->nombre . ' fue agregado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }

    public function delete(Request $request){
        $tipomedicamentos_vacunas = TipoMedicamento::find($request->id);
        $tipomedicamentos_vacunas->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $tipomedicamentos_vacunas= TipoMedicamento::find($request->id);
        return view('admin.tipomedicamentos_vacunas.edit',compact('tipomedicamentos_vacunas'));
    }
    
    public function update(Request $request)
    {
        $rule = [
            'nombre'=>'required|string',
        ];
        $atrribute =[
            'nombre' => 'Nombre',
        ];
        $message = ['required'=>':attribute es obligatorio'];
        $validator = Validator::make($request->all(), $rule, $message, $atrribute);
        if($validator->passes()){
            $tipomedicamentos_vacunas = TipoMedicamento::find($request->id);
            $tipomedicamentos_vacunas->nombre = $request->nombre;
            $tipomedicamentos_vacunas->save();
            return redirect()->route('admin.tipomedicamentos_vacunas.index')->with('success', 'El tipo de medicamento ' . $request->nombre . ' fue modificado de manera satisfactoria');
        }
        return back()->withErrors($validator)->withInput();
    }
}
