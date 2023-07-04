<?php
namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\productos_ventas;
use App\Models\Marcaproducto;
use App\Models\tipoproductos_ventas;
use App\Models\Especie;
use App\Models\TipoCategorias;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function shop(Request $request)
    {
        
        $cartCollection = \Cart::getContent();
        foreach($cartCollection as $item){
            $item['stock']=productos_ventas::find($item->id)->stock;
            $item['marca']=Marcaproducto::find(productos_ventas::find($item->id)->id_marca)->nombre;
        }
        $products = productos_ventas::all();
        $Marcaproducto=Marcaproducto::all();
        $Tipoproducto=tipoproductos_ventas::all();
        $Tipoespecie=Especie::all();
        $Categorias=Categorias::all();
        $Subcategorias=TipoCategorias::all();

        for($i=0; $i<count($products);$i++){
            $products[$i]->marca=Marcaproducto::find($products[$i]->id_marca)->nombre;
            $products[$i]->tipo=tipoproductos_ventas::find($products[$i]->id_tipo)->nombre;
            $products[$i]->enfoque_especie=Especie::find($products[$i]->producto_enfocado)->nombre;
            if($products[$i]->stock==0){
                $stockcero=$products[$i];
                $products["ss".$i]=$stockcero;
                 unset($products[$i]);
            }

        }
        return view('shop.shop')->withTitle('GUMIEL TIENDA | TIENDA')->with([
            'products' => $products,
            'cartCollection' => $cartCollection,
            'marcaProductos' => $Marcaproducto,
            'tipoProductos' => $Tipoproducto,
            'tipoEspecies' => $Tipoespecie,
            'categorias' => $Categorias,
            'subcategorias' => $Subcategorias
        ]);
        
    }

    public function cart()  {
        $cartCollection = \Cart::getContent();
        foreach($cartCollection as $item){
            $item['stock']=productos_ventas::find($item->id)->stock;
            $item['marca']=Marcaproducto::find(productos_ventas::find($item->id)->id_marca)->nombre;

            
        }
        return view('shop.cart')->withTitle('GUMIEL TIENDA | CARRITO')->with(['cartCollection' => $cartCollection]);
    }

    public function show($id)  {
        $producto = productos_ventas::find($id);
        return view('shop.show')->withTitle('GUMIEL TIENDA | CARRITO')->with(['producto' => $producto]);
    }


    public function remove(Request $request){
        if(\Cart::get($request->id)->quantity) $mensaje="¡Producto eliminado con exito!";
        else $mensaje="¡Productos eliminados con exito!";
        \Cart::remove($request->id);
        return response()->json([
            'mensaje'=> $mensaje,
            'total' => \Cart::getTotal()
        ], 200);
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
            $tipo_mensaje='success';
            $mensaje='Item Agregado a sú Carrito!';
            \Cart::add(array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->image,
                    'slug' => $request->slug
                )
            ));
        }elseif (!($stock-$cant)){
            $tipo_mensaje='danger';
            $mensaje='No es posible Agregar más unidades de este Producto.';
        }else{
            $tipo_mensaje='warning';
            $mensaje='No es posible Agregar '.$request->quantity.' unidad(es) de este Producto. Maximo '.$stock-$cant.' unidad(es)';
        }
        return response()->json([
            'tipo_mensaje' => $tipo_mensaje,
            'mensaje' => $mensaje,
            'cantcarro' => \Cart::getTotalQuantity(),
            'carro' => \Cart::getContent(),
            'total' => \Cart::getTotal(),
            'subtotal' => \Cart::get($request->id)->getPriceSum(),
            'cantidad' => \Cart::getContent()[$request->id]->quantity,
            'cantidadanterior' => $request->quantity
        ], 200);
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
            'sor' => $request->sor,
            'total' => \Cart::getTotal(),
            'sumatotal' => \Cart::get($request->id)->getPriceSum()
        ], 200);
    }

    public function clear(){
        \Cart::clear();
        return response()->json([
            'mensaje'=> '¡Carrito vacio!',
            'total' => \Cart::getTotal()
        ], 200);
    }

 

}
