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
use Illuminate\Support\Facades\Mail;
use App\Mail\ComprobanteVentaPresencial;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return response()->json(['success' => true, 'cartItems' => $cartItems, 'total' => $total, 'subTotal' => $subtotal, 'updatedQuantity' => $getQuantity], 200);
    }
    public function venta(Request $request)
    {
        $cartGet = \Cart::session(auth()->user()->id)->getContent();
        $fecha = Carbon::now();
        $fecha_t = $fecha->toDateString();
        $hora = $fecha->format('h:i:s');
        $nuevaVenta  = new trazabilidad_venta_presencial();
        $nuevaVenta->id_venta = Str::random(10);
        $nuevaVenta->metodo_pago = $request->metodoPago;
        $nuevaVenta->nombre_cliente = $request->nombreCliente;
        $nuevaVenta->id_operador = auth()->user()->id;
        $nuevaVenta->fecha_compra = $fecha->toDateTimeString();
        $nuevaVenta->save();
        $montoFinal = 0;
        $metodoPagoEscogido = null;
        foreach ($cartGet as $item) {
            $itemComprado =  new items_comprados();
            $itemComprado->monto = $item->price;
            $itemComprado->cantidad = $item->quantity;
            $itemComprado->id_producto = $item->id;
            $itemComprado->id_venta = $nuevaVenta->id;
            $itemComprado->tipo_item = "producto";
            $itemComprado->save();
            $montoFinal = $montoFinal + ($itemComprado->monto * $itemComprado->cantidad);

            $producto = productos_ventas::find($item->id);
            $producto->stock = $producto->stock - $item->quantity;
            if ($producto->stock <= 0) {
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->can('acceso administracion de stock')) {
                        $user->notify(new StockProductoInventario($producto, true));
                    }
                }
            } else if ($producto->stock < $producto->min_stock) {
                $users = User::all();
                foreach ($users as $user) {
                    if ($user->can('acceso administracion de stock')) {
                        $user->notify(new StockProductoInventario($producto, false));
                    }
                }
            }
            $producto->save();
        }


        switch ($request->metodoPago) {
            case 'transferencia':
                $transferencia = new transferencia();
                $transferencia->banco = $request->banco;
                $transferencia->num_operacion = $request->numOperacion;
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
        return response()->json(['success' => true, 'metodoPago' => $request->metodoPago, 'fecha' => $fecha_t, 'hora' => $hora, 'productosComprados' => $cartGet, 'montoFinal' => $montoFinal, 'nuevaVenta' => $nuevaVenta, 'ventaId'=>$nuevaVenta->id], 200);
    }
    public function comprobante($id)
    {
        $venta = trazabilidad_venta_presencial::find($id);
        $detalle_metodo = null;
        $venta->fecha = Carbon::parse($venta->fecha_compra)->format('d-m-Y');
        $venta->hora = Carbon::parse($venta->fecha_compra)->format('h:i:s A');
        if ($venta->metodo_pago == "efectivo") {
            $detalle_metodo = efectivo::where('id_operacion', '=', $venta->id)->first();
        } else if ($venta->metodo_pago == "tarjeta") {
            $detalle_metodo = tarjeta::where('id_operacion', '=', $venta->id)->first();
        } else {
            $detalle_metodo = transferencia::where('id_operacion', '=', $venta->id)->first();
        }
        $itemsComprado = items_comprados::with('productos_ventas', 'servicios')->where('id_venta', '=', $venta->id)->get()->map(function ($item) {
            if ($item->tipo_item == "servicio") {
                $item->nombre = $item->servicios->nombre;
            } else {
                $item->nombre = $item->productos_ventas->nombre;
            }
            return $item;
        });
        $montoFinal = 0;
        foreach ($itemsComprado as $item) {
            $montoFinal = $montoFinal + ($item->monto * $item->cantidad);
        }
        $pdf = \Pdf::loadView('pdf.comprobante-inventario', compact('venta','detalle_metodo', 'itemsComprado', 'montoFinal'));
        return $pdf;
    }
    public function descarga_comprobante(Request $request){
        $pdf = $this->comprobante($request->ventaId);
        return $pdf->download('invoice.pdf');
    }
    public function enviar_comprobante(Request $request){
        $pdf = $this->comprobante($request->ventaId);
        $venta = trazabilidad_venta_presencial::find($request->ventaId);
        $correo = new ComprobanteVentaPresencial($venta->nombre_cliente);
        $correo->attachData($pdf->output(), 'comprobante.pdf');
        Mail::to($request->email_cliente)->send($correo);
        return back()->with('success', 'Correo con el comprobante enviado');
    }
    public function add_product(Request $request)
    {
        if ($request->has('codigo')) {
            $producto = productos_ventas::where('codigo', '=', $request->codigo)->first();
        }
        if ($request->has('value')) {
            $producto = productos_ventas::find($request->value);
        }
        if(!isset($producto)){
            return response()->json(['success' => false], 200);
        }
        $quantity = $request->cantProduct;
        $cartGet = \Cart::session(auth()->user()->id)->get($producto->id);
        if (isset($cartGet)) {
            if ($cartGet->quantity + $quantity > $producto->stock) {
                $quantity = 0;
            }
            \Cart::session(auth()->user()->id)->update($producto->id, [
                'quantity' => $quantity,
            ]);
        } else {
            if ($quantity <= $producto->stock) {
                \Cart::session(auth()->user()->id)->add(array(
                    'id' => $producto->id,
                    'name' => $producto->nombre,
                    'price' => $producto->precio,
                    'quantity' => $quantity,
                    'attributes' => array(),
                    'associatedModel' => $producto
                ));
            }
        }


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
    public function mostrar_ventas(Request $request)
    {
        if ($request->ajax()) {
            $data = db::table('trazabilidad_venta_presencials')
                ->join('items_comprados', 'items_comprados.id_venta', '=', 'trazabilidad_venta_presencials.id')
                ->select('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'trazabilidad_venta_presencials.metodo_pago', 'trazabilidad_venta_presencials.fecha_compra', 'nombre_cliente', db::raw('sum(items_comprados.monto*items_comprados.cantidad) as monto'))
                ->groupBy('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'trazabilidad_venta_presencials.metodo_pago', 'nombre_cliente', 'trazabilidad_venta_presencials.fecha_compra')
                ->get()->map(function ($item) {
                    $carbon = Carbon::parse($item->fecha_compra);
                    $item->fecha = $carbon->format('d-m-Y');
                    $item->metodo_pago = ucfirst($item->metodo_pago);
                    $item->hora = $carbon->format('h:i:s A');
                    $item->monto = '$' . number_format($item->monto, 0, ',', '.');
                    return $item;
                });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'inventario.ventas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('inventario.ventas.index');
    }

    public function detalle_venta(Request $request)
    {
        $venta = trazabilidad_venta_presencial::find($request->id);
        $detalle_metodo = null;
        $venta->fecha = Carbon::parse($venta->fecha_compra)->format('d-m-Y');
        $venta->hora = Carbon::parse($venta->fecha_compra)->format('h:i:s A');
        $venta->estado = "entregado";
        if ($venta->metodo_pago == "efectivo") {
            $detalle_metodo = efectivo::where('id_operacion', '=', $venta->id)->first();
        } else if ($venta->metodo_pago == "tarjeta") {
            $detalle_metodo = tarjeta::where('id_operacion', '=', $venta->id)->first();
        } else {
            $detalle_metodo = transferencia::where('id_operacion', '=', $venta->id)->first();
        }
        $itemsComprado = items_comprados::with('productos_ventas', 'servicios')->where('id_venta', '=', $venta->id)->get()->map(function ($item) {
            if ($item->tipo_item == "servicio") {
                $item->nombre = $item->servicios->nombre;
            } else {
                $item->nombre = $item->productos_ventas->nombre;
            }
            return $item;
        });
        $montoFinal = 0;
        foreach ($itemsComprado as $item) {
            $montoFinal = $montoFinal + ($item->monto * $item->cantidad);
        }
        return response()->json(['success' => true, 'itemsComprado' => $itemsComprado, 'montoFinal' => $montoFinal, 'venta' => $venta, 'detalle_metodo' => $detalle_metodo], 200);
    }
    public function pedidos_online(Request $request)
    {
        if ($request->ajax()) {
            $data = db::table('trazabilidad_venta_presencials')
                ->join('items_comprados', 'items_comprados.id_venta', '=', 'trazabilidad_venta_presencials.id')
                ->join('users', 'users.id', '=', 'trazabilidad_venta_presencials.id_cliente')
                ->where('trazabilidad_venta_presencials.estado', '!=', "entregado")
                ->select('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'users.name', 'users.rut', 'users.email', 'trazabilidad_venta_presencials.fecha_compra', 'trazabilidad_venta_presencials.estado', db::raw('sum(items_comprados.monto*items_comprados.cantidad) as monto'))
                ->groupBy('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'users.name', 'users.rut', 'users.email', 'trazabilidad_venta_presencials.fecha_compra', 'trazabilidad_venta_presencials.estado')
                ->get()->map(function ($item) {
                    $carbon = Carbon::parse($item->fecha_compra);
                    $item->fecha = $carbon->format('d-m-Y');
                    $item->hora = $carbon->format('h:i:s A');
                    $item->monto = '$' . number_format($item->monto, 0, ',', '.');
                    return $item;
                });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'inventario.ventas.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('inventario.ventas.ventas_online');
    }
    public function mis_pedidos(Request $request)
    {
        if ($request->ajax()) {
            $data = db::table('trazabilidad_venta_presencials')
                ->join('items_comprados', 'items_comprados.id_venta', '=', 'trazabilidad_venta_presencials.id')
                ->select('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'trazabilidad_venta_presencials.fecha_compra','trazabilidad_venta_presencials.estado', db::raw('sum(items_comprados.monto*items_comprados.cantidad) as monto'))
                ->where('id_cliente', '=', auth()->user()->id)
                ->groupBy('trazabilidad_venta_presencials.id', 'trazabilidad_venta_presencials.id_venta', 'trazabilidad_venta_presencials.fecha_compra','trazabilidad_venta_presencials.estado')
                ->get()->map(function ($item) {
                    $carbon = Carbon::parse($item->fecha_compra);
                    $item->fecha = $carbon->format('d-m-Y');
                    $item->hora = $carbon->format('h:i:s A');
                    $item->monto = '$' . number_format($item->monto, 0, ',', '.');
                    return $item;
                });

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'users.datatable.action_pedidos')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('users.mis_pedidos');
    }

    public function cambiar_estado_pedido(Request $request)
    {
        $venta = trazabilidad_venta_presencial::find($request->id);
        $venta->estado = $request->estado;
        $venta->save();
        return redirect()->route('pedidos_online.index')->with('success', 'Estado modificado exitosamente');
    }

    public function ver_pedido(Request $request)
    {
        $venta = trazabilidad_venta_presencial::find($request->id);
        $venta->fecha = Carbon::parse($venta->fecha_compra)->format('d-m-Y');
        $venta->hora = Carbon::parse($venta->fecha_compra)->format('h:i:s A');
        $itemsComprado = items_comprados::with('productos_ventas', 'servicios')->where('id_venta', '=', $venta->id)->get()->map(function ($item) {
            if ($item->tipo_item == "servicio") {
                $item->nombre = $item->servicios->nombre;
            } else {
                $item->nombre = $item->productos_ventas->nombre;
            }
            return $item;
        });
        $montoFinal = 0;
        foreach ($itemsComprado as $item) {
            $montoFinal = $montoFinal + ($item->monto * $item->cantidad);
        }
        return response()->json(['success' => true, 'itemsComprado' => $itemsComprado, 'montoFinal' => $montoFinal, 'venta' => $venta], 200);
    }
}
