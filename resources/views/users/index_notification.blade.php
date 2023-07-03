@extends('layouts.panel_usuario')
<title>Notificaciones - {{ auth()->user()->name }}</title>
@section('css-before')
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        #notificationDiv {
            background: #2e7646;
        }

        @media screen and (min-width: 1000px) {
            #notificationDiv {
                width: 55%;
            }
        }
    </style>
@endsection
@section('js-before')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection
@section('header-title')
    Notificaciones del {{ Auth::user()->name }}
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('inicio_panel') }}" style="color:black;">
                    Inicio</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color:white;">Notificaciones</li>
    </nav>
@endsection
@section('content')
    {{-- Breadcrumb  --}}
    <div class="row">
        <div class="col">
            <div class="card shadow p-4">
                <h2>Notificaciones</h2>
                <div class="table-responsive">
                    <table class="table table-bordered dt-responsive nowrap" style="width:100%;"
                        id="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Notificacion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @if (sizeof(auth()->user()->notifications) > 0)
                                @foreach (auth()->user()->notifications as $notification)
                                    @if (!isset($notification->read_at))
                                        <tr>
                                            <td>
                                                {{$i}}
                                            </td>
                                            <td><a @if (isset($notification->data['route'])) href="{{ $notification->data['route'] }}" @endif
                                                    style="text-decoration:none; color:green;">
                                                    <p>
                                                        {{ $notification->data['message'] }}
                                                    </p>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('users.notification.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $notification->id }}">
                                                    <input class="btn btn-danger" type="submit" value="Eliminar">
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                {{$i}}
                                            </td>
                                            <td>
                                                <a @if (isset($notification->data['route'])) href="{{ $notification->data['route'] }}" @endif
                                                    style="text-decoration:none; color:black;">
                                                    <p>{{ $notification->data['message'] }}
                                                    </p>

                                                </a>
                                            </td>

                                            <td>
                                                <form action="{{ route('users.notification.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $notification->id }}">
                                                    <input class="btn btn-danger" type="submit" value="Eliminar">
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        $i = $i+1;
                                    @endphp
                                @endforeach
                                @php
                                    auth()
                                        ->user()
                                        ->unreadNotifications->markAsRead();
                                @endphp
                            @endif
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js-after')
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection
