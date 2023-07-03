<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    use App\Http\Controllers\LandingPageController;
    $userNotification = sizeof(Auth::user()->unreadNotifications);
    $logo = LandingPageController::getLogoPanel();
@endphp

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <!-- Favicon -->
    @yield('css-before')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    @if (isset($logo))
        <link href="{{ asset('storage') . '/images/logos/' . $data_index->logo_2 }}" rel="icon">
    @endif
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('css') . '/breadcrums.css' }}">
    <link rel="stylesheet" href="{{ asset('css') . '/uiFix.css' }}">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script type="text/javascript">
        var baseURL = {
            !!json_encode(url('/')) !!
        }
    </script>



    @yield('css-after')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(87deg, #2E7646 0, #19A448 100%) !important;
        }

        .active {
            color: #2E7646;
        }

        #headerMobile {
            display: none;
        }

        #logoPanel {
            width: 214px;
        }

        @media only screen and (max-width: 767px) {
            #desktopNotification {
                display: none;
            }

            #logoPanel {
                width: 140px;
            }
        }

        @media only screen and (max-width: 991px) {
            #headerMobile {
                display: inline;
            }
        }
    </style>
    @yield('styles')
</head>

<body id="mainContent">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="pt-0 m-0 align-self-center" href="{{ route('inicio') }}">
                @if (isset($logo))
                    <img src="{{ asset('storage') . '/images/logos/' . $data_index->logo_2 }}" id="logoPanel">
                @else
                    <img src="{{ asset('image/logo2.jpg') }}" id="logoPanel">
                @endif

            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
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
                        @if ($userNotification > 0)
                            @for ($i = 0; $i < sizeof(auth()->user()->notifications); $i++)
                                @if ($i == 4)
                                @break
                            @endif
                            <a class="dropdown-item"
                                href="{{ route('users.notification.index') }}">{{ auth()->user()->notifications[$i]->data['title'] }}</a>
                        @endfor
                    @else
                        <a class="dropdown-item" href="#">No tienes notificaciones</a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('users.notification.index') }}">Ver todas las
                        notificaciones</a>
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
                        <span>Configuración</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        id="logout" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Cerrar Sesión</span>
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
                    <a class="nav-link @if (Route::current()->getName() == 'inicio_panel') active @endif"
                        href="{{ route('inicio_panel') }}"> Inicio
                    </a>
                </li>
                @canany([
                    'acceso ventas',
                    'acceso punto de venta',
                    'acceso administracion de stock',
                    'ver gestionvet',
                    'ver gestionpeluqueria',
                    'ver citas',
                    ])

                    <li class="nav-item  @if (Route::currentRouteName() == 'trazabilidad-ventas-y-servicios' || Route::currentRouteName() == 'dashboard-citas') active @endif" >
                    
                    <a class="nav-link
                        collapse-links @if (Route::current()->getName() == 'admin') active @endif" data-toggle="collapse"
                        href="#dashboardCollapse" role="button" aria-expanded="false"
                        aria-controls="dashboardCollapse">
                        <i class="ni ni-tv-2 text-green"></i> Dashboard
                        </a>

                        <div class="collapse" id="dashboardCollapse">
                            <div class="card card-body" id="dropdown">
                                @canany(['acceso ventas', 'acceso punto de venta', 'acceso administracion de stock'])
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3"
                                                href="{{ route('trazabilidad-ventas-y-servicios') }}"
                                                id="link-dropdown">Dashboard Ventas y Servicios</a>
                                        </li>
                                    </ul>
                                @endcanany
                                @canany(['ver gestionvet', 'ver gestionpeluqueria', 'ver citas'])
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3" href="{{ route('dashboard-citas') }}"
                                                id="link-dropdown">Dashboard Citas</a>
                                        </li>
                                    </ul>
                                @endcanany


                            </div>
                        </div>
                    </li>
                @endcanany
                @can('ver usuario')
                    @if (Route::currentRouteName() == 'admin.usuarios.index')
                        <li class="nav-item  active">
                        @else
                        <li class="nav-item">
                    @endif
                    <a class="nav-link collapse-links" data-toggle="collapse" href="#usuarioCollapse" role="button"
                        aria-expanded="false" aria-controls="usuarioCollapse">
                        <i class="ni ni-circle-08 text-green"></i> Gestión Usuarios
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
                        </div>
                    </div>
                    </li>
                @endcan
                @can('ver servicios')
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('admin.servicio.*')) active @endif"
                            href="{{ route('admin.servicio') }}">
                            <i class="ni ni-atom text-green "></i> Servicios
                        </a>
                    </li>
                @endcan
                @can('ver proveedores')
                    <li class="nav-item">
                        <a class="nav-link @if (request()->routeIs('proveedores.*')) active @endif"
                            href="{{ route('proveedores.index') }}">
                            <i class="ni ni-delivery-fast text-green "></i> Proveedores
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
                            <i class="ni ni-box-2 text-green"></i> Gestión Productos
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
                                            id="link-dropdown">Insumos Médicos</a>
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
                @canany([
                    'ver productos',
                    'ver servicios',
                    'ver insumos medicos',
                    'ver medicamentos',
                    'ver
                    especies',
                    ])
                    <li class="nav-item">
                        <a class="nav-link collapse-links" data-toggle="collapse" href="#mantenedoresCollapse"
                            role="button" aria-expanded="false" aria-controls="mantenedoresCollapse">
                            <i class="ni ni-settings text-green"></i> Mantenedores
                        </a>
                        <div class="collapse" id="mantenedoresCollapse">
                            <div class="card card-body" id="dropdown">
                                @can('ver productos')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.marcaproductos.*')) active @endif"
                                                href="{{ route('admin.marcaproductos.index') }}"
                                                id="link-dropdown">Marcas Productos</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver productos')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tipoproductos_ventas.*')) active @endif"
                                                href="{{ route('admin.tipoproductos_ventas.index') }}"
                                                id="link-dropdown">Tipo Productos</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver servicios')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tiposervicios.*')) active @endif"
                                                href="{{ route('admin.tiposervicios.index') }}" id="link-dropdown">Tipos
                                                Servicios</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver insumos medicos')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.marcaInsumos.*')) active @endif"
                                                href="{{ route('admin.marcaInsumos.index') }}" id="link-dropdown">Marcas
                                                Insumos Médicos</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver insumos medicos')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tipoinsumos.*')) active @endif"
                                                href="{{ route('admin.tipoinsumos.index') }}" id="link-dropdown">Tipos
                                                Insumos Médicos</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver medicamentos')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.tipomedicamentos_vacunas.*')) active @endif"
                                                href="{{ route('admin.tipomedicamentos_vacunas.index') }}"
                                                id="link-dropdown">Tipos
                                                Medicamentos</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver medicamentos')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.marcamedicamentos_vacunas.*')) active @endif"
                                                href="{{ route('admin.marcamedicamentos_vacunas.index') }}"
                                                id="link-dropdown">Marca
                                                Medicamentos</a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('ver especies')
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link ms-3 @if (request()->routeIs('admin.especies.*')) active @endif"
                                                href="{{ route('admin.especies.index') }}"
                                                id="link-dropdown">Especies</a>
                                        </li>
                                    </ul>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endcanany
                @can('acceso punto de venta')
                    <li class="nav-item active">
                        <a class="nav-link @if (request()->routeIs('point_sale.*')) active @endif"
                            href="{{ route('point_sale.index') }}">
                            <i class="ni ni-cart text-green"></i> Punto de Venta
                        </a>
                    </li>
                @endcan
                @can('acceso punto de venta')
                    <li class="nav-item active">
                        <a class="nav-link @if (request()->routeIs('control-servicios.*')) active @endif"
                            href="{{ route('control_servicios.index') }}">
                            <i class="ni ni-cart text-green"></i>Punto de Reserva/Pago Servicios
                        </a>
                    </li>
                @endcan
                @can('acceso ventas')
                    <li class="nav-item active">
                        <a class="nav-link @if (request()->routeIs('ventas.*')) active @endif"
                            href="{{ route('ventas.index') }}">
                            <i class="ni ni-money-coins text-green"></i> Historial de Ventas
                        </a>
                    </li>
                @endcan
                @can('acceso ventas')
                    <li class="nav-item active">
                        <a class="nav-link @if (request()->routeIs('pedidos_online.*')) active @endif"
                            href="{{ route('pedidos_online.index') }}">
                            <i class="ni ni-single-copy-04 text-green"></i> Pedidos Online
                        </a>
                    </li>
                @endcan
                @can('acceso administracion de stock')
                    <li class="nav-item active">
                        <a class="nav-link @if (request()->routeIs('administracion_inventario.*')) active @endif"
                            href="{{ route('administracion_inventario.index') }}">
                            <i class="ni ni-bullet-list-67 text-green"></i> Administración de Inventario
                        </a>
                    </li>
                @endcan
                @can('ver gestionvet')
                    <li class="nav-item active">
                        <a class="nav-link  @if (request()->routeIs('admin.horariofuncionarios.*')) active @endif"
                            href="{{ route('admin.horariofuncionarios.edit') }}">
                            <i class="ni ni-calendar-grid-58 text-green"></i> Mi Horario</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link  @if (request()->routeIs('pacientes.*')) active @endif"
                            href="{{ route('pacientes.index') }}">
                            <i class="ni ni-archive-2 text-green "></i>Mis Pacientes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link  @if (request()->routeIs('miscitas.*')) active @endif" href="/miscitas">
                            <i class="	fas fa-calendar-check text-green "></i>Mis Citas</a>
                    </li>
                @endcan
                @can('modificar landing page')
                    <li class="nav-item">
                        <a class="nav-link collapse-links" data-toggle="collapse" href="#configWebCollapse"
                            role="button" aria-expanded="false" aria-controls="configWebCollapse">
                            <i class="ni ni-world text-green"></i> Config. Sitio Web
                        </a>
                        <div class="collapse" id="configWebCollapse">
                            <div class="card card-body" id="dropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('landing.ubication.*')) active @endif"
                                            href="{{ route('landing.ubication.edit') }}"
                                            id="link-dropdown">Información General</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('landing.nosotros.*')) active @endif"
                                            href="{{ route('landing.nosotros.edit') }}" id="link-dropdown">Seccion
                                            Nosotros</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('landing.website.*')) active @endif"
                                            href="{{ route('landing.website.edit') }}" id="link-dropdown">Landing
                                            Page</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link ms-3 @if (request()->routeIs('landing.horario.*')) active @endif"
                                            href="{{ route('landing.horario.edit') }}" id="link-dropdown">Horario Landing Page</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
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


            <div class="row">
                <div class="d-flex align-items-center">
                    @yield('back-arrow')
                    <a class="h3 ml-2 mt-3 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                        href="{{ url()->full() }}">
                        <p class="font-weight-bold" text-center> @yield('header-title')</p>
                    </a>
                </div>

            </div>

            <!-- Form -->
            <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                <div class="form-group mb-0 mt-3">
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
                    aria-haspopup="true" aria-expanded="false" style="color:black;" id="desktopNotification">
                    <i class="ni ni-bell-55 text-white"></i>
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
                    @if ($userNotification > 0)
                        @for ($i = 0; $i < sizeof(auth()->user()->notifications); $i++)
                            @if ($i == 4)
                            @break
                        @endif
                        <a class="dropdown-item"
                            href="{{ route('users.notification.index') }}">{{ auth()->user()->notifications[$i]->data['title'] }}</a>
                    @endfor
                @else
                    <a class="dropdown-item" href="#">No tienes notificaciones</a>
                @endif


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
                        <span>Configuración</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        id="logout" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Cerrar Sesión</span>
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
<div class="header bg-gradient-primary pb-7 pt-5 pt-md-8">
    <div class="container-fluid">
        @yield('breadcrumbs')
        <a class="h3 ml-5 mt-3 mb-0 text-white text-uppercase" href="{{ url()->full() }}" id="headerMobile">
            <p class="ml-3 font-weight-bold" text-center> @yield('header-title')</p>
        </a>
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
@yield('scripts')
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
        var notificationCount = {
            !!json_encode($userNotification, JSON_HEX_TAG) !!
        }
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
        }, 3500);
    }
</script>
@yield('js-after')
</body>

</html>
