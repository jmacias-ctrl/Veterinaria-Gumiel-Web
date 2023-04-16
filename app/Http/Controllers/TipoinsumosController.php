<?php

namespace App\Http\Controllers;

use App\Models\Tipoinsumos;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;


/**
 * Class TipoinsumoController
 * @package App\Http\Controllers
 */
class TipoinsumosController extends Controller
{
    public function index_tipo()
    {
        $tipoinsumos = Tipoinsumos::all();
        return view('admin.tipoinsumos.tipoinsumos', compact('tipoinsumos'));
    }

    public function create()
    {
        return view('admin.tipoinsumos.create');
    }

    public function store_tipo(Request $request){
        $tipoinsumos = Tipoinsumos::create(['nombre'=>$request->nombre]);
        return redirect()->route('admin.tipoinsumos.index');
    }

    public function delete(Request $request){
        $tipoinsumos = Tipoinsumos::find($request->id);
        $tipoinsumos->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $tipoinsumos = Tipoinsumos::find($request->id);
        return view('admin.tipoinsumos.edit',compact('tipoinsumos'));
    }
    
    public function update(Request $request)
    {
        $tipoinsumos = Tipoinsumos::find($request->id);
        $tipoinsumos->nombre = $request->nombre;
        $tipoinsumos->save();
        return redirect()->route('admin.tipoinsumos.index');
    }
}





