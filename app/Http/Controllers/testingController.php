<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\servicios;
use App\Models\tiposervicios;
use Illuminate\Support\Facades\Validator;

class TestingController extends Controller
{
    public function index(Request $request)
    {
        $response = (object) [
            'getBuyOrder' => '123456789',
            'getAmount' => 1000,
            'getAuthorizationCode' => 'ABC123',
            'getInstallmentsNumber' => 3,
            'getInstallmentsAmount' => 333.33,
            'getCardDetail' => (object) [
                'card_number' => '1234',
            ],
        ];

        return view('emails.comprobante_pago')->with('response', $response);

        // return view('emails.comprobante_pago', []);
    }
}
