@extends('layouts.panel_usuario')
<title>Horarios - Administrador</title>
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('header-title')
    Horario Funcionarios
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
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Horarios</li>
    </nav>
@endsection

@section('content')
    {{-- Breadcrumb  --}}

    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <div class="card-header border-0">
                    <class class="row">
                        <div class="class-sm-10">

                        </div>
                        <div class="col-sm-2">
                            <a href="{{route('admin.horario.add')}}" class="btn btn-primary btn-lg" tabindex="-1" style="background-color:#19A448; border-color:#19A448;"  role="button" aria-disabled="false">Agregar Horario</a>
                        </div>
                    </class>
                </div>
                <div class="container">
                <div id="horarios">

                </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos del horario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="" method="POST" class="was-validated">
            @csrf
            <div id="">
                <h5 class="mt-4">Informacion Funcionarios</h5>
                <div class="row mt-3">
                <div class="col">
                    <input type="hidden" id="id" name="id" required>
                </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="title" class="form-label">Titulo: </label>
                        <input class="form-control" required type="text" id="title" name="title" required>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <label for="id_usuario" class="form-label">Selecciona Funcionario</label>
                    <select class="form-select" required name="id_usuario" for="title">
                    <option  selected disabled>Seleciona un funcionario</option>
                    @foreach ($users as $user)
                        <option type="unsignedBigInteger" id="id_usuario" name= "id_usuario" value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="start" class="form-label">Inicio turno: </label>
                        <input class="form-control" type="dateTime-local" id="start"
                            name="start" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="end" class="form-label">Termino turno: </label>
                        <input class="form-control" type="dateTime-local" id="end"
                            name="end" required>
                    </div>
                </div>
                <br>
            </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
            <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

