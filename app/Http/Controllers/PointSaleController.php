<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos_ventas;
use App\Models\Marcaproducto;
use App\Models\trazabilidad_venta_presencial;
use App\Models\efectivo;
use App\Models\transferencia;
use App\Models\tarjeta;
use App\Models\items_comprados;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Str;
use App\Notifications\StockProductoInventario;

class PointSaleController extends Controller
{
    public function index(Request $request)
    {
        \Cart::session(auth()->user()->id)->clear();
        $productos = productos_ventas::orderBy('nombre')->get();
        $marcaProductos = Marcaproducto::all();
        return view('inventario.punto_de_venta.point_sale', compact('productos', 'marcaProductos'));
    }
    public function update_product(Request $request)
    {
        $producto = productos_ventas::find($request->id);
        $getQuantity = $request->quantity;
        if ($getQuantity > $producto->stock) {
            $getQuantity = 0;
        }
        $cartGet = \Cart::session(auth()->user()->id)->get($request->id);
        $getQuantity = $getQuantity - $cartGet->quantity;

        if ($getQuantity != 0) {
            \Cart::session(auth()->user()->id)->update($request->id, [
                'quantity' => $getQuantity,
            ]);
        }
        $cartItems = \Cart::session(auth()->user()->id)->getContent();
        $total = \Cart::session(auth()->user()->id)->getTotal();
        $subtotal = \Cart::session(auth()->user()->id)->getSubTotal();
        return response()->json(['success' => true, 'cartItems' => $cartItems, 'total' => $total, 'subTotal' => $subtotal], 200);
    }
    public function venta(Request $request)
    {
        $cartGet = \Cart::session(auth()->user()->id)->getContent();
        $fecha = Carbon::now()->format('d-m-Y');
        $hora = Carbon::now()->format('h:i:s A');
        $nuevaVenta  = new trazabilidad_venta_presencial();
        $nuevaVenta->id_venta = Str::random(10);
        $nuevaVenta->metodo_pago = $request->metodoPago;
        $nuevaVenta->nombre_cliente = $request->nombreCliente;
        $nuevaVenta->id_operador = auth()->user()->id;
        $nuevaVenta->save();
        $montoFinal = 0;
        $metodoPagoEscogido = null;
        foreach ($cartGet as $item) {
            $itemComprado =  new items_comprados();
            $itemComprado->monto = $item->price;
            $itemComprado->cantidad = $item->quantity;
            $itemComprado->id_producto = $item->id;
            $itemComprado->id_venta = $nuevaVenta->id;
            $itemComprado->save();
            $montoFinal = $montoFinal + ($itemComprado->monto*$itemComprado->cantidad);

            $producto = productos_ventas::find($item->id);
            $producto->stock = $producto->stock - $item->quantity;
            if($producto->stock<=0){
                $users = User::all();
                foreach($users as $user){
                    if($user->can('acceso administracion de stock')){
                        $user->notify(new StockProductoInventario($producto, true));
                    }
                }   
            }else if($producto->stock<$producto->min_stock){
                $users = User::all();
                foreach($users as $user){
                    if($user->can('acceso administracion de stock')){
                        $user->notify(new StockProductoInventario($producto, false));
                    }
                }   
            }
            $producto->save();
        }

        
        switch($request->metodoPago){
            case 'transferencia':
                $transferencia = new transferencia();
                $transferencia->banco = $request->banco;
                $transferencia->num_operacion=$request->numOperacion;
                $transferencia->id_operacion = $nuevaVenta->id;
                $transferencia->save();
                $metodoPagoEscogido = $transferencia;
                break;
            case 'efectivo':
                $efectivo = new efectivo();
                $efectivo->efectivo = $request->montoEfectivo;
                $efectivo->vuelto = $request->montoEfectivo - $montoFinal;
                $efectivo->id_operacion = $nuevaVenta->id;
                $efectivo->save();
                $metodoPagoEscogido = $efectivo;
                break;
            case 'tarjeta':
                $tarjeta = new tarjeta();
                $tarjeta->num_operacion = $request->numOperacion;
                $tarjeta->id_operacion = $nuevaVenta->id;
                $tarjeta->save();
                $metodoPagoEscogido = $tarjeta; 
                break; 
        }
        \Cart::session(auth()->user()->id)->clear();
        return response()->json(['success' => true,'metodoPago'=>$request->metodoPago, 'fecha'=>$fecha,'hora'=>$hora, 'productosComprados'=>$cartGet, 'montoFinal'=>$montoFinal, 'nuevaVenta'=>$nuevaVenta], 200);
    }
    public function add_product(Request $request)
    {
        $producto = productos_ventas::find($request->value);
        \Cart::session(auth()->user()->id)->add(array(
            'id' => $producto->id,
            'name' => $producto->nombre,
            'price' => $producto->precio,
            'quantity' => $request->cantProduct,
            'attributes' => array(),
            'associatedModel' => $producto
        ));
        $cartItems = \Cart::session(auth()->user()->id)->getContent();
        $total = \Cart::session(auth()->user()->id)->getTotal();
        $subtotal = \Cart::session(auth()->user()->id)->getSubTotal();
        return response()->json(['success' => true, 'cartItems' => $cartItems, 'total' => $total, 'subTotal' => $subtotal], 200);
    }
    public function remove_product(Request $request)
    {
        \Cart::session(auth()->user()->id)->remove($request->value);
        $cartItems = \Cart::session(auth()->user()->id)->getContent();
        $total = \Cart::session(auth()->user()->id)->getTotal();
        $subtotal = \Cart::session(auth()->user()->id)->getSubTotal();
        return response()->json(['success' => true, 'cartItems' => $cartItems, 'total' => $total, 'subTotal' => $subtotal], 200);
    }

