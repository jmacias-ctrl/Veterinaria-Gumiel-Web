<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos_ventas;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function shop(Request $request)

    {   
        
        $texto=$request->texto;
        
        $products = DB::table('productos_ventas')
                    ->select('id','nombre','id_marca','descripcion','slug','id_tipo','stock','min_stock','producto_enfocado','precio','imagen_path')
                    ->where('nombre','LIKE','%'.$texto.'%')
                    ->where('slug','LIKE','%'.$texto.'%')
                    ->paginate(20);
        return view('shop.shop',compact('texto'))->withTitle('GUMIEL TIENDA | TIENDA')->with(['products' => $products]);
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        foreach($cartCollection as $item){
            $item['stock']=productos_ventas::find($item->id)->stock;
            
        }
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
        $cartCollection = \Cart::getContent();
        $stock=productos_ventas::find($request->id)->stock;
        $cant=0;
        foreach($cartCollection as $item){
            if($item->id==$request->id){
                $cant=$item->quantity;
            }
        }
        if(($cant+$request->quantity)<=$stock){
            $tipo_msg='success_msg';
            $msg='Item Agregado a sú Carrito!';
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
        }elseif (!($stock-$cant)){
            $tipo_msg='alert_msg';
            $msg='No es posible Agregar más unidades de este Producto.';
        }else{
            $tipo_msg='alert_msg';
            $msg='No es posible Agregar '.$request->quantity.' unidad(es) de este Producto. Maximo '.$stock-$cant.' unidad(es)';
        }
        return redirect()->route('shop.shop')->with($tipo_msg, $msg);
    }

    public function update(Request $request){
        if($request->sor=="s"){
            $cant =$request->quantity+1;
        }
        if($request->sor=="r"){
            $cant =$request->quantity-1;
        }
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cant
                ),
        ));
        

        return response()->json([
            'id'=> $request->id,
            'quantity'=> $cant,
            'sor' => $request->sor

            
        ], 200);
    }

    public function clear(){
        \Cart::clear();
        return redirect()->route('shop.cart.index')->with('success_msg', 'Todos los items removidos!');
    }

 

}
