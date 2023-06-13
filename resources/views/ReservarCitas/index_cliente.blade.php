@extends('layouts.app')
<title>Gestión citas - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Gestion citas
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Pacientes</li>
    </nav>
@endsection
@section('content')

<div class="form-row">
    <div class="col-md-3">
        <div class="card m-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agendar-horas.create') }}">
                    <span class="material-icons"style="position:relative; top:6px">schedule</span> Agendar hora</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('/miscitas')) active @endif" href="{{route('Agendar')}}">
                    <span class="material-icons" style="position:relative; top:6px">calendar_month</span> Mis citas</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow me-3">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">Mis Citas</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif

                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" data-toggle="tab" 
                            href="#mis-citas" role="tab" aria-selected="true">
                            <i class="ni ni-calendar-grid-58 mr-2"></i>Mis citas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0"  data-toggle="tab" 
                            href="#citas-pendientes" role="tab" aria-selected="false">
                            <i class="ni ni-bell-55 mr-2"></i>Citas pendientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 " data-toggle="tab" 
                            href="#historial" role="tab" aria-selected="false">
                            <i class="ni ni-folder-17 mr-2 "></i>Historial</a> 
                        </li>
                    </ul>
                </div>
                    
            </div>
            <div class="card shadow">
                <div class="card">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="mis-citas" role="tabpanel">
                            @include('ReservarCitas.confirmed-cita')
                        </div>
                        <div class="tab-pane fade" id="citas-pendientes" role="tabpanel">
                            @include('ReservarCitas.pending-cita')
                        </div>
                        <div class="tab-pane fade" id="historial" role="tabpanel" >
                            @include('ReservarCitas.old-cita')
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>


@endsection