    public function clear_products()
    {
        \Cart::session(auth()->user()->id)->clear();
        return response()->json(['success' => true], 200);
    }
    public function mostrar_ventas(Request $request){
        if($request->ajax()){
            $data = db::table('trazabilidad_venta_presencials')
            ->join('items_comprados','items_comprados.id_venta','=','trazabilidad_venta_presencials.id')
            ->select('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'nombre_cliente', db::raw('sum(items_comprados.monto*items_comprados.cantidad) as monto'), db::raw('"presencial" as venta'))
            ->groupBy('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'nombre_cliente', 'venta')
            ->get();
            foreach($data as $item){
                $item->monto = '$'.number_format($item->monto, 0, ',', '.');
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action','inventario.ventas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('inventario.ventas.index');
    }
 
    public function detalle_venta(Request $request){
        $venta = trazabilidad_venta_presencial::find($request->id);
        $detalle_metodo = null;
        $venta->hora = Carbon::parse($venta->created_at)->format('d-m-Y');
        $venta->fecha = Carbon::parse($venta->created_at)->format('h:i:s A');
        if($venta->metodo_pago=="efectivo"){
            $detalle_metodo = efectivo::where('id_operacion', '=', $venta->id)->first();
        }else if($venta->metodo_pago=="tarjeta"){
            $detalle_metodo = tarjeta::where('id_operacion', '=', $venta->id)->first();
        }else{
            $detalle_metodo = transferencia::where('id_operacion', '=', $venta->id)->first();
        }
        $itemsComprado = db::table('items_comprados')->join('productos_ventas', 'items_comprados.id_producto', '=', 'productos_ventas.id')->where('id_venta', '=', $venta->id)->select('items_comprados.id', 'productos_ventas.nombre', 'items_comprados.cantidad', 'items_comprados.monto')->get();
        $montoFinal = 0;
        foreach($itemsComprado as $item){
            $montoFinal = $montoFinal + ($item->monto*$item->cantidad);
        }
        return response()->json(['success' => true,'itemsComprado'=>$itemsComprado, 'montoFinal'=>$montoFinal, 'venta'=>$venta, 'detalle_metodo'=>$detalle_metodo], 200);
    }
}
