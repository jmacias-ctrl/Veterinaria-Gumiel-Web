<?php

namespace App\Http\Controllers;

use App\Models\insumos_medicos;
use App\Models\Tipoinsumos;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Tipoinsumo;
use Illuminate\Support\Facades\DB;
use DataTables;


class InsumosMedicosController extends Controller
{
    public function index_insumos()
    {
        $insumos_medicos = insumos_medicos::all();
        return view('admin.insumos_medicos.insumos', compact('insumos_medicos'));
    }

    public function create()
    {   
        $tipoinsumos = Tipoinsumos::all();
        return view('admin.insumos_medicos.create',compact('tipoinsumos'));
    }

    public function store(Request $request)
    {
        try {

            db::beginTransaction();
            $insumos_medicos = new insumos_medicos;
            $nombre = $request->nombre;
            $marca = $request->marca;
            $id_tipo = $request->id_tipo;
            $stock = $request->stock;


            $insumos_medicos->nombre = $nombre;
            $insumos_medicos->marca = $marca;
            $insumos_medicos->id_tipo = $id_tipo;
            $insumos_medicos->stock = $stock;
            $insumos_medicos->save();
            db::commit();


            return redirect()->route('admin.insumos_medicos.index_insumos')->with('success', 'El insumo medico'.$insumos_medicos->nombre.'ha sido guardado exitosamente');
        } catch (QueryException $exception) {
            DB::rollBack();
            return back()->withInput();
        }

        
    }

    public function delete()
    {
        $insumos_medicos = insumos_medicos::find($request->id);
        $insumos_medicos->delete();
        return response()->json(['success' => true], 200);
    }
}
