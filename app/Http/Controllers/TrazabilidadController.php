<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrazabilidadController extends Controller
{
    public function generarTrazabilidadVentasYServicios()
    {
        $services_names_best = DB::table('servicios')->pluck('nombre');
        $services_names_worst = DB::table('servicios')->pluck('nombre')->reverse();

        $services_quantity_best = [10, 15, 8, 12, 20];
        $services_quantity_worst = [10, 15, 8, 12, 20];

        $sales_weekly = [100, 200, 150, 300];
        $sales_monthly = [5000, 7000, 4500, 6000, 8000, 5500];
        $sales_annual = [10000, 12000, 15000, 18000];

        $sales_last_month = 15000;
        $sales_current_month = 18000;

        return view('trazabilidad.trazabilidad-main', compact('services_names_best'));
    }
}