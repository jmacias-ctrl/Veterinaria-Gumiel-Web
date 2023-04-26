@extends('layouts.layouts_users')
<title>Productos</title>
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
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="text-decoration:none;">Productos</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Productos</li>
            </ol>
        </nav>
    </div>
    <h1>Productos</h1>
    <hr>

    <div class="d-flex justify-content-between mb-3">
        <div class="col">
            <a class="btn btn-primary mr-auto" href="{{ route('productos.crear') }}" role="button">Ingresar
                Producto</a>
        </div>
    </div>
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
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Producto_enfocado</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Imagen_path</th>
                </tr>
            </thead>
            <tbody>
             
            @foreach ($productos as $productos_ven)
    <tr>
        <td>{{ $productos_ven->id }}</td>
        <td>{{ $productos_ven->nombre }}</td>
        <td>{{ $productos_ven->marca }}</td>
        <td>{{ $productos_ven->descripcion }}</td>
        <td>{{ $productos_ven->tipo }}</td>
        <td>{{ $productos_ven->stock }}</td>
        <td>{{ $productos_ven->producto_enfocado }}</td>
        <td>{{ $productos_ven->precio }}</td>
        <td>{{ $productos_ven->imagen_path }}</td>
        <td>
            <a href="{{ route('productos.edit', $productos_ven->id) }}" class="btn btn-primary"><span class="material-symbols-outlined">edit</span></a>
        </td>
        <td>
            <form action="{{ route('productos.delete', $productos_ven->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $productos_ven->id }}">
                <button type="submit" class="btn btn-danger"><span class="material-symbols-outlined">delete</span></button>
            </form>
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
                pageLength: 10,
            });
        });

        function deleted(id_get) {

            Swal.fire({
                title: '¿Eliminar usuario?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    axios.post("{{ route('admin.usuarios.delete') }}", {
                            id: id_get
                        })
                        .then(function(response) {

                            toastr.success('Usuario eliminada correctamente!')

                        })
                        .catch(function(error) {
                            toastr.error('La acción no se pudo realizar')
                        })
                        .finally(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuario eliminado correctamente!',
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
