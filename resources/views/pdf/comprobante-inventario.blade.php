<!DOCTYPE html>
<html lang="es">

<head>

    <link rel="stylesheet" type="text/css" href="{{ public_path() . '/css/landingpage/bootstrap.min.css' }}">
    <title>Comprobante de Pago</title>
    <style>
        * {
            font-family: Helvetica;
        }

        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <div class="container p-5">
        <h5 class="text-center text-success" style="font-family: Helvetica;">Veterinaria Gumiel</h5>
        <h5 class="text-center" style="font-family: Helvetica;">Comprobante de Pago</h5>
        <div class="p-3">
            <ul class="list-group">
                <li class="list-group-item">
                    <p class="fs-5">Num. Orden: {{ $venta->id_venta }}</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5">Metodo de Pago: {{ $venta->metodo_pago }}</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5">Fecha: {{ $venta->fecha }}</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5">Hora: {{ $venta->hora }}</p>
                </li>
                <li class="list-group-item">
                    <p class="fs-5">Nombre del Cliente: {{ $venta->nombre_cliente }}</p>
                </li>
            </ul>
        </div>
        <h4 class="mt-3">Productos</h4>
        <table class="table table-bordered" style="">
            <thead class="table-success">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Precio Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemsComprado as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>{{ $item->id }}</td>
                        <td>${{ number_format($item->monto, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total de la venta: ${{ number_format($montoFinal,0,',','.') }}</td>
            </tfoot>
        </table>
        <h5 class="text-center">Gracias por su compra</h5>
    </div>
</body>

</html>
