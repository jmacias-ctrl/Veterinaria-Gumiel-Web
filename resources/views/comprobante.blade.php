<!-- comprobante.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <style>
        .container-comprobante {
            text-align: center;
            margin: 0 auto;
            max-width: 600px;
            border: 1px solid #ccc;
            padding: 20px;
        }

        .logo {
            text-align: center;
            width: 50px;
        }

        .metodo-pago {
            font-size: 18px;
            margin-top: 20px;
        }

        .orden-pedido,
        .cuotas,
        .tipo-pago,
        .monto-total {
            margin-top: 10px;
        }
    </style>

    <div class="container-comprobante">
        <div class="logo">
            <img src="{{ asset('images/') }}" alt="Logo de la empresa">
        </div>

        <div class="metodo-pago">
            <h2>Método de Pago: PayPal</h2>
        </div>
        <div class="orden-pedido">
            <p>Orden de Pedido: 18889021809280</p>
        </div>
        <div class="cuotas">
            <p>Cuotas: 0</p>
        </div>
        <div class="tipo-pago">
            <p>Tipo de Pago: Contado</p>
        </div>
        <div class="monto-total">
            <h2>Monto Total: $ 5990</h2>
        </div>

        
    </div>
</div>

@endsection