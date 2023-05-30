<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <style>
        * {
            font-family: 'Cabin', sans-serif;
        }

        .email-content:not(.userInfo) {
            display: inline-block;
            align-self: center;
            text-align: center;
            margin: auto;
            width: 80%;
            border: 3px solid green;
            padding: 10px;
        }

        .userInfo {
            display: inline-block;
            border-style: solid;
            border-color: black;
            border-width: 1px;
            border-radius: 10px;
            width: 40%;
            text-align: center;
            padding: 15px;
            padding-left: 20px;
            padding-right: 20px;
            margin-top: 20px;
            margin-bottom: 25px;
            background: #FFF0C9;
        }

        .list-group {
            display: block;
            text-align: left;
            align-content: flex-start;
            list-style-type: none;
            padding: 0;
        }


        .div-list-group-item {
            padding: 5px;
            border-style: solid;
            border-color: black;
            background: white;
            justify-content: center;
            border-width: 1px;
            border-radius: 10px;
            opacity: 0.6;
            margin-top: 5px;
            word-wrap: break-word;
        }

        .bold {
            font-weight: bold;
            opacity: 1;
        }

        #logo {
            width: 100%
        }

        .buttonAction {
            width: 80%;
            height: 80px;
            background: #2E7646;
            font-size: 25px;
            color: white;
            border: none;
        }

        @media screen and (min-width: 1024px) {
            #logo {
                width: 40%
            }

            .buttonAction {
                width: 30%;
                height: 80px;
                background: #2E7646;
                font-size: 25px;
                color: white;
                border: none;
            }
        }

        @media screen and (max-width: 820px) {
            .userInfo {
                display: inline-block;
                border-style: solid;
                border-color: black;
                border-width: 1px;
                border-radius: 10px;
                margin-left: -21px;
                width: 100%;
                text-align: center;
                padding: 15px;
                padding-left: 20px;
                padding-right: 20px;
                margin-top: 20px;
                margin-bottom: 25px;
                background: #FFF0C9;
            }
        }
    </style>
</head>

<body style="background:#2E7646; display:flex; align-content: center;">
    <div class="email-content .center" style="background:white;">
        <header class="my-2">
            <a href="{{ url('') }}">
                <div class="d-flex justify-content-center">
                    <img id="logo" src="{{ asset('image/logo2.jpg') }}" alt="">
                </div>
            </a>
        </header>
        <hr>
        <main style="padding: 25px">
            <h1>Bienvenido</h1>
            <p style="font-size: 20px">Una nueva cuenta ha sido creada para usted para su uso nuestra plataforma web de
                la
                Veterinaria Gumiel
                en trabajos que estime conveniente, asignado a su rol en el area de trabajo.
            </p>
            <div class="userInfo">
                <img src="{{ asset('image/default-user-image.png') }}" alt="" style="width:100px; opacity:0.5;">
                <p class="bold" style="font-size:25px; margin-top:-1px;">@if (isset($nombre))
                    {{$nombre}}
                @endif</p>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class='div-list-group-item'>
                            <p class='bold'>Rut:&nbsp;
                                @if (isset($rut))
                                    {{ $rut }}
                                @endif
                            </p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='div-list-group-item'>
                            <p class='bold'>Email:&nbsp;
                                @if (isset($correo))
                                    {{ $correo }}
                                @endif
                            </p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='div-list-group-item'>
                            <p class='bold'>Telefono:&nbsp; @if (isset($telefono))
                                    {{ $telefono }}
                                @endif
                            </p>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='div-list-group-item'>
                            <p class='bold'>Roles:&nbsp;@if (isset($roles))
                                    @foreach ($roles as $role)
                                        {{ $role }}
                                    @endforeach
                                @endif
                            </p>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-center mt-5 ">
                <a href="{{ url('login') }}">
                    <button class="buttonAction">Ir
                        al Inicio de Sesion</button></a>
            </div>
            <p style="opacity: 0.7; font-size:20px">Para utilizar su nueva cuenta, debes ingresar su
                correo y su contraseña es el rut sin el digito verificador.</p>
        </main>
        <hr>
        <footer>
            <p style="opacity: 0.7;">© 2023 Veterinaria Gumiel. Todos los derechos reservados.
            </p>
        </footer>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
