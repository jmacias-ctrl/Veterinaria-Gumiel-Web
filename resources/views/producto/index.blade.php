@extends('layouts.layouts_users')
<title>Gestion Productos - Veterinaria Gumiel</title>
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
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="text-decoration:none;">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h4>Gestion de Productos</h4>
        </div>

        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary mr-auto" href="{{ route('admin.marcaproductos.index') }}" role="button" style="background-color:#19A448; border-color:#19A448;">Marca de 
                Productos</a>
        </div>
        @can('ingresar productos')
        <div class="col-lg-2 col-md-2 col-sm-2">
            <a class="btn btn-primary mr-auto" href="{{ route('productos.crear') }}" role="button" style="background-color:#19A448; border-color:#19A448;">Ingresar
                Producto</a>
        </div>
        @endcan
    </div>
    <hr>
    @if (session()->get('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table
            class="datatable display responsive nowrap table table-sm table-bordered table-hover table-striped w-100 shadow-sm"
            id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Producto enfocado</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
             
            @foreach ($productos as $productos_ven)
    <tr>
        <td>{{ $productos_ven->id }}</td>
        <td>{{ $productos_ven->nombre }}</td>
        <td>{{ $productos_ven->MarcaProductos->nombre }}</td>
        <td>{{ $productos_ven->tipo }}</td>
        <td>{{ $productos_ven->stock }}</td>
        <td>{{ $productos_ven->producto_enfocado }}</td>
        <td>${{ $productos_ven->precio }}</td>
        <td>
            @can('modificar productos')<a href="{{ route('productos.edit', $productos_ven->id) }}" class="btn btn-primary"><span class="material-symbols-outlined">edit</span></a> @endcan
            @can('eliminar productos')<button type="input" class="btn btn-danger" onclick="deleted({{$productos_ven->id}})"><span class="material-symbols-outlined">delete</span></button> @endcan
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
                title: '¿Eliminar Producto?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('productos.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('Producto eliminado correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto eliminado correctamente!',
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
