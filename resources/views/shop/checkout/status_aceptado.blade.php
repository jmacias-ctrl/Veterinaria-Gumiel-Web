@extends('layouts.app')
@section('title')
Carro de Compras - Veterinaria Gumiel
@endsection
@section('content')


Total de la Compra :-----------: {{$response->getAmount()}} <br>
Estado de Transaccion :--------: {{$response->getStatus()}} <br>
Orden de Compra :--------------: {{$response->getBuyOrder()}} <br>
Identificador de sesion :------: {{$response->getSessionId()}} <br>
Ultimos 4 numeros de targeta :-: {{$response->getCardDetail()['card_number'] }} <br> 
Fecha y Hora de autorizacion :-: {{$response->getTransactionDate()}} <br>
Codigo de Autorizacion :-------: {{$response->getAuthorizationCode()}} <br>
Tipo de Pago :-----------------: {{$response->getPaymentTypeCode()}} <br>
Respuesta de la Autorizacion :-: {{$response->getResponseCode()}} <br>
Monto de las Cuotas :----------: {{$response->getInstallmentsAmount()}} <br>
Numero de Cuotas :-------------: {{$response->getInstallmentsNumber()}} <br>

@endsection

@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

    Swal.fire({
        title: 'Rechazado',
        text: texto,
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Volver a la Tienda',
    }).then((result) => {

        if (result.isConfirmed) {
            location.href="{{ route('shop.shop') }}";
        }
    });
   
    </script>
@endsection