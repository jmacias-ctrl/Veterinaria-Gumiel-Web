@extends('layouts.panel_usuario')
<title>Modificacion de Ubicacion - Veterinaria Gumiel</title>
@section('css-before')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    .imageProfile {
        width: 150px;

    }
</style>
@endsection
@section('js-before')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('back-arrow')
<a href="{{ route('user.profile.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
        arrow_back
    </span> </a>
@endsection
@section('header-title')
Modificacion del Perfil {{ Auth::user()->name }}
@endsection
@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            @if (auth()->user()->hasRole('Admin'))
            <a href="{{ route('admin') }}" style="color:black;">
                @elseif(auth()->user()->hasRole('Veterinario'))
                <a href="{{ route('veterinario') }}">
                    @elseif (auth()->user()->hasRole('Peluquero'))
                    <a href="{{ route('peluquero') }}">
                        @elseif (auth()->user()->hasRole('Inventario'))
                        <a href="{{ route('inventario') }}">
                            @endif
                            Inicio</a>
        </li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.profile.index') }}" style="color:black;">Perfil de {{ auth()->user()->name }}</a> </li>
        <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Landing Page</li>
</nav>
@endsection
@section('content')
  @include('trazabilidad/trazabilidad-productos-y-servicios')
@endsection