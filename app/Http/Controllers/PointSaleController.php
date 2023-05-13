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

        $nuevaVenta  = new trazabilidad_venta_presencial();
        $nuevaVenta->nombre_cliente = $request->nombreCliente;
        $nuevaVenta->id_operador = auth()->user()->id;
        $nuevaVenta->save();
        $montoFinal = 0;
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
            $producto->save();
        }

        
        switch($request->metodoPago){
            case 'transferencia':
                $transferencia = new transferencia();
                $transferencia->banco = $request->banco;
                $transferencia->num_operacion=$request->numOperacion;
                $transferencia->id_operacion = $nuevaVenta->id;
                $transferencia->save();
                break;
            case 'efectivo':
                $efectivo = new efectivo();
                $efectivo->efectivo = $request->montoEfectivo;
                $efectivo->vuelto = $request->montoEfectivo - $montoFinal;
                $efectivo->id_operacion = $nuevaVenta->id;
                $efectivo->save();
                break;
            case 'tarjeta':
                $tarjeta = new tarjeta();
                $tarjeta->num_operacion = $request->numOperacion;
                $tarjeta->id_operacion = $nuevaVenta->id;
                $tarjeta->save();
                break; 
        }

        \Cart::session(auth()->user()->id)->clear();

        return redirect()->route('point_sale.index');
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
}
