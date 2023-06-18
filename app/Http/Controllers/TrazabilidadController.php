<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;
use App\Models\items_comprados;
use App\Models\trazabilidad_venta_presencial;

use App\Models\ReservarCitas;

use App\Models\tipo_consulta_tamanios;
use Hamcrest\Core\HasToString;

class TrazabilidadController extends Controller
{
    public function generarTrazabilidadVentasYServicios()
    {
        $aux = items_comprados::with('servicios', 'servicios.tiposervicios')
            ->where('tipo_item', 'servicio')
            ->get()
            ->groupBy(function ($item) {
                return $item->servicios->tiposervicios->nombre;
            })
            ->map(function ($group) {
                return $group->count();
            });

        $aux_sorted = $aux->sortByDesc(function ($value) {
            return $value;
        });

        $services_names_best = $aux_sorted->keys()->toArray();
        $services_names_worst = array_reverse($services_names_best);

        $services_quantity_best = $aux_sorted->values()->toArray();
        $services_quantity_worst = array_reverse($services_quantity_best);

        $today = Carbon::today();

        //VENTAS HOY
        $totalVentasHoy = items_comprados::with('productos_ventas')
            ->whereDate('created_at', $today)
            ->get()
            ->sum('cantidad');

        $totalMontoHoy = items_comprados::with('productos_ventas')
            ->whereDate('created_at', $today)
            ->get()
            ->sum(function ($item) {
                return $item->monto * $item->cantidad;
            });

        //SACAMOS LOS INICIOS Y FINALES DE SEMANA
        $startOfWeek = Carbon::today()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::today()->endOfWeek(Carbon::SUNDAY);

        //VENTAS SEMANA
        $totalVentasSemana = items_comprados::with('productos_ventas')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->get()
            ->sum('cantidad');

        $totalMontoSemana = items_comprados::with('productos_ventas')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->get()
            ->sum(function ($item) {
                return $item->monto * $item->cantidad;
            });

        //VENTAS MES COMPARATIVA
        $sales_current_month = items_comprados::with('productos_ventas')
            ->whereMonth('created_at', $today->month)
            ->get()
            ->sum(function ($item) {
                return $item->monto * $item->cantidad;
            });

        $sales_last_month = items_comprados::with('productos_ventas')
            ->whereMonth('created_at', $today->submonth()->month)
            ->get()
            ->sum(function ($item) {
                return $item->monto * $item->cantidad;
            });

        //VENTAS DEL AÑO ACTUAL
        $today = Carbon::today();
        $currentYear = $today->year;

        $sales_annual = items_comprados::with('productos_ventas')
            ->whereYear('created_at', $currentYear)
            ->get()
            ->sum(function ($item) {
                return $item->monto * $item->cantidad;
            });

        function getPreviousMonthSales($index)
        {
            $today = Carbon::today();
            $mesAnterior = $today->subMonths($index);

            $ventas = items_comprados::with('productos_ventas')
                ->whereMonth('created_at', $mesAnterior->month)
                ->get()
                ->sum(function ($item) {
                    return $item->monto * $item->cantidad;
                });

            return $ventas;
        }

        function getPreviousWeekSales($index)
        {
            $today = Carbon::today();
            $previousWeek = $today->subWeeks($index);

            $sales = items_comprados::with('productos_ventas')
                ->whereBetween('created_at', [
                    $previousWeek->startOfWeek(),
                    $previousWeek->endOfWeek()
                ])
                ->get()
                ->sum(function ($item) {
                    return $item->monto * $item->cantidad;
                });

            return $sales;
        }

        function getPreviousYearSales($index)
        {
            $today = Carbon::today();
            $previousYear = $today->subYears($index);

            $sales = items_comprados::with('productos_ventas')
                ->whereYear('created_at', $previousYear->year)
                ->get()
                ->sum(function ($item) {
                    return $item->monto * $item->cantidad;
                });

            return $sales;
        }

        //SERVICIOS MAS VENDIDOS TODO <<
        // $query_servicios = items_comprados::with('servicios')
        //     ->get();

        // $query_servicios = items_comprados::with('servicios')->get()->pluck();
        // $totalVentasHoy = $query_servicios;

        $sales_weekly = [
            getPreviousWeekSales(3),
            getPreviousWeekSales(2),
            getPreviousWeekSales(1),
            $totalMontoSemana
        ];

        $sales_monthly = [
            getPreviousMonthSales(5),
            getPreviousMonthSales(4),
            getPreviousMonthSales(3),
            getPreviousMonthSales(2),
            getPreviousMonthSales(1),
            $sales_current_month
        ];

        $sales_annual = [
            getPreviousYearSales(3),
            getPreviousYearSales(2),
            getPreviousYearSales(1),
            $sales_annual
        ];

        $variables = get_defined_vars();

        return view('trazabilidad.trazabilidad-main', $variables);
    }

