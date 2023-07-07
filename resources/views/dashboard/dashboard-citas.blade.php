@extends('layouts.panel_usuario')
<title>Modificacion de Ubicacion - Veterinaria Gumiel</title>
@section('css-before')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  input[type=number] {
    -moz-appearance: textfield;
  }

  .imageProfile {
    width: 150px;

  }
</style>
@endsection
@section('js-before')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endsection
@section('back-arrow')
<a href="{{ route('user.profile.index') }}"> <span class="material-symbols-outlined" style="font-size:40px; color:white;">
    arrow_back
  </span> </a>
@endsection
@section('header-title')
Modificacion del Perfil {{ Auth::user()->name }}
@endsection
@section('breadcrumbs')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('inicio_panel') }}" style="color:black;">
        Inicio</a>
    </li>
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('user.profile.index') }}" style="color:black;">Perfil de {{ auth()->user()->name }}</a> </li>
    <li class="breadcrumb-item active" aria-current="page" style="color:white;">Dashboard citas</li>
</nav>
@endsection
@section('content')
<section class="trazabilidad-productos-y-servicios">
  <div class="container">
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Citas para hoy</div>
          <div class="card-body text-center">
            <p class="display-4">Total: {{$totalCitasHoy}}</p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Citas para la semana</div>
          <div class="card-body text-center">
            <p class="display-4">Total: {{$totalCitasSemana}}</p>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Citas para hoy (registro)</div>
          <div class="card-body text-center">
            <div class="table-responsive">

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Nombre Paciente</th>
                    <th>Nombre Funcionario</th>
                    <th>Tipo de Servicio</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($citasTotalHoy as $cita)
                  <tr>
                    @foreach ($cita as $value)
                    <td>{{ $value }}</td>
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <a href="{{route('Agendar')}}" class="btn btn-success m-4">Ir mis citas</a>

            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Cantidad de citas por dia esta semana</div>
          <div class="card-body">
            <canvas id="graph01"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Confirmadas VS Pendientes (Semana actual)</div>
          <div class="card-body">
            <canvas id="graph02"></canvas>
          </div>
        </div>
      </div>

    </div>

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Proximas citas</div>
          <div class="card-body text-center">
            <div class="table-responsive">

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Nombre Paciente</th>
                    <th>Nombre Funcionario</th>
                    <th>Tipo de Servicio</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($citasTotal as $cita)
                  <tr>
                    @foreach ($cita as $value)
                    <td>{{ $value }}</td>
                    @endforeach
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <a href="{{route('Agendar')}}" class="btn btn-success m-4">Ir a mis citas</a>

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @php

  $services_names_best = [];
  $services_quantity_best = [];
  $services_names_worst = [];
  $services_quantity_worst = [];
  $sales_weekly = [];
  $sales_monthly = [];
  $sales_annual = [];
  $citas_last_month = 0;
  $citas_current_month = 0;

  @endphp


  <script>
    // LA COSA PRO

    var graph_element = document.getElementById('graph01').getContext('2d');
    var graph = new Chart(graph_element, {
      type: 'line',
      data: {
        labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'], // Etiquetas para el eje X
        datasets: [{
          label: 'Cantidad de citas en la semana',
          data: <?php echo json_encode($cantCitasPorDiaDeLaSemana); ?>, // Datos de ventas para cada día de la semana
          backgroundColor: 'rgba(112, 184, 93, 0.5)', // Tono de verde
          borderColor: 'rgba(112, 184, 93, 1)', // Tono de verde
          borderWidth: 1
        }]
      },
      options: {}
    });

    var graph_element = document.getElementById('graph02').getContext('2d');
    var graph = new Chart(graph_element, {
      type: 'pie',
      data: {
        labels: ['Confirmadas', 'Pendientes'], // Etiquetas para cada dato
        datasets: [{
          data: [<?php echo json_encode($totalConfirmadasSemana); ?>, <?php echo json_encode($totalPendientesSemana); ?>],
          backgroundColor: ['rgba(112, 184, 93, 0.5)', 'rgba(255, 99, 132, 0.5)'], // Colores de fondo para cada dato
          borderColor: ['rgba(112, 184, 93, 1)', 'rgba(255, 99, 132, 1)'], // Colores de borde para cada dato
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false, // Desactivar el mantenimiento del aspecto para ajustar el tamaño
        aspectRatio: 1.5, // Proporción de aspecto personalizada (puedes ajustar el valor según tus necesidades)
        // Otras opciones de personalización para el gráfico
      }
    });


    // Gráfico de ventas anuales

    // var ventasAnualesCtx = document.getElementById('ventasAnuales').getContext('2d');
    // var ventasAnualesChart = new Chart(ventasAnualesCtx, {
    //   type: 'line',
    //   data: {
    //     labels: ['2018', '2019', '2020', '2021'], // Etiquetas para el eje X
    //     datasets: [{
    //       label: 'Citas anuales',
    //       data: <?php echo json_encode($sales_annual); ?>, // Datos de ventas para cada año
    //       backgroundColor: 'rgba(75, 192, 192, 0.5)',
    //       borderColor: 'rgba(75, 192, 192, 1)',
    //       borderWidth: 1
    //     }]
    //   },
    //   options: {
    //     // Opciones de personalización para el gráfico
    //   }
    // });


    // Gráfico de comparación de ventas

    // var comparacionVentasCtx = document.getElementById('comparacionVentas').getContext('2d');
    // var comparacionVentasChart = new Chart(comparacionVentasCtx, {
    //   type: 'bar',
    //   data: {
    //     labels: ['Mes anterior', 'Mes actual'], // Etiquetas para el eje X
    //     datasets: [{
    //       label: 'Cantidad',
    //       data: [<?php echo json_encode($citas_last_month); ?>, <?php echo json_encode($citas_current_month); ?>], // Datos de ventas para el mes anterior y el mes actual
    //       backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(54, 162, 235, 0.5)'],
    //       borderColor: ['rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)'],
    //       borderWidth: 1
    //     }]
    //   },
    //   options: {
    //     // Opciones de personalización para el gráfico
    //   }
    // });
  </script>
</section>
@endsection