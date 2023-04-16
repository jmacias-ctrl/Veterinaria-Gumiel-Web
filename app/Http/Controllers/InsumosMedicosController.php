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
        return view('admin.insumos_medicos.create');
    }

    public function store(Request $request)
    {
        try {
            db::beginTransaction();
            $insumos_medicos = new insumos_medicos;
            $nombre = $request->nombre;

            $insumos_medicos->nombre = $insumos_medicos;
            $insumos_medicos->marca;
            $insumos_medicos->tipo = $request->tipo;
            $insumos_medicos->stock;
            $insumos_medicos->save();
            db::commit();

            $insumos_medicos->assignTipoinsumos($request->Tipoinsumos);

            return redirect()->route('admin.insumos_medicos.insumos')->with('success', 'El insumo medico'.$insumos_medicos->nombre.'ha sido guardado exitosamente');
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