    public function generarDashboardCitas()
    {

        $aux = ReservarCitas::with('paciente')->where('status', '!=', 'Cancelada')->get()->map(function ($item) {
            return [$item->scheduled_date, $item->paciente->name];
        });

        $today = date('Y-m-d');
        $citasTotal = ReservarCitas::with('paciente', 'funcionario', 'tiposervicio', 'cancellation')
            ->where('status', '!=', 'Cancelada')
            ->whereDate('scheduled_date', '>=', $today)
            ->take(30)
            ->get()
            ->map(function ($item) {
                return [
                    'scheduled_date' => $item->scheduled_date,
                    'sheduled_time' => $item->sheduled_time,
                    'paciente_name' => $item->paciente->name,
                    'funcionario_name' => $item->funcionario->name,
                    'tiposervicio_nombre' => $item->tiposervicio->nombre,
                    'status' => $item->status,
                ];
            })
            ->values(); // Obtener solo los valores, sin las claves

        //citas total hoy
        $today = date('Y-m-d');
        $citasTotalHoy = ReservarCitas::with('paciente', 'funcionario', 'tiposervicio', 'cancellation')
            ->where('status', '!=', 'Cancelada')
            ->whereDate('scheduled_date', '=', $today)
            ->get()
            ->map(function ($item) {
                return [
                    'scheduled_date' => $item->scheduled_date,
                    'sheduled_time' => $item->sheduled_time,
                    'paciente_name' => $item->paciente->name,
                    'funcionario_name' => $item->funcionario->name,
                    'tiposervicio_nombre' => $item->tiposervicio->nombre,
                    'status' => $item->status,
                ];
            })
            ->values();

        $today = Carbon::today();

        $totalCitasHoy = ReservarCitas::whereDate('scheduled_date', $today)
            ->where('status', '!=', 'Cancelada')
            ->count();

        $startOfWeek = Carbon::today()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::today()->endOfWeek(Carbon::SUNDAY);

        $totalCitasSemana = ReservarCitas::whereBetween('scheduled_date', [$startOfWeek, $endOfWeek])
            ->where('status', '!=', 'Cancelada')
            ->count();

        // $cantCitasPorDiaDeLaSemana = [7, 6, 3, 2, 3, 6, 7];
        $startOfWeek = Carbon::today()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::today()->endOfWeek(Carbon::SUNDAY);

        $cantCitasPorDiaDeLaSemana = [];

        // Iterar sobre los días de la semana
        for ($day = $startOfWeek; $day <= $endOfWeek; $day->addDay()) {
            // Contar la cantidad de citas para el día actual
            $cantidadCitas = ReservarCitas::whereDate('scheduled_date', $day)
                ->where('status', '!=', 'Cancelada')
                ->count();

            // Agregar la cantidad de citas al array
            $cantCitasPorDiaDeLaSemana[] = $cantidadCitas;
        }
        // fin citas por dia en semana actual

        // CONFIRMADAS VS POR CONFIRMAR
        $startOfWeek = Carbon::today()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = Carbon::today()->endOfWeek(Carbon::SUNDAY);

        $totalConfirmadasSemana = ReservarCitas::whereBetween('scheduled_date', [$startOfWeek, $endOfWeek])
            ->where('status', '=', 'Confirmada')
            ->count();

        $totalPendientesSemana = ReservarCitas::whereBetween('scheduled_date', [$startOfWeek, $endOfWeek])
            ->where('status', '=', 'Reservada')
            ->count();

        $variables = get_defined_vars();

        return view('dashboard.dashboard-citas', $variables);
    }
}
