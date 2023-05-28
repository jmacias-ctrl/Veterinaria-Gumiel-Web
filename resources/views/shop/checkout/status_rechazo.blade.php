@extends('layouts.app')

@section('content')
<?php
$status_err

?>

          
@endsection

@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

                

        var texto;
        switch (<?php echo $status_err; ?>) {
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
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Volver a la Tienda',
        }).then((result) => {

            if (result.isConfirmed) {
                location.href="{{ route('shop.cart.index') }}";
            }
        });

        
   
    </script>
@endsection