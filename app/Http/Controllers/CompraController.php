<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;
use App\Models\productos_ventas;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Transbank\Webpay\WebpayPlus\Transaction;


use Illuminate\Support\Facades\DB;
use DataTables;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartCollection = \Cart::getContent();
        foreach($cartCollection as $item){
            $item['stock']=productos_ventas::find($item->id)->stock;
            
        }
        return view('shop.checkout.checkout')->withTitle('GUMIEL TIENDA | CHECKOUT')->with(['cartCollection' => $cartCollection]);
    }

    public function login(){
        return view('shop.checkout.login')->withTitle('GUMIEL TIENDA | CHECKOUT');
    }

    public function resumen_compra(Request $request){
        $cartCollection = \Cart::getContent();
        foreach($cartCollection as $item){
            $item['stock']=productos_ventas::find($item->id)->stock;
            
        }
        $response = (new Transaction)->status($request->token);
        $compra=Compra::find($response->buyOrder);
        $compra->token=$request->token;
        $compra->status=$response->status;
        $compra->save();
        return view('shop.checkout.resumen-compra')->with(['response'=>$response])->with(['cartCollection' => $cartCollection]);

    }

    public function finish($status_finish){
        if (!$status_finish) {
            \Cart::clear();
            return redirect()->route('shop.shop');
        } else {
            return redirect()->route('shop.checkout.checkout');
        }
        

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompraRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompraRequest  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
