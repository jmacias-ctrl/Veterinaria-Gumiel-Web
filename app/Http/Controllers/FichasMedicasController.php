<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioFuncionarioServiceInterface;
use App\Mail\AproximacionHora;
use App\Mail\CancelarHora;
use App\Mail\CancelarHoraDespuesConfirm;
use App\Mail\ConfirmacionHora;
use App\Models\CancelledCitas;
use App\Models\ReservarCitas;
use App\Models\servicios;
use App\Models\tiposervicios;
use App\Models\User;
use App\Models\Mascota;
use App\Models\Especie;
use App\Models\medicamentos_vacunas;
use App\Models\fichas_medicas;
use App\Models\insumos_medicos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class FichasMedicasController extends Controller
{
    // GENERAR FICHAS MEDICAS

    public function formFichaMedica(ReservarCitas $ReservarCita)
    {
        $user = auth()->user();

        $cliente = User::where('id', $ReservarCita->paciente_id)->first(); // buscamos al cliente relacionado a la cita

        $mascotas = mascota::where('id_cliente', $cliente->id)->with('GetEspecie')->get();
        $mascotas->load('GetEspecie');

        $especies = Especie::all();

        $registros = fichas_medicas::where('id_hora_reservada', $ReservarCita->id)->get();

        $medicamentos = medicamentos_vacunas::all();
        $insumos = insumos_medicos::all();

        if ($user->hasRole('Veterinario') || $user->hasRole('Peluquero') || $user->hasRole('admin')) {
            if ($ReservarCita->status == 'Confirmada') {
                return view('ReservarCitas.create_fichaMedica', compact('ReservarCita', 'mascotas', 'cliente', 'especies', 'medicamentos', 'insumos', 'registros'));
            }

            return redirect()->route('Agendar');
        }
    }

    public function generarFichaMedica(ReservarCitas $ReservarCita, Request $request)
    {

        $user = auth()->user();

        $fichas_medicas = new fichas_medicas();
        $fichas_medicas->id_mascota = $request->input('id_mascota');
        $fichas_medicas->id_hora_reservada = $request->input('id_hora_reservada');
        $fichas_medicas->peso_mascota = $request->input('peso_mascota');
        $fichas_medicas->edad = $request->input('edad');
        $fichas_medicas->observacion = $request->input('observacion');
        $fichas_medicas->procedimiento = $request->input('procedimiento');
        $fichas_medicas->save();

        //actualizamos el stock de los medicamentos
        foreach ($_POST['medicamentos'] as $medicamentoId => $cantidad) {
            $medicamento = medicamentos_vacunas::find($medicamentoId);
            if ($medicamento) {
                $medicamento->stock -= $cantidad;
                $medicamento->save();
            }
        }

        //actualizamos el stock de los insumos
        foreach ($_POST['insumos'] as $insumoId => $cantidad) {
            $insumo = insumos_medicos::find($insumoId);
            if ($insumo) {
                $insumo->stock -= $cantidad;
                $insumo->save();
            }
        }

        //Podriamos mandar un correo de la cita :D

        // if ($ReservarCita->status == 'Confirmada') {
        //     $correo = new CancelarHoraDespuesConfirm($ReservarCita);
        //     if ($user->hasRole('Veterinario') || $user->hasRole('Peluquero')) {
        //         Mail::to($ReservarCita->paciente->email)->send($correo);
        //     } elseif ($user->hasRole('Cliente')) {
        //         Mail::to($ReservarCita->funcionario->email)->send($correo);
        //     }
        // } else {
        //     $correo = new CancelarHora($ReservarCita);
        //     if ($user->hasRole('Veterinario') || $user->hasRole('Peluquero')) {
        //         Mail::to($ReservarCita->paciente->email)->send($correo);
        //     } elseif ($user->hasRole('Cliente')) {
        //         Mail::to($ReservarCita->funcionario->email)->send($correo);
        //     }
        // }

        $notification = 'Ficha medica generada correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
    }
}
