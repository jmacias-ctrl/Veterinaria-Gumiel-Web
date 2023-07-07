<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        Error @yield('error-code') - {{ config('app.name') }}
    </title>
    <!-- Favicon -->
    <link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('css/argon-dashboard.css?v=1.1.2') }}" rel="stylesheet" />
    <style>
        h1{
            font-size: 35px;
        }
        p{
            font-size:25px;
        }
    </style>
</head>

<body style="background:#2E7646;">
    <div class="main-content">

        <div class="header py-7 py-lg-8" style="background: #2E7646;">

            <div class="container">
                <div class="row justify-content-center text-center">

                    <div class="col-lg-7 col-md-6">
                        <a class="justify-content-center" href="{{ route('inicio') }}"
                            style="border:white; border-width:2px;">
                            <img src="{{ asset('image/logo.png') }}" style="width: 100px; height:100px;" />
                        </a>
                        <h1 class="text-white">Error @yield('error-code')</h1>
                        <p class="text-lead text-light fs-1"> @yield('error-message')</p>

                    </div>
                    <img src="{{ asset('images/error-image.png') }}" style="width:80%" />
                </div>
                
            </div>
        </div>
    </div>
    <script src="{{ asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/argon-dashboard.min.js?v=1.1.2') }}"></script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
</body>

</html>
