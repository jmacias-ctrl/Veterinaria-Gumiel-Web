@extends('layouts.panel_usuario')
<title>
    Inicio - Veterinaria Gumiel</title>
@section('css-before')
    <style>
        .imageProfile {
            width: 120px;
        }

        .circle {
            border-radius: 100%;
            height: 200px;
            width: 200px;
            object-fit: cover;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
@endsection
@section('content')

    <body>
        <div class="row">
            <div class="col">
                <div class="card shadow p-4">
                    <div class="card-header border-0 p-0 mb-4">
                        <h2 class="text-center">Trabajadores Disponible Hoy</h2>
                    </div>
                    @if (sizeof($horario) > 0)
                        <table id="table" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Turno Mañana</th>
                                    <th>Turno Tarde</th>
                                    <th>Estado</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($horario as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            @if (isset($item->image))
                                                <img src="{{ asset('storage') . '/' . $item->image }}" alt=""
                                                    class="imageProfile">
                                            @else
                                                <img src="{{ asset('image/default-user-image.png') }}" alt=""
                                                    class="imageProfile m-3">
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>{{ $item->morning_start }} - {{ $item->morning_end }}</td>
                                        <td>{{ $item->afternoon_start }} - {{ $item->afternoon_end }}</td>
                                        <td>
                                            @if (Cache::has('user-is-online-' . $item->id))
                                                <span class="badge text-bg-success">Conectado</span>
                                            @else
                                                <span class="badge text-bg-secondary">Desconectado</span>
                                            @endif
                                        </td>
                                        <td><a name="" id="" class="btn btn-primary" href="#"
                                                role="button">Ver Perfil</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4>No hay trabajadores disponibles hoy</h4>
                    @endif

                </div>
            </div>
    </body>

    </html>
@endsection
@section('js-after')
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                scrollY: '200px',
                scrollCollapse: true,
                responsive: true,
                paging: false,
                "ordering": false,
                "info": false,
                "dom": 'rtip'
            });
        });
    </script>
@endsection
