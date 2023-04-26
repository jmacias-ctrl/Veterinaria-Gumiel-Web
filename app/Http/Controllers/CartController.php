<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos_ventas;

class CartController extends Controller
{
    public function shop()
    {
        $products = productos_ventas::all();
        return view('shop.shop')->withTitle('GUMIEL TIENDA | TIENDA')->with(['products' => $products]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        return view('shop.cart')->withTitle('GUMIEL TIENDA | CARRITO')->with(['cartCollection' => $cartCollection]);
    }

    public function show($id)  {
        $producto = productos_ventas::find($id);
        return view('shop.show')->withTitle('GUMIEL TIENDA | CARRITO')->with(['producto' => $producto]);
    }


    public function remove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('shop.cart.index')->with('success_msg', 'Item Removido!');
    }

    public function add(Request $request){
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug
            )
        ));
        return redirect()->route('shop.cart.index')->with('success_msg', 'Item Agregado a sú Carrito!');
    }

    public function update(Request $request){
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('shop.cart.index')->with('success_msg', 'Item Atualizado Correctamente!');
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('shop.cart.index')->with('success_msg', 'Carrito Vacio!');
    }

 

}
