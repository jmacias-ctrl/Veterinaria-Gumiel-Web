@extends('layouts.panel_usuario')
<title>Modificar Tipo Medicamento - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('title')
    Modificar Tipo Medicamento - Veterinaria Gumiel
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('header-title')
    Modificación de Tipo Medicamento {{ $tipomedicamentos_vacunas->nombre }}
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('admin.tipomedicamentos_vacunas.index')}}" style="color:black;">Marcas Productos</a> </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Modificar Marcas</li>
    </nav>
@endsection
@section('back-arrow')
    <a href="{{ route('admin.tipomedicamentos_vacunas.index') }}"> <span class="material-symbols-outlined"
            style="font-size:40px; color:white;">
            arrow_back
        </span> </a>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <form action="{{route('admin.tipomedicamentos_vacunas.update')}}" method="POST">
                @csrf
                <div class="row mt-3">
                    <div class="col">
                        <input type="hidden"  name="id" value="{{$tipomedicamentos_vacunas->id}}">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" value="{{$tipomedicamentos_vacunas->nombre}}" id="nombre" checked>
                    </div>

                </div>
                <br>
                <div class="container">
                    <div class="row row-cols-auto">
                        <div class="col">
                            <input name="btn-submit" id="btn-submit" class="btn btn-primary" style="background-color:#19A448; border-color:#19A448;" type="submit" value="Modificar">
                        </div>
                    </div>
                </div>    
                </form>
            </div>
        </div>
    </div>
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
                    title: 'Modificar Tipo Medicamento',
                    text: "¿Estás seguro de que todos los datos están correctos?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, modificar',
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