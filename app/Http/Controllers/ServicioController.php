<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;



class ServicioController extends Controller
{
    public function index_servicios()
    {
        $servicio = Servicio::all();
        return view('admin.servicios.servicio', compact('servicio'));
    }

    public function create()
    {
        return view('admin.servicio.create');
    }

    public function store_tipo(Request $request){
        $servicio = request()->all();
        return redirect()->route('admin.servicio.index');
    }

    public function delete(Request $request){
        $servicio = Servicio::find($request->id);
        $servicio->delete();
        return response()->json(['success' => true], 200);
    }

    public function edit(Request $request){
        $servicio = Servicio::find($request->id);
        return view('admin.servicio.edit',compact('servicio'));
    }
    
    public function update(Request $request)
    {
        $servicio = Servicio::find($request->id);
        $servicio->nombre = $request->nombre;
        $servicio->save();
        return redirect()->route('admin.servicio.index');
    }
}
