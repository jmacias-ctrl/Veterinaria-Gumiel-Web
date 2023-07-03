<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    use App\Http\Controllers\LandingPageController;
    $landingMaps = LandingPageController::getLandingPageDetails();
    $logo = LandingPageController::getLogoLandingPage();
@endphp


<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    @if (isset($logo))
        <link href="{{ asset('storage') . '/images/logos/' . $logo }}" rel="icon" />
    @endif
    @yield('css-before')

    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Quicksand:wght@600;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Libraries Stylesheet -->
    @if(Route::currentRouteName()=='agendar-horas.create')
    <link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
    @endif
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="fullCalendar4/packages/timegrid/main.css">
    <link rel="stylesheet" href="utils/css/jquery.timepicker.min.css">
    <script type="text/javascript" src="utils/js/jquery.datetimepicker.full.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/landingpage/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/landingpage/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <script type="text/javascript">
        var baseURL = {!! json_encode(url('/')) !!}
    </script>
    @yield('css')

    @yield('styles')
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div  id="c_fluid"class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-8 pl-5 pr-1 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>{{ $landingMaps->direccion }}</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>{{ $landingMaps->horario_header }}</small>
                </div>
            </div>
            <div class="col-lg-4 pr-5 pl-1 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+56{{ $landingMaps->telefono }}</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    @isset($landingMaps->whatsapp)
                        <a class="btn btn-sm-square bg-white text-primary me-1" href="{{ $landingMaps->whatsapp }}"
                            target="_blank"><i class="fab fa-whatsapp"></i></a>
                    @endisset
                    @isset($landingMaps->facebook)
                        <a class="btn btn-sm-square bg-white text-primary me-1" href="{{ $landingMaps->facebook }}"
                            target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endisset
                    @isset($landingMaps->instagram)
                        <a class="btn btn-sm-square bg-white text-primary me-0" href="{{ $landingMaps->instagram }}"
                            target="_blank"><i class="fab fa-instagram"></i></a>
                    @endisset
                    @isset($landingMaps->twitter)
                        <a class="btn btn-sm-square bg-white text-primary me-0" href="{{ $landingMaps->twitter }}"
                            target="_blank"><i class="fab fa-twitter"></i></a>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav id="head" class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-4 px-lg-5 wow fadeIn"
        data-wow-delay="0.1s" style="min-width:360px;">
        <a href="{{ route('inicio') }}" class="navbar-brand p-0">
            @if (isset($logo))
                <img class="img-fluid me-3" src="{{ asset('storage') . '/images/logos/' . $logo }}" alt="Icon" />
            @else
                <img class="img-fluid me-3" src="{{ asset('image/logo.png') }}" alt="Icon" />
            @endif

            <h1 class="m-0 text-primary">{{ $landingMaps->nombre }}</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse py-4 py-lg-0" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{ route('inicio') }}"
                    class="nav-item nav-link @if (request()->routeIs('inicio')) active @endif">Inicio</a>
                <a href="{{ route('nosotros') }}"
                    class="nav-item nav-link @if (request()->routeIs('nosotros')) active @endif">Nosotros</a>
                <a href="{{ route('agendar-horas.create') }}"
                    class="nav-item nav-link @if (request()->routeIs('agendar-horas.*')) active @endif">Agenda tu Hora</a>
                <a href="{{ route('shop.shop') }}"
                    class="nav-item nav-link @if (request()->routeIs('shop.*')) active @endif">Tienda</a>
                <a href="{{ route('servicios') }}"
                    class="nav-item nav-link @if (request()->routeIs('servicios')) active @endif">Servicios</a>
            </div>
            
            @guest
                @if (Route::has('login'))
                    <a class="pl-0 nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                @endif

                @if (Route::has('register'))
                    <a class="pl-0 nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                @endif
            @else
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    @if (isset(Auth::user()->image))
                        <img src="{{ asset('storage') . '/' . Auth::user()->image }}" alt=""
                            style="width:40px; height:40px;">
                    @else
                        <img src="{{ asset('image/default-user-image.png') }}" alt="profileImg"
                            style="width:40px; height:40px;">
                    @endif
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @hasrole('Admin')
                        <a class="dropdown-item" href="{{ route('admin') }}">
                            {{ __('Panel de Administrador') }}
                        </a>
                    @endhasrole
                    @hasrole('Veterinario')
                        <a class="dropdown-item" href="{{ route('veterinario') }}">
                            {{ __('Panel de Veterinario') }}
                        </a>
                    @endhasrole
                    @hasrole('Peluquero')
                        <a class="dropdown-item" href="{{ route('peluquero') }}">
                            {{ __('Panel de Peluquero') }}
                        </a>
                    @endhasrole
                    @hasrole('Inventario')
                        <a class="dropdown-item" href="{{ route('inventario') }}">
                            {{ __('Panel de Inventario') }}
                        </a>
                    @endhasrole
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endguest

        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')
    <script src="{{ asset('js/horarios.js') }}" defer></script>
    <!-- Footer Start -->
    <div id="foot" class="container-fluid footer bg-dark text-light footer mt-5 pt-5 wow fadeIn" style="min-width:360px;" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-7">
                <div class="col-lg-3 col-md-4">
                    <h5 class="text-light mb-4">Información</h5>
                    <p class="mb-2">
                        <i class="fa fa-map-marker-alt me-3"></i>{{ $landingMaps->direccion }}
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-phone-alt me-3"></i>+56{{ $landingMaps->telefono }}
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-envelope me-3"></i>{{ $landingMaps->correo }}
                    </p>
                    <div class="d-flex pt-2">
                        @isset($landingMaps->whatsapp)
                            <a class="btn btn-outline-light btn-social" href="{{ $landingMaps->whatsapp }}"
                                target="_blank"><i class="fab fa-whatsapp"></i></a>
                        @endisset
                        @isset($landingMaps->facebook)
                            <a class="btn btn-outline-light btn-social" href="{{ $landingMaps->facebook }}"
                                target="_blank"><i class="fab fa-facebook-f"></i></a>
                        @endisset
                        @isset($landingMaps->instagram)
                            <a class="btn btn-outline-light btn-social" href="{{ $landingMaps->instagram }}"
                                target="_blank"><i class="fab fa-instagram"></i></a>
                        @endisset
                        @isset($landingMaps->twitter)
                            <a class="btn btn-outline-light btn-social" href="{{ $landingMaps->twitter }}"
                                target="_blank"><i class="fab fa-twitter"></i></a>
                        @endisset
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <h5 class="text-light mb-4">Links</h5>
                    <a class="btn btn-link" href="{{ route('nosotros') }}">Nosotros</a>
                    <a class="btn btn-link" href="{{ route('servicios') }}">Servicios</a>
                    <a class="btn btn-link" href="{{ route('shop.shop') }}">Tienda</a>
                    <a class="btn btn-link" href="{{ route('agendar-horas.create') }}">Agenda tu Hora</a>
                </div>
                <div class="col-lg-5 col-md-5">
                    <h5 class="text-light mb-4">Nos puedes encontrar en:</h5>
                    <div style="width:100%;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3152.442873327544!2d-73.40212952459001!3d-37.803094333427644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x966a74cb799f78ed%3A0x4e32e96ea2b1070b!2sCl%C3%ADnica%20y%20Farmacia%20Veterinaria%20Gumiel!5e0!3m2!1ses!2scl!4v1682454729998!5m2!1ses!2scl"
                            width="100%" height="450" style="border-radius:25px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="{{ url()->current() }}">Veterinaria Gumiel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    @include('landing-page-floatIcons')
    <!--<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>-->

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/landingpage/main.js') }}"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options.positionClass = 'toast-bottom-right';
    </script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>
    @yield('js-after')
</body>

</html>
