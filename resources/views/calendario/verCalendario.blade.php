@extends('layouts.panel_usuario')
<title>Administrador Inicio - Veterinaria Gumiel</title>
@section('css-before')
    <style>
        .imageProfile {
            width: 120px;
        }

        .circle {
            border-radius: 100%;
            height: 200px;
            width: 200px;
            object-fit: cover;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center">Trabajadores Disponible Hoy</h2>
                    </div>
                </div>
                <div class="row">
                    @if (sizeof($horario) > 0)
                        <div class="col-md-6 mx-auto">


                            <div style="background-color: #2E7646; color: black; border-radius: 10px; padding: 20px; ">


                                @foreach ($horario as $item)
                                    @if ($item->role == 'Veterinario')
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="column">
                                                @if (isset($item->image))
                                                    <img src="{{ asset('storage') . '/' . $item->image }}" alt=""
                                                        class="imageProfile">
                                                @else
                                                    <img src="{{ asset('image/default-user-image.png') }}" alt=""
                                                        class="imageProfile">
                                                @endif
                                            </div>
                                            <div class="column">
                                                <h3 style="color:white">{{ $item->name }}</h3>
                                                <h5 style="color:white">{{ $item->role }}</h5>
                                                <div>
                                                    <label style="color:white">Horario: </label>
                                                    <label style="color:white">{{ $item->start }} -
                                                        {{ $item->end }}</label>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6 mx-auto">
                            <div style="background-color: #2E7646; color: black; border-radius: 10px; padding: 20px; ">
                                @foreach ($horario as $item)
                                    @if ($item->role == 'Peluquero')
                                        <div class="row justify-content-center align-items-center g-2">
                                            <div class="column">
                                                @if (isset($item->image))
                                                    <img src="{{ asset('storage') . '/' . $item->image }}" alt=""
                                                        class="imageProfile">
                                                @else
                                                    <img src="{{ asset('image/default-user-image.png') }}" alt=""
                                                        class="imageProfile">
                                                @endif
                                            </div>
                                            <div class="column">
                                                <h3 style="color:white">{{ $item->name }}</h3>
                                                <h5 style="color:white">{{ $item->role }}</h5>
                                                <div>
                                                    <label style="color:white">Horario: </label>
                                                    <label style="color:white">{{ $item->start }} -
                                                        {{ $item->end }}</label>
                                                </div>
                                                <br>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @else
                            <h4>No hay trabajadores disponibles hoy</h4>
                    @endif
                </div>
        </section>
    </body>

    </html>
@endsection
