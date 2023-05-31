@extends('layouts.app')
@section('title')
    Inicio - Veterinaria Gumiel
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="es">

    @include('landing-page-header')

    <body>

        @include('landing-page-floatIcons')

        @include('landing-page-carrousel')

        <!-- @component('landing-page-carrousel', [
            'id' => 'carouselExampleControls',
            'class' => 'w-50 col-md-6 mx-auto',
            'images' => [
                ['url' => asset('images/carrousel/01.png'), 'alt' => 'First slide'],
                ['url' => asset('images/carrousel/02.png'), 'alt' => 'Second slide'],
                ['url' => asset('images/carrousel/03.png'), 'alt' => 'Third slide'],
            ],
        ])
    @endcomponent -->

        @include('landing-page-agendar')

        @include('landing-page-servicios')

        <!-- @include('landing-page-contactanos') -->

        @include('landing-page-maps-gumiel')

        @include('landing-page-estilos-adicionales')
        @include('landing-page-footer')
    </body>

    </html>
@endsection
