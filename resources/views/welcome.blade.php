@extends('layouts.app')
@section('title')
Inicio - Veterinaria Gumiel
@endsection

@section('content')

<!DOCTYPE html>
<html lang="es">

@include('landing-page-header')

<body>

  @include('landing-page-carrousel')

  @include('landing-page-agendar')

  @include('landing-page-servicios')

  @include('landing-page-contactanos')

  @include('landing-page-maps-gumiel')

  @include('landing-page-estilos-adicionales')

</body>

</html>


@endsection
