<!-- <link rel="stylesheet" href="{{ asset('css/landingpage/bootstrap.min.css') }}"> -->

<div class="bg-white shadow d-flex pr-5 pl-5 pt-4 pb-4 mb-2" style="border-radius: 15px;">
    <div class="align-items-center" style="display: flex; justify-content: space-between; width:100%;">
        <h1 class="font-weight-bold m-0"><i class="bi bi-card-checklist mr-3"></i>Resumen de compra</h1>
        <div class="font-weight-bold m-0">
            <img src="{{ asset('image/logo2.jpg') }}" alt="Icono" class="mr-3" width="300">
        </div>
    </div>
</div>
<div class="bg-white shadow p-4" style="border-radius: 15px;">
    <!-- resumen de compra -->
    <div id="aceptada">
        <div class="col-12" style="display:flex; justify-content:center">
            <i class="bi bi-check-circle" style="color:green; font-size:80px;"></i>
        </div>
        <div class="col-12 p-4" style="display:flex; justify-content:center">
            <h2>Compra Exitosa</h2>
        </div>
        <div class="col-12 p-4 bg-light bg-ligth shadow" style="border-radius: 15px;">
            <div>
                <h2 class="mt-5 pl-3 pr-3 font-weight-normal">Detalles de Cliente</h2>
            </div>
            <!-- <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Tipo Cliente:</span>
                <span class="m-0">{{Auth::user()->roles[0]->name}}</span>
            </div> -->
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Nombre Cliente:</span>
                <span class="m-0">{{Auth::user()->name}}</span>
            </div>
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Rut Cliente:</span>
                <span class="m-0">{{Auth::user()->rut}}</span>
            </div>
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Email Cliente:</span>
                <span class="m-0">{{Auth::user()->email}}</span>
            </div>
            <br>
            
            <div>
                <h2 class=" pl-3 pr-3 font-weight-normal">Detalles de Compra</h2>
            </div>
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Numero de Orden:</span>
                <span class="m-0">{{$response->getBuyOrder()}}</span>
            </div>
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Tipo Pago:</span>
                <span id="tipo_pago" class="m-0">Online</span>
            </div>
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Fecha de Transacción:</span>
                <span id="fecha" class="m-0">{{$fecha}}</span>
            </div>
            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Hora de Transacción:</span>
                <span id="hora" class="m-0">{{$hora}}</span>
            </div>
            <div class="mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <!-- <h2>Datos de Productos</h2> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items_comprados as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>${{ number_format($item['price'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>

            <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Monto Pagado:</span>
                <span class="m-0">${{ number_format($response->getAmount(), 0, ',', '.') }}</span>
            </div>
            <!-- <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Codigo de Autorización:</span>
                <span class="m-0">{{$response->getAuthorizationCode()}}</span>
            </div> -->
            <!-- <div id="num_cuotas">
                <div id="num_cuotas" class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                    <span class="m-0">Numero de Cuotas:</span>
                    <span id="num_cuotas_span" class="m-0">{{$response->getInstallmentsNumber()}}</span>
                </div>
            </div> -->
            <!-- <div id="mon_cuotas">
                <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                    <span class="m-0">Monto de Cuotas:</span>
                    <span id="mon_cuotas_span" class="m-0">${{ number_format($response->getInstallmentsAmount(), 0, ',', '.') }}</span>
                </div>
            </div> -->
            <!-- <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Numero de Tarjeta:</span>
                <span class="m-0">**** **** **** {{$response->getCardDetail()['card_number']}}</span>
            </div> -->
            <!-- <div class="d-flex justify-content-between mt-4 p-2 pl-3 pr-3 bg-white" style="border-radius: 15px;">
                <span class="m-0">Fecha de Expiración:</span>
                <span id="fecha_targeta" class="m-0"></span>
            </div> -->
            
        </div>
    </div>
    <!-- <div id="rechazada">
        <div class="col-12" style="display:flex; justify-content:center">
            <i class="bi bi-x-circle" style="color:red; font-size:80px;"></i>
        </div>
        <div class="col-12 p-4" style="display:flex; justify-content:center">
            <h2>Compra Fallida</h2>
        </div>
        <div id="texto" class="col-12" style="text-align: center;"></div>
    </div> -->
</div>