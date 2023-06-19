<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Models\ReservarCitas;
use App\Models\tiposervicios;
use App\Services\HorarioFuncionarioService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\trazabilidad_venta_presencial;
use App\Models\efectivo;
use App\Models\transferencia;
use App\Models\tarjeta;
use App\Models\servicios;
use App\Models\items_comprados;
use Illuminate\Support\Str;

class ControlServicioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ReservarCitas::with('funcionario', 'paciente')->join('servicios', 'reservar_citas.tiposervicio_id', '=', 'servicios.id')->select('reservar_citas.id', 'paciente_id', 'funcionario_id', 'servicios.nombre', 'reservar_citas.status', 'servicios.precio', 'reservar_citas.pagado')->where('pagado', '=', false)->get()->map(function ($item) {
                $item->monto = $item->precio;
                $item->funcionario_id = $item->funcionario->name;
                $item->name = $item->paciente->name;
                $item->rut = $item->paciente->rut;
                $item->precio = '$' . number_format($item->precio, 0, ',', '.');
                if ($item->pagado == "1") {
                    $item->pagado = "Si";
                } else {
                    $item->pagado = "No";
                }
                return $item;
            });
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'control_servicio.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('control_servicio.index');
    }

    public function create(HorarioFuncionarioServiceInterface $horarioFuncionarioServiceInterface)
    {
        $tiposervicios = tiposervicios::all();
        $tipoconsulta_tam = servicios::all();

        $tiposervicioId = old('tiposervicio_id');
        if ($tiposervicioId) {
            $tiposervicio = tiposervicios::find($tiposervicioId);
            $funcionarios = $tiposervicio->users;
        } else {
            $funcionarios = collect();
        }

        $date = old('scheduled_date');
        $funcionarioId = old('funcionario_id');

        if ($date && $funcionarioId) {
            $intervals = $horarioFuncionarioServiceInterface->getAvailableIntervals($date, $funcionarioId);
        } else {
            $intervals = null;
        }

        return view('control_servicio.reservar', compact('tiposervicios', 'funcionarios', 'intervals', 'tipoconsulta_tam'));
    }

    public function pagar_reserva(Request $request)
    {
        $fecha = Carbon::now();
        $fecha_t = $fecha->toDateString();
        $hora = $fecha->format('h:i:s');

        $reserva = ReservarCitas::find($request->id);
        $id_servicio = $reserva->id_servicio;
        $servicio = servicios::find($id_servicio);

        $nuevaVenta  = new trazabilidad_venta_presencial();
        $nuevaVenta->id_venta = Str::random(10);
        $nuevaVenta->metodo_pago = $request->metodoPago;
        $nuevaVenta->nombre_cliente = $request->nombreCliente;
        $nuevaVenta->id_operador = auth()->user()->id;
        $nuevaVenta->fecha_compra = $fecha->toDateTimeString();
        $nuevaVenta->save();
        $montoFinal = 0;
        $metodoPagoEscogido = null;



        $itemComprado =  new items_comprados();
        $itemComprado->monto = $servicio->precio;
        $itemComprado->cantidad = 1;
        $itemComprado->id_servicio = $servicio->id;
        $itemComprado->id_venta = $nuevaVenta->id;
        $itemComprado->tipo_item = "servicio";
        $itemComprado->save();
        $montoFinal = $itemComprado->monto;


        switch ($request->metodoPago) {
            case 'transferencia':
                $transferencia = new transferencia();
                $transferencia->banco = $request->banco;
                $transferencia->num_operacion = $request->numOperacion;
                $transferencia->id_operacion = $nuevaVenta->id;
                $transferencia->save();
                $metodoPagoEscogido = $transferencia;
                break;
            case 'efectivo':
                $efectivo = new efectivo();
                $efectivo->efectivo = $request->montoEfectivo;
                $efectivo->vuelto = $request->montoEfectivo - $montoFinal;
                $efectivo->id_operacion = $nuevaVenta->id;
                $efectivo->save();
                $metodoPagoEscogido = $efectivo;
                break;
            case 'tarjeta':
                $tarjeta = new tarjeta();
                $tarjeta->num_operacion = $request->numOperacion;
                $tarjeta->id_operacion = $nuevaVenta->id;
                $tarjeta->save();
                $metodoPagoEscogido = $tarjeta;
                break;
        }
        $reserva->pagado = true;
        $reserva->save();
        $showItemBought['name'] = $servicio->nombre;
        $showItemBought['price'] = $servicio->precio;
        $showItemBought['quantity'] = 1;
        return response()->json(['success' => true, 'metodoPago' => $request->metodoPago, 'fecha' => $fecha_t, 'hora' => $hora, 'servicioPagado' => $showItemBought, 'montoFinal' => $montoFinal, 'nuevaVenta' => $nuevaVenta], 200);
    }
}
