<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\User;
use Spatie\Permission\Models\Role;
class HorarioController extends Controller
{
    public function index()
    {
        $horario = Horario::all();
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
