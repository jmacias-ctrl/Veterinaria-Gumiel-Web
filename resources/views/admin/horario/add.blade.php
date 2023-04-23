@extends('layouts.layouts_users')
@section('css-before')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="d-inline-flex">

        <a href="{{ route('admin.horario.index') }}" class="boton-atras"> 
        <span class="material-symbols-outlined" style="font-size:40px;">
            arrow_back
        </span> </a>
        <h2 class="mx-5">Nuevo Horario</h2>
    </div>

    <hr>
    <form action="{{ route('admin.horario.store') }}" method="POST">
        @csrf
        <div id="">
            <h5 class="mt-4">Informacion Funcionarios</h5>
            <div class="row justify-content-center align-items-center g-2">
                <label for="title" class="title">Selecciona Funcionario</label>
                <select class="form-select" name="title" for="title">
                <option  selected disabled>Seleciona un funcionario</option>
                @foreach ($users as $user)
                    <option type="text" id="title" name= "title" value="{{$user->name}}">{{$user->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <label for="id_usuario" class="form-label">Selecciona Funcionario</label>
                <select class="form-select" name="id_usuario" for="title">
                <option  selected disabled>Seleciona un funcionario</option>
                @foreach ($users as $user)
                    <option type="unsignedBigInteger" id="id_usuario" name= "id_usuario" value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
                </select>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="start" class="form-label">Inicio turno: </label>
                    <input type="dateTime-local" id="start"
                        name="start" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="end" class="form-label">Termino turno: </label>
                    <input type="dateTime-local" id="end"
                        name="end" required>
                </div>
            </div>
            <br>
            <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Turno">
        </div>
    </form>
@endsection

@section('js-after')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#btn-submit').on('click', function(e) {
                e.preventDefault();
                var form = $(this).parents(form);
                Swal.fire({
                    title: 'Agregar Nuevo turno',
                    text: "¿Estás seguro de que todos los datos estan correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, agregar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {

                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        })
    </script>
@endsection
