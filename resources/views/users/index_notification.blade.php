@extends('layouts.layouts_users')
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
@section('content')
    {{-- Breadcrumb  --}}

    <div class="breadcrumb mb-1 mx-2 opacity-50">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="text-decoration:none;">Inicio</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Notificaciones</li>
            </ol>
        </nav>
    </div>
    <h1>Notificaciones</h1>
    @if (session()->get('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <hr>
    @if (sizeof(auth()->user()->notifications) > 0)
        @foreach (auth()->user()->notifications as $notification)
            @if (!isset($notification->read_at))
                <a href="" style="text-decoration: none; color:white;">
                    <div class="container-sm border border-dark rounded py-3 px-5 shadow" id="notificationDiv">

                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col-2"><img src="{{ asset('image/default-user-image.png') }}" style="width:100px"
                                    alt=""></div>
                            <div class="col">
                                <h5>{{ $notification->data['title'] }}</h5>
                                <p>{{ $notification->data['message'] }}
                                </p>
                            </div>
                            <div class="col">
                                <form action="">
                                    <input type="hiddedn" value="{{ $notification->id }}">
                                    <p><button type="button" class="btn btn-danger">Eliminar</button></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <div class="container border border-dark rounded py-3 px-5 shadow my-3 align-items-center"
                    id="notificationDiv" style="background:white;">

                    <div class="row justify-content-center align-items-center">
                        <div class="col"><img src="{{ asset('image/default-user-image.png') }}" style="width:100px"
                                alt=""></div>
                        <div class="col">
                            <h5>{{ $notification->data['title'] }}</h5>
                            <p>{{ $notification->data['message'] }}
                            </p>
                        </div>
                        <div class="col">
                            <form action="{{ route('users.notification.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $notification->id }}">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
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

@endsection
@section('js-after')
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
@endsection
