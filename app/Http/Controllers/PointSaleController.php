<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos_ventas;

class PointSaleController extends Controller
{
    public function index(Request $request)
    {
        \Cart::session(auth()->user()->id)->clear();
        $productos = productos_ventas::orderBy('nombre')->get();
        return view('inventario.punto_de_venta.point_sale', compact('productos'));
    }
    public function search(Request $request)
    {
        $productos = productos_ventas::where('nombre', 'like', '%' . $request->search . '%')->orderBy('nombre')->get();
        return response()->json(['success' => true, 'productos' => $productos], 200);
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
