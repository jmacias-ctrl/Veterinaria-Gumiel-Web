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
            width: 200px;
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

    @php
        $pedido_id = "18889021809280";
        $metodo_pago = "PayPal";
        $monto_total = "5990";
        $cuotas = "0";
        $tipo_pago = "Contado";
    @endphp

    <div class="container-comprobante">
        <div class="logo">
            <img src="{{ asset('image/logo2.jpg') }}" alt="Logo de la empresa">
        </div>
        <h2>Comprobante de pago</h2>
        <p>El pago por el pedido {{$pedido_id}} en {{ config('app.name') }} fue procesado de manera correcta.</p>
        <p>Se adjuntan los datos de la transaccion:</p>
        <hr>
        <div class="metodo-pago">
            <h2>Método de Pago: {{$metodo_pago}}</h2>
        </div>
        <hr>
        <div class="orden-pedido">
            <p>Orden de Pedido: {{$pedido_id}}</p>
        </div>
        <hr>
        <div class="cuotas">
            <p>Cuotas: {{$cuotas}}</p>
        </div>
        <hr>
        <div class="tipo-pago">
            <p>Tipo de Pago: {{$tipo_pago}}</p>
        </div>
        <hr>
        <div class="monto-total">
            <h2>Monto Total: $ {{$monto_total}}</h2>
        </div>
        <hr>
        <button class="btn btn-danger" type="button">Descargar como PDF</button>
        
    </div>
</div>

@endsection