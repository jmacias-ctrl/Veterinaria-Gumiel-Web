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


<!-- @extends('layouts.appshop')

@section('content')
<?php
// $status_err
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

                

        var texto;
        switch (<?php //echo $status_err; ?>) {
            case -1:
                texto="Error en el ingreso de datos de la Transacción.";
                break;
            case -2:
                texto="Se produjo fallo al procesar la transacción, este mensaje de rechazo se encuentra relacionado a parámetros de la tarjeta y/o su cuenta asociada.";
                break;
            case -3:
                texto="Error en Transacción.";
                break;
            case -4:
                texto="Rechazada por parte del emisor.";
                break;
            case -5:
                texto="Transacción con riesgo de posible fraude.";
                break;
            case -6:
                texto="Transacción con flujo de pago anormal.";
                break;
        }

        Swal.fire({
            title: 'Rechazado',
            text: texto,
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reintentar',
            cancelButtonText: 'Volver a la Tienda',
        }).then((result) => {

            if (result.isConfirmed) {
                location.href="{{ route('shop.checkout.checkout') }}";
            }else{
                location.href="{{ route('shop.shop') }}";
            }
        });

        
   
    </script>
@endsection
<style>
html{
    background:url("/image/fondo-tienda.png");
    background-repeat: repeat;
    background-attachment: fixed;
    background-size:400px;
    backdrop-filter:blur(1px);
        }
</style> -->