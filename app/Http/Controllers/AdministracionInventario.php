<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medicamentos_vacunas;
use App\Models\productos_ventas;
use App\Models\insumos_medicos;
use App\Models\trazabilidad_inventario;
use App\Models\proveedores;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\trazabilidad_venta_presencial;
use App\Models\items_comprados;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DataTables;

class AdministracionInventario extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->value == "productos") {
                $data = productos_ventas::select('id', 'nombre', 'stock')->orderBy('stock', 'asc')->get()->map(function ($item) {
                    $item->tipo_item = "producto";
                    return $item;
                });
            } else if ($request->value == "insumos") {
                $data = insumos_medicos::select('id', 'nombre', 'stock')->orderBy('stock', 'asc')->get()->map(function ($item) {
                    $item->tipo_item = "insumo";
                    return $item;
                });
            } else {
                $data = medicamentos_vacunas::select('id', 'nombre', 'stock')->orderBy('stock', 'asc')->get()->map(function ($item) {
                    $item->tipo_item = "medicamento";
                    return $item;
                });
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'inventario.administracion_stock.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $proveedores = proveedores::all();
        $cant_productos['no_stock'] = db::table('productos_ventas')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        $cant_productos['low_stock'] = db::table('productos_ventas')->where('stock', '<=', 'min_stock')->where('stock', '>', 0)->select(db::raw('count(id) as low_stock'))->first()->low_stock;
        $cant_insumos_medicos['no_stock'] = db::table('insumos_medicos')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        $cant_medicinas['no_stock'] = db::table('medicamentos_vacunas')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;

        return view('inventario.administracion_stock.index', compact('cant_productos', 'cant_insumos_medicos', 'cant_medicinas', 'proveedores'));
    }
    public function ver_item(Request $request)
    {
        if ($request->tipo == "producto" || $request->tipo == "Producto") {
            $data = productos_ventas::with(['marcaproductos', 'tipoproductos_ventas', 'especies'])->find($request->id);
            $data->id_marca = $data->marcaproductos->nombre;
            $data->id_tipo = $data->tipoproductos_ventas->nombre;
            $data->producto_enfocado = $data->especies->nombre;
        } else if ($request->tipo == "insumo" || $request->tipo == "Insumo Medico") {
            $data = insumos_medicos::with('marcainsumos', 'tipoinsumos')->find($request->id);
            $data->id_marca = $data->marcainsumos->nombre;
            $data->id_tipo = $data->tipoinsumos->nombre;
        } else {
            $data = medicamentos_vacunas::with('marca_medicamentos_vacunas', 'tipo_medicamentos_vacunas', 'especies')->find($request->id);
            $data->id_marca = $data->marca_medicamentos_vacunas->nombre;
            $data->medicamentos_enfocados = $data->especies->nombre;
            $data->id_tipo = $data->tipo_medicamentos_vacunas->nombre;
        }
        return response()->json(['success' => true, 'itemGet' => $data, 'tipo_item' => $request->tipo], 200);
    }
    public function descargar_factura(Request $request){
        $trazabilidad = trazabilidad_inventario::find($request->id);
        return response()->download('public/facturas/'.$trazabilidad->factura);
    }
    public function historial_admin(Request $request)
    {
        
        if ($request->ajax()) {
            $data = trazabilidad_inventario::with(['productos_ventas', 'medicamentos_vacunas', 'insumos_medicos', 'proveedores'])->orderBy('created_at', 'desc');
            if($request->value=="productos"){
                $data = $data->whereNotNull("id_producto")->get();
            }else if($request->value=="insumos"){
                $data = $data->whereNotNull("id_insumo")->get();
            }else if($request->value=="medicinas"){
                $data = $data->whereNotNull("id_medicina")->get();
            }else{
                $data = $data->get();
            }
            $data = $data->map(function ($item) {
                if (isset($item->id_producto)) {
                    $item->nombre = $item->productos_ventas->nombre;
                    $item->tipo_item = "Producto";
                }
                if (isset($item->id_insumo)) {
                    $item->nombre = $item->insumos_medicos->nombre;
                    $item->tipo_item = "Insumo Medico";
                }
                if (isset($item->id_medicina)) {
                    $item->nombre = $item->medicamentos_vacunas->nombre;
                    $item->tipo_item = "Medicamento";
                }
                if (isset($item->id_proveedor)) {
                    $item->nombre_proveedor = $item->proveedores->nombre;
                } else {
                    $item->nombre_proveedor = '-';
                }
                if ($item->accion == "restar") {
                    $item->costo = "-";
                }else{
                    $item->costo = '$'.number_format($item->costo, 0, ',', '.');
                }
                return $item;
            });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'inventario.administracion_stock.datatable.action_historial')
                ->rawColumns(['action'])
                ->toJson();
        }
        $cant_productos['no_stock'] = db::table('productos_ventas')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        $cant_productos['low_stock'] = db::table('productos_ventas')->where('stock', '<=', 'min_stock')->where('stock', '>', 0)->select(db::raw('count(id) as low_stock'))->first()->low_stock;
        $cant_insumos_medicos['no_stock'] = db::table('insumos_medicos')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        $cant_medicinas['no_stock'] = db::table('medicamentos_vacunas')->where('stock', '<=', 0)->select(db::raw('count(id) as no_stock'))->first()->no_stock;
        return view('inventario.administracion_stock.historial', compact('cant_productos', 'cant_insumos_medicos', 'cant_medicinas'));
    }
    public function admin_item(Request $request)
    {

        if ($request->adminOption == "agregar") {
            $rules = [
                'newStock' => 'required|integer|min:0',
                'factura' => 'mimes:pdf',
                'proveedor' => 'required',
                'costoStockAgregado' => 'required|integer|min:0'
            ];
        } else {
            $rules = [
                'newStock' => 'required|integer|min:0',
            ];
        }
        $attribute = [
            'newStock' => 'Cantidad de stock',
            'factura' => 'Archivo de Factura',
            'proveedor' => 'Proveedor',
        ];
        $message = [
            'required' => ':attribute es obligatorio',
            'integer' => ':attribute debe ser un numero',
            'mimes' => ':attribute debe ser un archivo tipo pdf',
            'min' => ':attribute debe ser mínimo :value',
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attribute);
        if ($validator->passes()) {
            $item = null;
            $trazabilidad = new trazabilidad_inventario();
            $trazabilidad->tipo_item = $request->tipo_item;
            if ($request->tipo_item == "producto") {
                $item = productos_ventas::find($request->id_item);
                $trazabilidad->id_producto = $item->id;
            } else if ($request->tipo_item == "medicamento") {
                $item = medicamentos_vacunas::find($request->id_item);
                $trazabilidad->id_medicina = $item->id;
            } else if ($request->tipo_item == "insumo") {
                $item = insumos_medicos::find($request->id_item);
                $trazabilidad->id_insumo = $item->id;
            }
            $newStock = $request->newStock;
            if ($request->adminOption == "Restar") {
                $newStock =  $request->newStock * -1;
            }
            $item->stock = $item->stock + $newStock;
            $item->save();

            $trazabilidad->stock = $request->newStock;
            $trazabilidad->accion = $request->adminOption;
            if ($request->adminOption == "Agregar" && $request->proveedor == "new") {
                $proveedor = new proveedores();
                $proveedor->nombre = $request->nuevoProveedor;
                $proveedor->save();
                $proveedor = $proveedor->id;
            } else if ($request->adminOption == "Agregar") {
                $proveedor = proveedores::find($request->proveedor)->id;
            }

            if ($request->adminOption == "Agregar") {
                $trazabilidad->costo = $request->costoStockAgregado;
                $trazabilidad->id_proveedor = $proveedor;
                if (isset($request->factura)) {
                    $file_path = $request->file('factura');
                    $trazabilidad->factura = $file_path->store('public/facturas');
                    $filename = time() . '.' . $file_path->getClientOriginalExtension();
                    $file_path->move(public_path('public/facturas'), $filename);
                    $trazabilidad->factura = $filename;
                }
            } else {
                if ($request->checkStockComprados == "true") {
                    $nuevaVenta  = new trazabilidad_venta_presencial();
                    $nuevaVenta->id_venta = Str::random(10);
                    $nuevaVenta->metodo_pago = "efectivo";
                    $nuevaVenta->nombre_cliente = auth()->user()->name;
                    $nuevaVenta->id_operador = auth()->user()->id;
                    $nuevaVenta->save();
                    $itemComprado =  new items_comprados();
                    $itemComprado->monto = $item->precio;
                    $itemComprado->cantidad = $request->newStock;
                    $itemComprado->id_producto = $item->id;
                    $itemComprado->id_venta = $nuevaVenta->id;
                    $itemComprado->save();
                }
            }


            $trazabilidad->save();
            return redirect()->route('administracion_inventario.index')->with('successAdmin', 'La administracion de stock del item '.$item->nombre.' se ha realizado de manera satisfactoria');
        }
        return back()->with('failed', 'No se ha podido realizar la administracion de stock del item');
    }
}
