@extends('layouts.panel_usuario')
<title>Gestion Pacientes - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Gestion Pacientes
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
    {{-- Breadcrumb  --}}
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Pacientes</h3>
                </div>
                @can('ingresar usuarios')
                <div class="col text-right">
                    <a href="{{url('/pacientes/create')}}" class="btn btn-sm btn-primary" style="background-color:#19A448; border-color:#19A448;">Nuevo paciente</a>
                </div>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>       
                </thead> 
            <tbody>
                @foreach ($pacientes as $paciente )
                <tr>
                    <th scope="row">{{ $paciente->id }}</th>
                    <td>{{ $paciente->name }}</td>
                    <td>{{ $paciente->email }}</td>
                    <td>
                        <form action="{{ url('/pacientes/'.$paciente->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            @can('eliminar usuarios')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><span class="material-symbols-outlined">delete</span></button>    
                            @endcan
                            @can('modificar usuarios')
                            <a href="{{ url('/pacientes/'.$paciente->id.'/edit') }}" class="btn btn-sm btn-outline-warning"><span class="material-symbols-outlined">edit</span></a>
                            @endcan

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $pacientes->links() }}
        </div>
    </div>

@endsection