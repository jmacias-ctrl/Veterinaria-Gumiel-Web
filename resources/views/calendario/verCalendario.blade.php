@extends('layouts.app')

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
    <section id="contact" style="background-color: white;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Calendario de trabajadores</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form style="background-color: #2E7646; color: black; border-radius: 10px; padding: 30px 40px 0px 40px; ">
                    <div class="form-group">

                        @foreach ($horario as $item)
                            @if ($item->user->roles()->first()->name=='Veterinario')
                                <div>
                                    <h3 style="color:white">{{ $item->user->roles()->first()->name }}</h3>
                                    <h5>{{ $item->user->name }}</h5>
                                    <div>
                                        <label>Horario: </label>
                                        <label>{{ $item->entrada}} - {{ $item->salida }}</label>
                                    </div>
                                    <br>
                                </div>
                            @endif                    
                        @endforeach

                        @foreach ($horario as $item)
                            @if ($item->user->roles()->first()->name=='Peluquero')
                                <div>
                                    <h3 style="color:white">{{ $item->user->roles()->first()->name }}</h3>
                                    <h5>{{ $item->user->name }}</h5>
                                    <div>
                                        <label>Horario: </label>
                                        <label>{{ $item->entrada}} - {{ $item->salida }}</label>
                                    </div>
                                    <br>
                                </div>
                            @endif
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>    
@endsection