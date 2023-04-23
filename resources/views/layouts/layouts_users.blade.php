<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('css-before')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout_user.css') }}">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    @yield('css-after')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('js-before')
</head>

<body>
    @php
        $userNotification = sizeof(Auth::user()->unreadNotifications);
    @endphp
    <div id="app">
        <div class="sidebar">
            <div class="logo-details">
                <a href="{{ route('welcome') }}">
                    <div class="logo_name"><img src="{{ asset('image/logo.png') }}" alt="" style="width: 125px;"
                            class="topImage"></div>
                </a>
                <i class='bx bx-menu' id="btn"></i>
            </div>
            <ul class="nav-list">
                <li>

                    <a href="{{ route('home') }}">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Inicio</span>
                    </a>
                    <span class="tooltip-section">Inicio</span>
                </li>
                @hasrole('Admin')
                    <li>
                        <span class="d-inline-block" tabindex="0" data-bs-toggle="focus" data-bs-trigger="hover focus"
                            data-bs-content="Disabled popover">
                            <a class="collapse-links" data-bs-toggle="collapse" href="#usuarioCollapse" role="button"
                                aria-expanded="false" aria-controls="usuarioCollapse">
                                <i class='bx bx-user'></i>
                                <span class="links_name">Gestion Usuarios</span>
                            </a>
                        </span>
                        <span class="tooltip-section">User</span>
                        <div class="collapse" id="usuarioCollapse">
                            <div class="card card-body" id="dropdown">
                                <a href="{{ route('admin.usuarios.index') }}" id="link-dropdown">Usuarios</a>
                                <a href="{{ route('admin.roles.index') }}" id="link-dropdown">Roles</a>
                            </div>
                        </div>

                    </li>
                @endhasrole
                @can('ver servicios')
                    <li>
                        <a href="#">
                            <i class='bx bxs-network-chart'></i>
                            <span class="links_name">Servicios</span>
                        </a>
                        <span class="tooltip-section">Servicios</span>
                    </li>
                @endcan
                @can('ver productos')
                    <li>
                        <a class="collapse-links" data-bs-toggle="collapse" href="#productosCollapse" role="button"
                            aria-expanded="false" aria-controls="usuarioCollapse">
                            <i class='bx bx-package'></i>
                            <span class="links_name">Productos</span>
                        </a>
                        <span class="tooltip-section">Gestion Productos</span>
                        <div class="collapse" id="productosCollapse">
                            <div class="card card-body" id="dropdown">
                                <a href="{{ route('productos.index') }}" id="link-dropdown">Productos</a>
                                <a href="{{ route('admin.marcaproductos.index') }}" id="link-dropdown">Marcas de
                                    Producto</a>
                                <a href="{{ route('admin.insumos_medicos.index') }}" id="link-dropdown">Insumos Medicos</a>
                                <a href="#" id="link-dropdown">Marcas Insum.Medicos</a>
                            </div>
                        </div>
                    </li>
                @endcan
                @can('ver cita')
                    <li>
                        <a class="collapse-links" data-bs-toggle="collapse" href="#productosCollapse" role="button"
                            aria-expanded="false" aria-controls="usuarioCollapse">
                            <i class='bx bx-package'></i>
                            <span class="links_name">Productos</span>
                        </a>
                        <span class="tooltip-section">Gestion Productos</span>
                        <div class="collapse" id="productosCollapse">
                            <div class="card card-body" id="dropdown">
                                <a href="#" id="link-dropdown">Productos</a>
                                <a href="#" id="link-dropdown">Marcas de Producto</a>
                                <a href="#" id="link-dropdown">Insumos Medicos</a>
                                <a href="#" id="link-dropdown">Marcas Insum.Medicos</a>
                            </div>
                        </div>
                    </li>
                @endcan
                @hasrole('Admin')
                    <li>
                        <a href="#">
                            <i class='bx bx-cog'></i>
                            <span class="links_name">Landing Page</span>
                        </a>
                        <span class="tooltip-section">Setting</span>
                    </li>
                @endhasrole
                <li class="notification">
                    <a href="{{ route('users.notification.index') }}">
                        @if ($userNotification != 0)
                            <span class="translate-middle badge rounded-pill bg-danger"
                                style="position: absolute; top:30%; left:50px" id="notificationCount">
                                @if ($userNotification < 99)
                                    {{ $userNotification }}
                                @else
                                    99+
                                @endif
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        @endif

                        <i class='bx bxs-bell'></i>
                        <span class="links_name">Notificaciones</span>
                    </a>
                    <span class="tooltip-section">Notificaciones</span>

                </li>
                <li class="profile">
                    <a href="{{ route('user.profile.index') }}" id="profileEdit">
                        <div class="profile-details">
                            @if (isset(Auth::user()->image))
                                <img src="{{ asset('storage') . '/' . Auth::user()->image }}" alt=""
                                    class="imageProfile">
                            @else
                                <img src="{{ asset('image/default-user-image.png') }}" alt="profileImg">
                            @endif

                            <div class="name_job">
                                <div class="name">{{ Auth::user()->name }}</div>
                                <div class="job">
                                    @foreach (Auth::user()->getRoleNames() as $roles)
                                        {{ $roles }}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"
                        id="logout"><i class='bx bx-log-out' id="log_out"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </div>
        <section class="home-section pt-5 px-5">
            @yield('content')
        </section>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    $(document).ready(function() {
        checkForNewNotifications()
    });
    document.querySelectorAll(".collapse-links").forEach(item => {
        item.addEventListener("click", () => {
            if (!sidebar.classList.contains('open')) {
                sidebar.classList.toggle("open");
                menuBtnChange();
            }
        })
    });

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("open");
        menuBtnChange(); //calling the function(optional)
        if (!sidebar.classList.contains('open')) {
            const collapsibleAll = document.querySelectorAll('.collapse');
            collapsibleAll.forEach(el => {
                el.classList.remove('show')
            })
        }
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
        if (sidebar.classList.contains("open")) {
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
        } else {
            closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
        }
    }

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
        }, 1500);
    }
</script>
@yield('js-after')

</html>
