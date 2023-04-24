@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrusel Bootstrap</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><img src="{{ asset('images/logoGumiel.png') }}" style="width:5%;" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Nosotros">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Agendar">Agenda tu hora</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Tienda">Tienda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Contactanos">Contáctanos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Usuarios">Usuarios</a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="carouselExampleControls" class="carousel slide w-50" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://picsum.photos/640/360?random=1" class="d-block w-100" alt="First slide">
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/640/360?random=2" class="d-block w-100" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img src="https://picsum.photos/640/360?random=3" class="d-block w-100" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <div class="bg-white">
    <section class="d-flex justify-content-center align-items-center p-4">
      <div class="container bg-darkgreen rounded-50 w-50 p-4">
        <h2 class="text-white">Agendar horas</h2>
        <p class="lead text-white">
          Puedes solicitar tu hora con el veterinario o a servicios de peluquería.
        </p>
        <div class="">
          <a href="#" class="btn btn-success btn-lg">Agendar hora</a>
        </div>
        <img src="{{ asset('images/peluqueria.png') }}" style="width:10%; position: absolute; bottom: 10px; right: 10px; opacity: 0.5;">
      </div>


    </section>
  </div>

  <style>
    .bg-darkgreen {
      background-color: #2e7646;
    }

    .rounded-50 {
      border-radius: 20px;
    }
  </style>

  <section class="fondoRandom">
    <div class="container">
      <div class="row">
        <h2 class="text-white text-center">Nuestros servicios disponibles</h2>
        <div class="col-md-6 mb-4 p-4">
          <div class="p-4 rounded bg-white">
            <div class="text-center">
              <img src="{{ asset('images/peluqueria.png') }}" style="width:50%;" alt="Imagen servicio 1" class="img-fluid rounded-circle mb-3" />
            </div>
            <h3 class="text-center font-weight-bold mb-3">Peluquería</h3>
            <p class="text-center">
              Ofrecemos servicios de peluquería para mantener a tus mascotas
              limpias y bien arregladas.
            </p>
          </div>
        </div>
        <div class="col-md-6 mb-4 p-4">
          <div class="p-4 rounded bg-white">
            <div class="text-center">
              <img src="{{ asset('images/veterinaria.png') }}" style="width:50%;" alt="Imagen servicio 2" class="img-fluid rounded-circle mb-3" />
            </div>
            <h3 class="text-center font-weight-bold mb-3">Veterinaria</h3>
            <p class="text-center">
              Realizamos consultas medicas para diagnosticar y tratar
              cualquier problema de salud de tus mascotas. Tambien contamos
              con un amplio catalogo de vacunas para prevenir diversas
              enfermedades.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" style="background-color: white;">
    <div class="container p-4">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-center">Contáctanos</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mx-auto">
          <form action="#" method="POST" style="background-color: #6A6767; color: white; border-radius: 10px; padding: 20px;">
            <div class="form-group">
              <label for="name">Nombre completo</label>
              <input type="text" class="form-control" id="name" name="name" required style="margin-bottom: 10px;" />
            </div>
            <div class="form-group">
              <label for="email">Correo electrónico</label>
              <input type="email" class="form-control" id="email" name="email" required style="margin-bottom: 10px;" />
            </div>
            <div class="form-group">
              <label for="phone">Teléfono</label>
              <input type="text" class="form-control" id="phone" name="phone" required style="margin-bottom: 10px;" />
            </div>
            <div class="form-group">
              <label for="message">Mensaje</label>
              <textarea class="form-control" id="message" name="message" rows="5" required style="margin-bottom: 10px;"></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">
              Enviar
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>



  <footer style="background-color: #333; color: #fff; padding: 20px">
    <p style="text-align: center">
      © 2023 VeterinariaGumiel. Todos los derechos reservados.
    </p>
  </footer>

  <style>
    .fondoRandom {
      height: 500px;
      background-color: #2E7646;
      background-blend-mode: overlay;
      background-image: url("{{ asset('images/common_01.jpg') }}");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    .opacity-50 {
      background-color: rgba(255, 255, 255, 0.5);
    }

    .opacity-100 {
      background-color: rgba(255, 255, 255, 1);
    }
  </style>
</body>

</html>


@endsection