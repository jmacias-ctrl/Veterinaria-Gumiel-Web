<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Mail\UsuarioEliminadoNotificacionUsuario;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UsuarioModificacionRoles;
use App\Notifications\GeneralNotificationForUsers;




use App\Mail\UsuarioCreadoAUsuario;

use App\Notifications\NuevoUsuarioNotificacion;
use App\Http\Requests\PostRequest;
use App\Notifications\UsuarioRemovidoNotificacion;


class PacientesController extends Controller
{
    public function index()
    {
        $pacientes = User::Paciente()->paginate(5);
        return view('pacientes.index' , compact('pacientes'));
    }


    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
         //dd($request->all());
         $rules = [
            'name' => 'required|string',
            'rut'  => 'required|string|max:10|unique:users',
            'email'  => 'required|string|unique:users',
            'phone' => 'required|digits:9',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un número de teléfono, ingrese nuevamente',
            'digits' => ':attribute inválido, debe ser :digits dígitos',
            'max' => ':attribute inválido, debe ser máximo :max',
            'unique' => ':attribute ya existe en la base de datos'
        ];

        
        $this->validate($request, $rules, $message);
    
    
        User::create(
            $request->only('name','rut','email','phone') + ['role' =>'Cliente']
            +['password' => bcrypt(substr($request->rut, 0, 8))]              
        )->assignRole('Cliente');
    
        $notification = 'El paciente se a registrado correctamente ';
        return redirect('/pacientes')->with(compact('notification'));
    }


    public function edit($id)
    {
        $pacientes = User::Paciente()->findOrFail($id);
        return view('pacientes.edit', compact('pacientes'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'rut'  => 'required|string|max:10|unique:users,rut,'.$id,
            'email'  => 'required|string|unique:users,email,'.$id,
            'phone' => 'required|digits:9',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un número de teléfono, ingrese nuevamente',
            'digits' => ':attribute inválido, debe ser :digits dígitos',
            'max' => ':attribute inválido, debe ser máximo :max',
            'unique' => ':attribute ya existe en la base de datos'
        ];
        $this->validate($request, $rules, $message);
        $user = User::Paciente()->findOrFail($id);

        $data =   $request->only('name','rut','email','phone',);

        $password = substr($request->rut, 0, 8);
        

        if($password)
            $data['password'] = bcrypt($password);
        
        $user->fill($data);
        $user->save();

        $notification = 'La informacion del paciente se modificado correctamente ';
        return redirect('/pacientes')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $user = User::Paciente()->findOrFail($id);
        $pacientename = $user->name;
        $user->delete();

        $notification = "El paciente $pacientename se elimino correctamente";
        return redirect('/pacientes')->with(compact('notification'));
    }
}
