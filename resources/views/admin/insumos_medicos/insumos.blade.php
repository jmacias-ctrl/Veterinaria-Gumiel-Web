@extends('layouts.app')
<title>Gestion Insumos médicos</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-5">
                <h4>Gestion de Insumos Medicos</h4>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-5">
                <a class="btn btn-primary ms-5" href="{{ route('admin.insumos_medicos.create') }}" role="button">Agregar insumo</a>  
            </div>
        </div>
        <br>
        <div class="row table-responsive">
            <table class="datatable display responsive nowrap table-sm table table-hover table-striped table-bordered w-100 shadow-sm" id="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insumos_medicos as $insumos)
                    <tr>
                        <th>{{ $insumos->id }}</th>
                        <th>{{ $insumos->nombre }}</th>
                        <th>{{ $insumos->marca }}</th>
                        <th>
                        @foreach ($insumos->tipo as $Tipoinsumos)
                            {{ $Tipoinsumos }}
                            <br>
                        @endforeach
                        </th>
                        <th>@{{ $insumos->stock }}</th>
                        <th>
                            <button type="button" class="btn btn-danger"
                                                onclick="deleted({{ $insumos->id }})"><span
                                                    class="material-symbols-outlined">delete</span></button>
                                                    <a id="editInsumos" class="btn btn-primary"
                                                href="{{ route('admin.insumos_medicos.tipoinsumos', ['id' => "$insumos->id"]) }}"
                                                role="button"><span
                                                    class="material-symbols-outlined">manage_accounts</span></a>
                                            
                        </th>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
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
                title: '¿Eliminar Insumo medico?',
                text: "¿Estás seguro? no podrás revertir la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'Cancelar'

        }
    </script>
@endsection

