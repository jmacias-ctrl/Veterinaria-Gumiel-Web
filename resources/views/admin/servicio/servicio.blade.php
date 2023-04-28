@extends('layouts.layouts_users')
<title>Gestion Servicio - Veterinaria Gumiel</title>
@section('css-before')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('content')
    {{-- Breadcrumb  --}}

    <div class="breadcrumb mb-1 mx-2 opacity-50">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">@if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('admin') }}">
                    @elseif(auth()->user()->hasRole('Veterinario'))
                        <a href="{{ route('veterinario') }}">
                        @elseif (auth()->user()->hasRole('Peluquero'))
                            <a href="{{ route('peluquero') }}">
                            @elseif (auth()->user()->hasRole('Inventario'))
                                <a href="{{ route('inventario') }}">
                @endif
                Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Servicios</li>
            </ol>
        </nav>
    </div>
    
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <h4>Servicio</h4>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary ms-5" href="{{ route('admin.tiposervicios.index') }}"
                style="background-color:#2E7646; border-color:#2E7646;" role="button">Tipo Servicios</a>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary ms-5" href="{{ route('admin.servicio.create') }}" style="background-color:#19A448; border-color:#19A448;" role="button">Agregar Servicio
                </a>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table
            class="datatable display responsive nowrap table-sm table table-hover table-striped table-bordered w-100 shadow-sm"
            id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id }}</td>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{$servicio->tiposervicios->nombre}}</td>   
                        <td>{{ $servicio->precio }}</td>
                        <td><button type="button" class="btn btn-danger" onclick="deleted({{ $servicio->id }})"><span
                                    class="material-symbols-outlined">delete</span></button>
                            <a id="editServicios" style="background-color:#F7C044; border-color:#F7C044;" class="btn btn-primary"
                                href="{{ route('admin.servicio.edit', ['id' => "$servicio->id"]) }}"
                                role="button"><span class="material-symbols-outlined">edit</span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection

@section('js-after')
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script>
        $(document).ready(function() {
            var table = $("#table").DataTable({
                responsive: true,
                processing: true,
                searching: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                },
                pageLength: 10,
            });
        });
        function deleted(id_get) {
            Swal.fire({
                title: '¿Eliminar servicios?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.servicio.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('Insumo medico eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Insumo medico eliminado correctamente!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(() => {
                                location.reload();
                            }, 1500);

                        });
                    }
                    });

                    }
                    </script>
                    @endsection

        
    
