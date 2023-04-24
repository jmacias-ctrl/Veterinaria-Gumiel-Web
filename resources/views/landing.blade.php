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
    <a class="navbar-brand" href="#"><img src="https://via.placeholder.com/150x50.png?text=Logo" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Agenda tu hora</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tienda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contáctanos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Usuarios</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="imagen1.jpg" class="d-block w-100" alt="imagen1">
        </div>
        <div class="carousel-item">
          <img src="imagen2.jpg" class="d-block w-100" alt="imagen2">
        </div>
        <div class="carousel-item">
          <img src="imagen3.jpg" class="d-block w-100" alt="imagen3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>     -->

  <section class="jumbotron bg-darkgreen rounded-50">
    <div class="container">
      <h2 class="text-center text-white">Agendar horas</h2>
      <p class="lead text-center text-white">
        Puedes solicitar tu hora con el veterinario o a servicios de
        peluquería.
      </p>
      <div class="text-center">
        <a href="#" class="btn btn-success btn-lg">Agendar hora</a>
      </div>
    </div>
  </section>

  <style>
    .bg-darkgreen {
      background-color: #2e7646;
      /* Cambiar por el color deseado */
    }

    .rounded-50 {
      border-radius: 20px;
    }
  </style>

  <section class="fondoRandom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="p-4 rounded bg-white">
            <div class="text-center">
              <img src="ruta/a/la/imagen.jpg" alt="Imagen servicio 1" class="img-fluid rounded-circle mb-3" />
            </div>
            <h3 class="text-center font-weight-bold mb-3">Peluquería</h3>
            <p class="text-center">
              Ofrecemos servicios de peluquería para mantener a tus mascotas
              limpias y bien arregladas.
            </p>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="p-4 rounded bg-white">
            <div class="text-center">
              <img src="ruta/a/la/imagen.jpg" alt="Imagen servicio 2" class="img-fluid rounded-circle mb-3" />
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
    <div class="container">
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
      background-image: url("https://picsum.photos/id/447/1000/500");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      /* background-attachment: fixed; */
    }
  </style>
</body>

</html>


@endsection