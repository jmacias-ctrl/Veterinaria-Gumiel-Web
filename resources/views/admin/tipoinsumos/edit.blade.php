@extends('layouts.layouts_users')
<title>Modificar Tipo Insumo</title>
@section('css-before')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container-sm">
        <h2>Modificar Tipos de Insumos</h2>
        <hr>
        <form action="{{route('admin.tipoinsumos.update')}}" method="POST">
            @csrf
            <div class="row mt-3">
                <div class="col">
                    <input type="hidden"  name="id" value="{{$tipoinsumos->id}}">
                    <label for="nombre" class="form-label">Nombre Tipo de Insumo</label>
                    <input type="text" class="form-control" name="nombre" value="{{$tipoinsumos->nombre}}" id="nombre" checked>
                </div>

            </div>
            <br>
            <div class="container">
                <div class="row row-cols-auto">
                    <div class="col">
                        <input name="btn-submit" id="btn-submit" class="btn btn-primary" style="background-color:#19A448; border-color:#19A448;" type="submit" value="Modificar">
                    </div>
                    <div class="col">
                        <a class="btn btn-primary ms-5" href="{{ route('admin.tipoinsumos.index') }}" style="background-color:#6A6767; border-color:#6A6767;" role="button">Cancelar</a>
                    </div>
                </div>
            </div>    
        </form>
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
                    title: 'Modificar Tipo Insumo',
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