<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos_ventas;

class PointSaleController extends Controller
{
    public function index()
    {
        \Cart::session(auth()->user()->id)->clear();
        $productos = productos_ventas::all();
        return view('inventario.punto_de_venta.point_sale', compact('productos'));
    }

    public function update_product(Request $request){
        
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
    public function remove_product(Request $request){
        \Cart::session(auth()->user()->id)->remove($request->value);
        $cartItems = \Cart::session(auth()->user()->id)->getContent();
        $total = \Cart::session(auth()->user()->id)->getTotal();
        $subtotal = \Cart::session(auth()->user()->id)->getSubTotal();
        return response()->json(['success' => true, 'cartItems' => $cartItems, 'total' => $total, 'subTotal' => $subtotal], 200);
    }

    public function clear_products(){
        \Cart::session(auth()->user()->id)->clear();
        return response()->json(['success' => true], 200);
    }
}
