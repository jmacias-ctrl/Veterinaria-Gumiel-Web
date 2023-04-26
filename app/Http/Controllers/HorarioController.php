<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
class HorarioController extends Controller
{
    public function index()
    {
        $mytime = Carbon::now();
        $start = $mytime->copy()->startOfDay()->toDateTimeString();
        $end = $mytime->copy()->endOfDay()->toDateTimeString();


        $horario = Horario::where('start', '>=', $start)->where('start','<=',$end)->get();
        foreach($horario as $item){
            $user = User::where('id','=',$item->id_usuario)->first();
            $roles = $user->getRoleNames();
            $item->image = $user->image;
            $item->name = $user->name;
            $item->id = $user->id;
            if($roles->contains('Veterinario')){
                $item->role= 'Veterinario';
            }else{
                $item->role= 'Peluquero';
            }
            
        }
        return view('calendario.verCalendario',compact('horario'));
    }
}
