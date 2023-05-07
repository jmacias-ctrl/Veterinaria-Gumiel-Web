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
                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('admin') }}" style="color:black;">
                    @elseif(auth()->user()->hasRole('Veterinario'))
                        <a href="{{ route('veterinario') }}">
                        @elseif (auth()->user()->hasRole('Peluquero'))
                            <a href="{{ route('peluquero') }}">
                            @elseif (auth()->user()->hasRole('Inventario'))
                                <a href="{{ route('inventario') }}">
                @endif
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
                @if (sizeof(auth()->user()->notifications) > 0)
                    @foreach (auth()->user()->notifications as $notification)
                        @if (!isset($notification->read_at))
                            <a href="{{ $notification->data['route'] }}" style="text-decoration:none; color:black;">
                                <div class="container border border-dark rounded py-3 px-5 shadow my-3 align-items-center"
                                    id="notificationDiv" style="color: white;">

                                    <div class="row justify-content-center align-items-center">
                                        <div class="col"><img src="{{ asset('image/default-user-image.png') }}"
                                                style="width:100px" alt=""></div>
                                        <div class="col">
                                            <h5>{{ $notification->data['title'] }}</h5>
                                            <p>{{ $notification->data['message'] }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('users.notification.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                                <input class="btn btn-danger" type="submit" value="Eliminar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="{{ $notification->data['route'] }}" style="text-decoration:none; color:black;">
                                <div class="container border border-dark rounded py-3 px-5 shadow my-3 align-items-center"
                                    id="notificationDiv" style="background:white;">

                                    <div class="row justify-content-center align-items-center">
                                        <div class="col"><img src="{{ asset('image/default-user-image.png') }}"
                                                style="width:100px" alt=""></div>
                                        <div class="col">
                                            <h5>{{ $notification->data['title'] }}</h5>
                                            <p>{{ $notification->data['message'] }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <form action="{{ route('users.notification.delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                                <input class="btn btn-danger" type="submit" value="Eliminar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @php
                        auth()
                            ->user()
                            ->unreadNotifications->markAsRead();
                    @endphp
                @else
                    <h5 class="opacity-75">No tienes notificaciones</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js-after')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection
