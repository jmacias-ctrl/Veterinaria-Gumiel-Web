<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productos_venta;

class CarroController extends Controller
{
    public function shop()
    {
        $productos = productos_venta::all();
        return view('shop.shop')->withTitle('EA-COMMERCE STORE | SHOP')->with(['productos' => $productos]);
    }

    public function cart()  {
        $carroCollection = \Cart::getContent();
        dd($carroCollection);
        return view('cart')->withTitle('E-COMMERCE STORE | CARRO')->with(['carroCollection' => $carroCollection]);;
    }
}
