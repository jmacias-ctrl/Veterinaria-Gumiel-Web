<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <style>
        * {
            font-family: 'Cabin', sans-serif;
        }

        .email-content:not(.userInfo) {
            display: inline-block;
            align-self: center;
            text-align: center;
            margin: auto;
            width: 80%;
            border: 3px solid green;
            padding: 10px;
        }

        .userInfo {
            display: inline-block;
            border-style: solid;
            border-color: black;
            border-width: 1px;
            border-radius: 10px;
            width: 40%;
            text-align: center;
            padding: 15px;
            padding-left: 20px;
            padding-right: 20px;
            margin-top: 20px;
            margin-bottom: 25px;
            background: #FFF0C9;
        }

        .list-group {
            display: block;
            text-align: left;
            align-content: flex-start;
            list-style-type: none;
            padding: 0;
        }


        .div-list-group-item {
            padding: 5px;
            border-style: solid;
            border-color: black;
            background: white;
            justify-content: center;
            border-width: 1px;
            border-radius: 10px;
            opacity: 0.6;
            margin-top: 5px;
            word-wrap: break-word;
        }

        .bold {
            font-weight: bold;
            opacity: 1;
        }

        #cancel{
            width: 25%;
        }

        #logo {
            width: 100%
        }

        .buttonAction {
            width: 80%;
            height: 80px;
            background: #2E7646;
            font-size: 25px;
            color: white;
            border: none;
        }

        @media screen and (min-width: 1024px) {
            #logo {
                width: 40%
            }

            .buttonAction {
                width: 30%;
                height: 80px;
                background: #2E7646;
                font-size: 25px;
                color: white;
                border: none;
            }
        }

        @media screen and (max-width: 820px) {
            .userInfo {
                display: inline-block;
                border-style: solid;
                border-color: black;
                border-width: 1px;
                border-radius: 10px;
                margin-left: -21px;
                width: 100%;
                text-align: center;
                padding: 15px;
                padding-left: 20px;
                padding-right: 20px;
                margin-top: 20px;
                margin-bottom: 25px;
                background: #FFF0C9;
            }
        }
    </style>
</head>
<body style="background:#2E7646; display:flex; align-content: center;">
<div class="email-content .center" style="background:white;">
        <header class="my-2">
            <a href="{{ url('') }}">
                <div class="d-flex justify-content-center">
                    <img id="logo" src="{{ asset('image/logo2.jpg') }}" alt="">
                </div>
            </a>
        </header>
        <hr>

        <main style="padding: 25px">
            <h1>Cancelación de hora</h1>
            <img src="{{asset('image/cancel.png')}}" id="cancel" alt="">
            @if (auth()->user()->hasRole('Cliente'))
                <p style="font-size: 20px">Tu hora con el paciente <b>{{$ReservarCita->paciente->name}}</b> para <b>{{$ReservarCita->tiposervicio->nombre}}</b>
                , el día <b>{{$ReservarCita->scheduled_date}}</b>
                 a las <b>{{$ReservarCita->sheduled_time}}</b> 
                (Descripción: {{$ReservarCita->description}}) ha sido CANCELADA.
                Motivo de la cancelacion: <b>{{$ReservarCita->cancellation->justification}}</b>
                </p>
            @elseif (auth()->user()->hasRole('Veterinario') || auth()->user()->hasRole('Peluquero'))
               <p style="font-size: 20px">Tu hora con el funcionario <b>{{$ReservarCita->funcionario->name}}</b> para <b>{{$ReservarCita->tiposervicio->nombre}}</b>
                , el día <b>{{$ReservarCita->scheduled_date}}</b>
                 a las <b>{{$ReservarCita->sheduled_time}}</b> 
                (Descripción: {{$ReservarCita->description}}) ha sido CANCELADA.
                Motivo de la cancelacion: <b>{{$ReservarCita->cancellation->justification}}</b>
                Recomendamos que revises nuevamente las horas disponibles y agendes una nueva hora con nosotros.
                Lamentamos los inconvenientes.
                </p>  
            @endif    
        </main>

        <hr>
        <footer>
            <p style="opacity: 0.7;">© 2023 Veterinaria Gumiel. Todos los derechos reservados.
            </p>
        </footer>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>
</html>