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
use App\Models\tiposervicios;
use App\Notifications\UsuarioRemovidoNotificacion;


class FuncionariosController extends Controller
{

    public function index(Request $request)
    {
        $tiposervicios = tiposervicios::all();
        $funcionarios = User::Funcionario()->paginate(5);
        return view('funcionarios.index', compact('funcionarios', 'tiposervicios'));
    }


    public function create()
    {
        $tiposervicios = tiposervicios::all();
        $roles = Role::whereIn('name', ['Veterinario', 'Peluquero'])->get();
        return view('funcionarios.create', compact('roles', 'tiposervicios'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'rut'  => 'required|string|max:10|unique:users',
            'email'  => 'required|string|unique:users',
            'phone' => 'required|digits:9',
            'role' => 'required',
            'tiposervicio_id' => 'required'
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un número de teléfono, ingrese nuevamente',
            'digits' => ':attribute inválido, debe ser :digits dígitos',
            'max' => ':attribute inválido, debe ser máximo :max',
            'unique' => ':attribute ya existe en la base de datos'
        ];


        $this->validate($request, $rules, $message);

        $user = new User();
        $user->name = $request->name;
        $user->rut = $request->rut;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->tiposervicio_id = $request->tiposervicio_id;
        $user->password = bcrypt($request->rut);
        $user->assignRole($request->role);
        $user->save();


        $notification = 'El funcionario se a registrado correctamente ';
        return redirect('/funcionarios')->with(compact('notification'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $roles = Role::whereIn('name', ['Veterinario', 'Peluquero'])->get();
        $funcionarios = User::Funcionario()->findOrFail($id);
        return view('funcionarios.edit', compact('funcionarios', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'rut'  => 'required|string|max:10|unique:users,rut,' . $id,
            'email'  => 'required|string|unique:users,email,' . $id,
            'phone' => 'required|digits:9',
            'role' => 'required',
            'tiposervicio_id' => 'required'
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un número de teléfono, ingrese nuevamente',
            'digits' => ':attribute inválido, debe ser :digits dígitos',
            'max' => ':attribute inválido, debe ser máximo :max',
            'unique' => ':attribute ya existe en la base de datos'
        ];
        $this->validate($request, $rules, $message);
        $user = User::Funcionario()->findOrFail($id);

        $data =   $request->only('name', 'rut', 'email', 'phone', 'role', 'tiposervicio_id');

        $password = substr($request->rut, 0, 8);


        if ($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notification = 'La informacion del medico se modificado correctamente ';
        return redirect('/funcionarios')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::Funcionario()->findOrFail($id);
        $funcionarioname = $user->name;
        $user->delete();

        $notification = "El funcionario $funcionarioname se elimino correctamente";
        return redirect('/funcionarios')->with(compact('notification'));
    }
}
