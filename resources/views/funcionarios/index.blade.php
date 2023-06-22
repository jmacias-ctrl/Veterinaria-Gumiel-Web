@extends('layouts.panel_usuario')
<title>Gestion Funcionarios - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Gestion Funcionarios
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Funcionarios</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Funcionarios</h3>
                </div>
                <div class="col text-right">
                    <a href="{{url('/funcionarios/create')}}" class="btn btn-sm btn-primary" style="background-color:#19A448; border-color:#19A448;">Nuevo funcionario</a>
                </div>
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
                        <th scope="col">Tipo servicio asociado</th>
                        <th scope="col">Acciones</th>
                    </tr>       
                </thead> 
            <tbody>
                @foreach ($funcionarios as $funcionario )
                <tr>
                    <th scope="row">
                        {{ $funcionario->id }}
                    </th>
                    <td>{{ $funcionario->name }}</td>
                    <td>{{ $funcionario->email }}</td>
                    <td>{{ $funcionario->tiposervicio->nombre }}</td> 

                    <td>
                        <form action="{{ url('/funcionarios/'.$funcionario->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger"><span class="material-symbols-outlined">delete</span></button>
                            <a href="{{ url('/funcionarios/'.$funcionario->id.'/edit') }}" class="btn btn-sm btn-outline-warning"><span class="material-symbols-outlined">edit</span></a>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <div class="card-body">
            {{$funcionarios->links()}}
        </div>
    </div>
    <br>
@endsection