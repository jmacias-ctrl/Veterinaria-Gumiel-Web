<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    <!-- Favicon -->
    @yield('css-before')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script type="text/javascript">
        var baseURL = {!! json_encode(url('/')) !!}
    </script>

    @yield('css-after')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(87deg, #2E7646 0, #19A448 100%) !important;
        }

        .active {
            color: #2E7646;
        }
    </style>
</head>
@php
    $userNotification = sizeof(Auth::user()->unreadNotifications);
@endphp

<body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="pt-0 m-3" href="{{ route('inicio') }}">
                <img src="{{ asset('image/logo2.jpg') }}" style="width:170px">
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                        aria-labelledby="navbar-default_dropdown_1">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if (isset(Auth::user()->image))
                                    <img alt="Image placeholder"
                                        src="{{ asset('storage') . '/' . Auth::user()->image }}}">
                                @else
                                    <img alt="Image placeholder" src="{{ asset('image/default-user-image.png') }}">
                                @endif

                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">¡Bienvenido!</h6>
                        </div>
                        <a href="{{ route('user.profile.index') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Mi Perfil</span>
                        </a>
                        <a href="{{ route('user.profile.modify') }}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Configuracion</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Actividad</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-support-16"></i>
                            <span>Soporte</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            id="logout" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Cerrar Sesion</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main"
                                aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended"
                            placeholder="Search" aria-label="Search">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        @if (auth()->user()->hasRole('Admin'))
                            <a class="nav-link @if (Route::current()->getName() == 'admin') active @endif"
                                href="{{ route('admin') }}">
                            @elseif(auth()->user()->hasRole('Veterinario'))
                                <a class="nav-link  @if (Route::current()->getName() == 'veterinario') active @endif "
                                    href="{{ route('veterinario') }}">
                                @elseif (auth()->user()->hasRole('Peluquero'))
                                    <a class="nav-link  @if (Route::current()->getName() == 'peluquero') active @endif "
                                        href="{{ route('peluquero') }}">
                                    @elseif (auth()->user()->hasRole('Inventario'))
                                        <a class="nav-link @if (Route::current()->getName() == 'inventario') active @endif"
                                            href="{{ route('inventario') }}">
                        @endif
                        <i class="ni ni-tv-2 text-green"></i> Dashboard
                        </a>
                    </li>
                    @hasrole('Admin')
                        @if (Route::currentRouteName() == 'admin.usuarios.index')
                            <li class="nav-item  active">
                            @else
                            <li class="nav-item">
                        @endif
                        <a class="nav-link collapse-links" data-toggle="collapse" href="#usuarioCollapse" role="button"
                            aria-expanded="false" aria-controls="usuarioCollapse">
                            <i class="ni ni-circle-08 text-green"></i> Gestion Usuarios
                        </a>
                        <div class="collapse" id="usuarioCollapse">
                            <div class="card card-body" id="dropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('admin.usuarios.*')) active @endif"
                                            href="{{ route('admin.usuarios.index') }}" id="link-dropdown">Usuarios</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3" @if (request()->routeIs('admin.roles.*')) active @endif
                                            href="{{ route('admin.roles.index') }}" id="link-dropdown">Roles</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('admin.horario.*')) active @endif"
                                            href="{{ url('funcionarios') }}" id="link-dropdown">Funcionario</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('admin.horario.*')) active @endif"
                                            href="{{ route('admin.horario.index') }}" id="link-dropdown">Horarios</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </li>
                    @endhasrole
                    @can('ver servicios')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('admin.servicio.*')) active @endif"
                                href="{{ route('admin.servicio') }}">
                                <i class="ni ni-atom text-green "></i> Servicios
                            </a>
                        </li>
                    @endcan
                    @can('ver citasvet')
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('/agendar-horas/create')) active @endif"
                                href="{{ route('agendar-horas.create') }}">
                                <i class="ni ni-atom text-green "></i> Reservar cita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request()->routeIs('/miscitas')) active @endif"
                                href="{{ route('Agendar') }}">
                                <i class="ni ni-atom text-green "></i> Mis citas
                            </a>
                        </li>
                    @endcan
                    @can('ver productos')
                        <li class="nav-item">
                            <a class="nav-link collapse-links" data-toggle="collapse" href="#productosCollapse"
                                role="button" aria-expanded="false" aria-controls="productosCollapse">
                                <i class="ni ni-box-2 text-green"></i> Gestion Productos
                            </a>
                            <div class="collapse" id="productosCollapse">
                                <div class="card card-body" id="dropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('productos.*')) active @endif"
                                                href="{{ route('productos.index') }}" id="link-dropdown">Productos</a>
                                        </li>
                                    </ul>

                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.insumos_medicos.*')) active @endif"
                                                href="{{ route('admin.insumos_medicos.index') }}"
                                                id="link-dropdown">Insumos Medicos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.medicamentos_vacunas.*')) active @endif"
                                                href="{{ route('admin.medicamentos_vacunas.index') }}"
                                                id="link-dropdown">Medicamentos</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endcan
                    @hasrole('Admin')
                        <li class="nav-item">
                            <a class="nav-link collapse-links" data-toggle="collapse" href="#mantenedoresCollapse"
                                role="button" aria-expanded="false" aria-controls="mantenedoresCollapse">
                                <i class="ni ni-settings text-green"></i> Mantenedores
                            </a>
                            <div class="collapse" id="mantenedoresCollapse">
                                <div class="card card-body" id="dropdown">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.marcaproductos.*')) active @endif"
                                                href="{{ route('admin.marcaproductos.index') }}"
                                                id="link-dropdown">Marcas Productos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tipoproductos_ventas.*')) active @endif"
                                                href="{{ route('admin.tipoproductos_ventas.index') }}"
                                                id="link-dropdown">Tipo Productos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tiposervicios.*')) active @endif"
                                                href="{{ route('admin.tiposervicios.index') }}" id="link-dropdown">Tipos
                                                Servicios</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.marcaInsumos.*')) active @endif"
                                                href="{{ route('admin.marcaInsumos.index') }}" id="link-dropdown">Marcas
                                                Insumos Medicos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tipoinsumos.*')) active @endif"
                                                href="{{ route('admin.tipoinsumos.index') }}" id="link-dropdown">Tipos
                                                Insumos Medicos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tipomedicamentos_vacunas.*')) active @endif"
                                                href="{{ route('admin.tipomedicamentos_vacunas.index') }}"
                                                id="link-dropdown">Tipos
                                                Medicamentos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.marcamedicamentos_vacunas.*')) active @endif"
                                                href="{{ route('admin.marcamedicamentos_vacunas.index') }}"
                                                id="link-dropdown">Marca
                                                Medicamentos</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.especies.*')) active @endif"
                                                href="{{ route('admin.especies.index') }}"
                                                id="link-dropdown">Especies</a>
                                        </li>
                                    </ul>
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 " href="#" id="link-dropdown">Landing Page</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    @endhasrole
                    @hasrole('Inventario')
                        <li class="nav-item active">
                            <a class="nav-link @if (request()->routeIs('point_sale.*')) active @endif"
                                href="{{ route('point_sale.index') }}">
                                <i class="ni ni-cart text-green"></i> Punto de Venta
                            </a>
                        </li>
                    @endhasrole
                    @can('acceso administracion de stock')
                        <li class="nav-item active">
                            <a class="nav-link @if (request()->routeIs('administracion_inventario.*')) active @endif"
                                href="{{ route('administracion_inventario.index') }}">
                                <i class="ni ni-bullet-list-67 text-green"></i> Administracion de Inventario
                            </a>
                        </li>
                    @endcan
                    @can('ver gestionvet')
                        <li class="nav-item active">
                            <a class="nav-link  @if (request()->routeIs('admin.horariofuncionarios.*')) active @endif"
                                href="{{ route('admin.horariofuncionarios.edit') }}">
                                <i class="ni ni-calendar-grid-58 text-green"></i> Horario Funcionarios</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link  @if (request()->routeIs('pacientes.*')) active @endif"
                                href="{{ route('pacientes.index') }}">
                                <i class="ni ni-archive-2 text-green "></i>Mis Pacientes</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link  @if (request()->routeIs('miscitas.*')) active @endif" href="">
                                <i class="	fas fa-calendar-check text-green "></i>Mis Citas</a>
                        </li>
                    @endcan
                </ul>
                <!-- Divider -->
                <hr class="my-3">
            </div>
        </div>
    </nav>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->

                @yield('back-arrow')
                <div class="row">

                    <a class="h3 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ url()->full() }}">
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="font-weight-bold" text-center> @yield('header-title')</p>
                            @yield('breadcrumbs')
                        </div>
                    </a>
                </div>

                <!-- Form -->
                <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" placeholder="Buscar" type="text" id="myInput"
                                aria-controls="table">

                        </div>
                    </div>
                </form>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ni ni-bell-55"></i>
                        <span class="badge badge-danger">
                            @if ($userNotification < 99)
                                {{ $userNotification }}
                            @else
                                99+
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                        aria-labelledby="navbar-default_dropdown_1">
                        @for ($i = 0; $i < sizeof(auth()->user()->notifications); $i++)
                            @if ($i == 3)
                            @break
                        @endif
                        <a class="dropdown-item"
                            href="{{ route('users.notification.index') }}">{{ auth()->user()->notifications[$i]->data['title'] }}</a>
                    @endfor

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('users.notification.index') }}">Ver todas las
                        notificaciones</a>
                </div>
            </li>
            <!-- User -->
            <ul class="navbar-nav align-items-center d-none d-md-flex">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                @if (isset(Auth::user()->image))
                                    <img alt="Image placeholder"
                                        src="{{ asset('storage') . '/' . Auth::user()->image }}">
                                @else
                                    <img alt="Image placeholder"
                                        src="{{ asset('image/default-user-image.png') }}">
                                @endif
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">¡Bienvenido!</h6>
                        </div>
                        <a href="{{ route('user.profile.index') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Mi Perfil</span>
                        </a>
                        <a href="{{ route('user.profile.modify') }}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Configuracion</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Actividad</span>
                        </a>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-support-16"></i>
                            <span>Soporte</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            id="logout" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Cerrar Sesion</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </li>
        </div>
        <script src="{{ asset('js/horarios.js') }}" defer></script>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                                        <span class="h2 font-weight-bold mb-0">350,897</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                        <span class="h2 font-weight-bold mb-0">2,356</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last week</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                                        <span class="h2 font-weight-bold mb-0">924</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                        <span class="h2 font-weight-bold mb-0">49,65%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/horarios.js') }}" defer></script>
    </div>
    </nav>
    <div class="container-fluid mt--7">
        @yield('content')
        <!-- Footer -->
    </div>
