@extends('layouts.panel_usuario')
<title>Gestión citas - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
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
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Pacientes</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="card shadow">
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
                        <i class="ni ni-calendar-grid-58 mr-2"></i>Citas confirmadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0"  data-toggle="tab" 
                        href="#citas-pendientes" role="tab" aria-selected="false">
                        <i class="ni ni-bell-55 mr-2"></i>Citas por confirmar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 " data-toggle="tab" 
                        href="#historial" role="tab" aria-selected="false">
                        <i class="ni ni-folder-17 mr-2 "></i>Historial/Citas canceladas</a> 
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

@endsection