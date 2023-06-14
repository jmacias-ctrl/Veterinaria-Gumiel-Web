<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class HorarioController extends Controller
{
    public function index()
    {
        $mytime = Carbon::now();
        $currentDay = $mytime->dayOfWeek;
        $horario = user::join('horario_funcionarios', 'horario_funcionarios.user_id', '=', 'users.id')
        ->where('day','=',$currentDay)
        ->where('active', '=', 1)
        ->select('users.id','users.name','users.rut','users.image', 'morning_start', 'morning_end', 'afternoon_start', 'afternoon_end')
        ->orderBy('last_seen', 'DESC')
        ->get()
        ->map(function($item){  
            $item->role = $item->getRoleNames()->first();
            $item->morning_start = Carbon::parse($item->morning_start)->format('h:i:s A');
            $item->morning_end = Carbon::parse($item->morning_end)->format('h:i:s A');
            $item->afternoon_start = Carbon::parse($item->afternoon_start)->format('h:i:s A');
            $item->afternoon_end = Carbon::parse($item->afternoon_end)->format('h:i:s A');
            return $item;
        });
        return view('calendario.verCalendario',compact('horario'));
    }
}
