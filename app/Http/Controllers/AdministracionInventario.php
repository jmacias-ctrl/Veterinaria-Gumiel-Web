<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicamentos_vacunas;
use App\Models\productos_ventas;
use App\Models\insumos_medicos;
use Illuminate\Support\Facades\DB;
use DataTables;
class AdministracionInventario extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            if($request->value == "productos"){
                $data = productos_ventas::select('id', 'nombre', 'stock')->orderBy('stock', 'asc')->get();
            }else if($request->value=="insumos"){
                $data = insumos_medicos::select('id', 'nombre', 'stock')->orderBy('stock', 'asc')->get();
            }else{
                $data = medicamentos_vacunas::select('id', 'nombre', 'stock')->orderBy('stock', 'asc')->get();
            }
            return Datatables::of($data)
            ->addIndexColumn()
            ->toJson();
        }

        $cant_productos['no_stock']= db::table('productos_ventas')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        $cant_productos['low_stock']= db::table('productos_ventas')->where('stock', '<=', 'min_stock')->where('stock', '>', 0)->select(db::raw('count(id) as low_stock'))->first()->low_stock;
        $cant_insumos_medicos['no_stock'] = db::table('insumos_medicos')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        $cant_medicinas['no_stock'] = db::table('medicamentos_vacunas')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;

        return view('inventario.administracion_stock.index', compact('cant_productos', 'cant_insumos_medicos', 'cant_medicinas'));
    }
}
