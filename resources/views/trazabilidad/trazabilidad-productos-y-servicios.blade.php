<section class="trazabilidad-productos-y-servicios">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Servicios más vendidos</div>
          <div class="card-body">
            <canvas id="serviciosMasVendidos"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Servicios menos vendidos</div>
          <div class="card-body">
            <canvas id="serviciosMenosVendidos"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Ventas semanales</div>
          <div class="card-body">
            <canvas id="ventasSemanales"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Ventas mensuales</div>
          <div class="card-body">
            <canvas id="ventasMensuales"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Ventas anuales</div>
          <div class="card-body">
            <canvas id="ventasAnuales"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Alertas de baja de stock</div>
          <div class="card-body">
            <!-- Aquí puedes mostrar las alertas de baja de stock -->
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Comparación con el mes/semana anterior de ventas</div>
          <div class="card-body">
            <canvas id="comparacionVentas"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @php
    $services_names = ['Servicio A', 'Servicio B', 'Servicio C', 'Servicio D', 'Servicio E'];
    $services_quantity = [10, 15, 8, 12, 20];

    $sales_weekly = [100, 200, 150, 300];
    $sales_monthly = [5000, 7000, 4500, 6000, 8000, 5500];
    $sales_annual = [10000, 12000, 15000, 18000];

    $sales_last_month = 15000;
    $sales_current_month = 18000;
  @endphp


  <script>
    // Código JavaScript para generar los gráficos con Chart.js y los datos del controlador

    // Gráfico de servicios más vendidos
    var serviciosMasVendidosCtx = document.getElementById('serviciosMasVendidos').getContext('2d');
    var serviciosMasVendidosChart = new Chart(serviciosMasVendidosCtx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($services_names); ?>,
        datasets: [{
          label: 'Cantidad',
          data: <?php echo json_encode($services_quantity); ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color de fondo de las barras
          borderColor: 'rgba(75, 192, 192, 1)', // Color del borde de las barras
          borderWidth: 1 // Ancho del borde de las barras
        }]
      },
      options: {
        // Opciones de personalización para el gráfico
      }
    });

    // Gráfico de servicios menos vendidos
    var serviciosMenosVendidosCtx = document.getElementById('serviciosMenosVendidos').getContext('2d');
    var serviciosMenosVendidosChart = new Chart(serviciosMenosVendidosCtx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($services_names); ?>,
        datasets: [{
          label: 'Cantidad',
          data: <?php echo json_encode($services_quantity); ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color de fondo de las barras
          borderColor: 'rgba(75, 192, 192, 1)', // Color del borde de las barras
          borderWidth: 1 // Ancho del borde de las barras
        }]
      },
      options: {
        // Opciones de personalización para el gráfico
      }
    });

    // Gráfico de ventas semanales
    var ventasSemanalesCtx = document.getElementById('ventasSemanales').getContext('2d');
    var ventasSemanalesChart = new Chart(ventasSemanalesCtx, {
      type: 'line',
      data: {
        labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'], // Etiquetas para el eje X
        datasets: [{
          label: 'Ventas semanales',
          data: <?php echo json_encode($sales_weekly); ?>, // Datos de ventas para cada semana
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }]
      },
      options: {
        // Opciones de personalización para el gráfico
      }
    });


    // Gráfico de ventas mensuales
    var ventasMensualesCtx = document.getElementById('ventasMensuales').getContext('2d');
    var ventasMensualesChart = new Chart(ventasMensualesCtx, {
      type: 'line',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'], // Etiquetas para el eje X
        datasets: [{
          label: 'Ventas mensuales',
          data: <?php echo json_encode($sales_monthly); ?>, // Datos de ventas para cada mes
          backgroundColor: 'rgba(54, 162, 235, 0.5)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        // Opciones de personalización para el gráfico
      }
    });


    // Gráfico de ventas anuales
    var ventasAnualesCtx = document.getElementById('ventasAnuales').getContext('2d');
    var ventasAnualesChart = new Chart(ventasAnualesCtx, {
      type: 'line',
      data: {
        labels: ['2018', '2019', '2020', '2021'], // Etiquetas para el eje X
        datasets: [{
          label: 'Ventas anuales',
          data: <?php echo json_encode($sales_annual); ?>, // Datos de ventas para cada año
          backgroundColor: 'rgba(75, 192, 192, 0.5)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        // Opciones de personalización para el gráfico
      }
    });


    // Gráfico de comparación de ventas
    var comparacionVentasCtx = document.getElementById('comparacionVentas').getContext('2d');
    var comparacionVentasChart = new Chart(comparacionVentasCtx, {
      type: 'bar',
      data: {
        labels: ['Mes anterior', 'Mes actual'], // Etiquetas para el eje X
        datasets: [{
          label: 'Ventas',
          data: [<?php echo json_encode($sales_last_month); ?>, <?php echo json_encode($sales_current_month); ?>], // Datos de ventas para el mes anterior y el mes actual
          backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(54, 162, 235, 0.5)'],
          borderColor: ['rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        // Opciones de personalización para el gráfico
      }
    });
  </script>
</section>