<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Mail\UsuarioCreadoAUsuario;
use App\Mail\UsuarioEliminadoNotificacionUsuario;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NuevoUsuarioNotificacion;
use App\Notifications\UsuarioRemovidoNotificacion;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->nombre_rol = $user->getRoleNames();
            if (!isset($user->phone)) {
                $user->phone = "No Definido";
            }
        }
        return view('admin.usuarios.usuarios', compact('users'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $correo = new UsuarioEliminadoNotificacionUsuario;
        Mail::to($user->email)->send($correo);
        $user->delete();
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new UsuarioRemovidoNotificacion($user, auth()->user()->name));
        }
        return response()->json(['success' => true], 200);
    }
    
    public function modify_roles($id)
    {
        $user = User::find($id);
        $user->nombre_roles = $user->getRoleNames();
        $roles = Role::whereNotIn('name', $user->nombre_roles)->get();
        return view('admin.usuarios.modify_roles', compact('user', 'roles'));
    }
    public function add_user()
    {
        $roles = Role::all();
        return view('admin.usuarios.create_usuario', compact('roles'));
    }
    public function index_roles()
    {
        $roles = Role::where('name', '!=', 'Admin')->get();

        return view('admin.roles.roles', compact('roles'));
    }

    public function add_rol()
    {
        return view('admin.roles.create_role');
    }

    public function store_rol(Request $request)
    {
        $rules = [
            'nombre' => 'required',
        ];
        $attributes = [
            'nombre' => 'Nombre',
        ];
        $message = [
            'required' => ':attribute es obligatorio.'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            $role = Role::create(['name' => $request->nombre]);

            return redirect()->route('admin.roles.index')->with('success', 'El rol ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }

        return back()->withErrors($validator)->withInput();
    }

    public function delete_rol(Request $request)
    {
        $rol = Role::find($request->id);
        $rol->delete();

        return response()->json(['success' => true], 200);
    }

    public function update_rol(Request $request)
    {
        $rol = Role::find($request->id);
        $rol->name = $request->nombre;
        $rol->save();
        return redirect()->route('admin.roles.index')->with('success', 'El rol ' . $request->nombre . ' fue modificado de manera satisfactoria');
    }

    public function modify_rol($id)
    {
        $rol = Role::find($id);
        return view('admin.roles.modify_role', compact('rol'));
    }

    public function store_user(Request $request)
    {
        $rules = [
            'nombre' => 'required|string',
            'apellido'  => 'required|string',
            'rut'  => 'required|string|max:10',
            'email'  => 'required|string',
            'telefono' => 'required|digits:9',
            'roles' => 'required|array|min:1'
        ];
        $attributes = [
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'rut' => 'Rut',
            'email' => 'Correo',
            'telefono' => 'Teléfono',
        ];
        $message = [
            'required' => ':attribute es obligatorio.',
            'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
            'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
            'max' => ':attribute invalido, debe ser máximo :max'
        ];
        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            try {
                db::beginTransaction();
                $user = new User;
                $name = $request->nombre . " " . $request->apellido;
                $rut = $request->rut;
                $rut_password = substr($request->rut, 0, 8);

                $user->name = $name;
                $user->rut = $rut;
                $user->email = $request->email;
                $user->password = bcrypt($rut_password);
                $user->phone = $request->telefono;
                $user->save();
                db::commit();
                $user->assignRole($request->roles);
                $admins = User::role('Admin')->get();

                $roleText = "";
                foreach ($request->roles as $role) {
                    $roleText .= $role;
                }
                foreach ($admins as $admin) {
                    $admin->notify(new NuevoUsuarioNotificacion($user, auth()->user()->name, $roleText));
                }

                $correo = new UsuarioCreadoAUsuario($request->roles, $name, $rut, $request->telefono, $request->email);
                Mail::to($request->email)->send($correo);
                return redirect()->route('admin.usuarios.index')->with('success', 'El Usuario ' . $user->name . ' fue agregado de manera satisfactoria');
            } catch (QueryException $exception) {
                DB::rollBack();
                return back()->withInput();
            }
        }
        return back()->withErrors($validator)->withInput();
    }
    public function update_roles(Request $request)
    {
        $user = User::find($request->id);
        $user->syncRoles($request->roles);
        return redirect()->route('admin.usuarios.index')->with('success', 'Se ha modificados los roles para el usuario ' . $user->name);
    }

    public function get_notifications()
    {
        $userNotifications = auth()->user()->notifications;
        return view('users.index_notification', compact('userNotifications'));
    }
    public function delete_notification(Request $request){
        $notification = db::table('notifications')->where('id', '=', $request->id)->delete();
        return redirect()->route('users.notification.index')->with('success', 'Se ha eliminado la notificación');
    }
}
