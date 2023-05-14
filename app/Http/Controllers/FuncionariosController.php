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

class FuncionariosController extends Controller
{
    
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $funcionarios = User::Funcionario()->get();
            foreach ($funcionarios as $user) {
                $user->nombre_rol = $user->getRoleNames();
                if (!isset($user->phone)) {
                    $user->phone = "No Definido";
                }
            }
            return Datatables::of($funcionarios)
                ->addIndexColumn()
                ->addColumn('action', 'funcionarios.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
        $funcionarios = User::all();
        foreach ($funcionarios as $user) {
            $user->nombre_rol = $user->getRoleNames();
            if (!isset($user->phone)) {
                $user->phone = "No Definido";
            }
        }
        return view('funcionarios.index', compact('funcionarios'));
    }


    public function create()
    {
        $roles = Role::whereIn('name', ['Veterinario', 'Peluquero'])->get();
        return view('funcionarios.create',compact('roles'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    $rules = [
        'name' => 'required|string',
        'rut'  => 'required|string|max:10|unique:users',
        'email'  => 'required|string|unique:users',
        'telefono' => 'required|digits:9',
        'roles' => 'required|array|max:1'
    ];
    $message = [
        'required' => ':attribute es obligatorio.',
        'integer' => ':attribute no es un número de teléfono, ingrese nuevamente',
        'digits' => ':attribute inválido, debe ser :digits dígitos',
        'max' => ':attribute inválido, debe ser máximo :max',
        'unique' => ':attribute ya existe en la base de datos'
    ];
    $this->validate($request, $rules, $message);

    $data = $request->only('name', 'email', 'rut', 'telefono');
    $data['password'] = bcrypt($data['password']);

    $user = new User();
    $user->fill($data);
    $user->save();

    $user->assignRole($request->input('roles'));

    $notification = 'El usuario se creó correctamente.';

    return redirect()->route('funcionarios.index')->with(compact('notification'));
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
            'rut' => 'required|string|max:10',
            'email' => 'required|string',
            'telefono' => 'required|digits:9',
            'roles' => 'required|array|max:1'
        ];
        $messages = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un número de teléfono, ingrese nuevamente',
            'digits' => ':attribute inválido, debe ser :digits dígitos',
            'max' => ':attribute inválido, debe ser máximo :max',
            'unique' => ':attribute ya existe en la base de datos'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::Funcionario()->findOrFail($id);

        $data = $request->only('name', 'email', 'rut', 'telefono', 'password');
        $password = $request->input('password');

        if ($password) {
            $data['password'] = bcrypt($password);
        }

        $user->fill($data);
        $user->save();

        $user->syncRoles($request->input('roles'));

        //$user->notify(new UsuarioModificacionRoles($user->id));

        $notification = 'La informacion se actualizó correctamente.';

        return redirect()->route('funcionarios.index')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionarios = User::Funcionario()->findOrFail($id);
        $correo = new UsuarioEliminadoNotificacionUsuario;
        Mail::to($funcionarios->email)->send($correo);
        $funcionarios->delete();
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new GeneralNotificationForUsers('Usuario Eliminado', 'El Administrador ' . auth()->user()->name . ' ha eliminado el usuario ' . $funcionarios->name . ' - ' . $funcionarios->rut . ' del sistema.', route('funcionarios.index')));
        }
        return response()->json(['success' => true], 200);
    }
}
