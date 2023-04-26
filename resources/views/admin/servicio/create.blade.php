@include('layouts.layouts_users')
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
        <h3>Ingresar Servicio</h3>
        <hr>
        <form action="{{ route('admin.servicio') }}" method="POST">
            @csrf
            <div id="RoleWindow">
                <h5 class="mt-4">Informacion del Servicio</h5>
                <div class="row mt-3">
                    <div class="col">
                        <label for="nombre" class="form-label">Nombre Servicio</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder=""
                            aria-label="Nombre" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="marca" class="form-label">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio"
                            placeholder="" required>
                    </div>
                </div>
                <hr class="mt-4">
                <h5 class="mt-4">Tipos de Servicio</h5>
                <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Seleccione una opcion</option>
                                <option value="consulta veterinario">Consulta Veterinario</option>
                                <option value="peluqueria">Peluqueria</option>
                              </select>
                        </div>
                </div>
                <hr>
                <div class="row mt-3">
                    
                </div>

                <input class="btn btn-primary" id="btn-submit" type="submit" value="Agregar Usuario">
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