</div>
@yield('js-before')
<!--   Core   -->
<script src="{{ asset('js/plugins/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--   Optional JS   -->
<script src="{{ asset('js/plugins/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
<!--   Argon JS   -->
<script src="{{ asset('js/argon-dashboard.min.js?v=1.1.2') }}"></script>
<script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options.positionClass = 'toast-bottom-right';
</script>
@if ($userNotification == 1)
    <script>
        toastr.warning('Tienes una notificacion sin leer');
    </script>
@elseif ($userNotification < 99 && $userNotification > 1)
    <script>
        toastr.warning('Tienes {{ $userNotification }} notificaciones sin leer');
    </script>
@elseif($userNotification > 99)
    <script>
        toastr.warning('Tienes 99+ notificaciones sin leer');
    </script>
@endif
<script>
    window.TrackJS &&
        TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
        });
</script>
<script>
    function checkForNewNotifications() {
        var notificationCount = {!! json_encode($userNotification, JSON_HEX_TAG) !!}
        setInterval(() => {
            axios({
                method: 'get',
                url: "{{ route('users.notification.updateNotificationCount') }}",
                params: {
                    lastNotificationCount: notificationCount,
                },
            }).then(res => {
                if (res.data.newNotifications == true) {
                    let difference = res.data.newCount - notificationCount;
                    if (difference == 1) {
                        toastr.warning('Tienes una notificacion nueva');
                    } else if (difference < 99 && difference > 1) {
                        toastr.warning('Tienes ' + difference + ' notificaciones nuevas');
                    } else if (difference > 99) {
                        toastr.warning('Tienes 99+ notificaciones nuevas');
                    }
                }
                $(`#notificationCount`).html(notificationCount);
                notificationCount = res.data.newCount;
            }).catch(err => {
                console.error(err);
            });
        }, 2500);
    }
</script>
@yield('js-after')
</body>

</html>
