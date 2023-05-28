<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Http\Controllers\CompraController;
use App\Models\Compra;
use App\Models\productos_ventas;


class TransbankController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            Webpayplus::configureForProduction(
                env('WEBPAY_PLUS_CC'),
                env('WEBPAY_PLUS_API_KEY')
            );    
        }else{
            Webpayplus::configureForTesting();
        }
    }

    public function checkout(Request $request){
        $nueva_compra=new Compra();
        $nueva_compra->buy_order=rand();
        $nueva_compra->session_id=rand();
        $nueva_compra->total=\Cart::getTotal();
        $nueva_compra->save();
        $resp=self::start_web_pay_plus_transaction($nueva_compra);
        return response()->json(array('url'=> $resp->getUrl(),'token'=> $resp->getToken()), 200);

    }

    public function start_web_pay_plus_transaction($nueva_compra){
        $transaction = new Transaction();
        $response = $transaction->create($nueva_compra->id, $nueva_compra->session_id, $nueva_compra->total, route('confirmar'));
        return $response;
    
    }

    public function confirmar_pago(Request $request){
        $cartCollection = \Cart::getContent();
        foreach($cartCollection as $item){
            $item['stock']=productos_ventas::find($item->id)->stock;
        }
        $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
        if (!$token) {
            $status_err="-6";
            return view('/shop/checkout/status_rechazo',compact('status_err'));
        }
        $response = (new Transaction)->commit($token); // ó cualquiera de los métodos detallados en el ejemplo anterior del método create.
        
        if ($response->isApproved()) {
        return "aprobadassss"; 
        } else {
            $status_err=$response->getResponseCode();
            return view('/shop/checkout/status_rechazo',compact('status_err'));    
        }

    }
}
