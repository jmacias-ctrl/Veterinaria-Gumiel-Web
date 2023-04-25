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
use App\Http\Requests\PostRequest;
use App\Notifications\UsuarioRemovidoNotificacion;
use App\Notifications\UsuarioModificacionRoles;
use App\Notifications\GeneralNotificationForUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            foreach ($data as $user) {
                $user->nombre_rol = $user->getRoleNames();
                if (!isset($user->phone)) {
                    $user->phone = "No Definido";
                }
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.usuarios.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }
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
            $admin->notify(new GeneralNotificationForUsers('Usuario Eliminado', 'El Administrador ' . auth()->user()->name . ' ha eliminado el usuario ' . $user->name . ' - ' . $user->rut . ' del sistema.', route('admin.usuarios.index')));
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
        $roles = Role::where('name', '!=', 'Cliente')->get();
        return view('admin.usuarios.create_usuario', compact('roles'));
    }
    public function index_roles(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::where('name', '!=', 'Admin')->where('name','!=','Cliente')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'admin.roles.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.roles.roles');
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
            $admins = User::role('Admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new GeneralNotificationForUsers('Rol nuevo agregado', 'El Administrador ' . auth()->user()->name . ' ha agregado el rol: ' . $role->name . '.', route('admin.roles.index')));
            }
            return redirect()->route('admin.roles.index')->with('success', 'El rol ' . $request->nombre . ' fue agregado de manera satisfactoria');
        }

        return back()->withErrors($validator)->withInput();
    }
    public function get_notifications_count(Request $request)
    {
        $newCount = sizeof(auth()->user()->unreadNotifications);
        if ($request->lastNotificationCount < $newCount) {
            return response()->json(['newNotifications' => true, 'newCount' => $newCount, 'lastNotificationCount' => $request->lastNotificationCount]);
        } else {
            return response()->json(['newNotifications' => false, 'newCount' => $newCount, 'lastNotificationCount' => $request->lastNotificationCount]);
        }
    }
    public function delete_rol(Request $request)
    {
        $rol = Role::find($request->id);
        $rol->delete();
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new GeneralNotificationForUsers('Rol Eliminado', 'El Administrador ' . auth()->user()->name . ' ha eliminado el rol: ' . $rol->name . '.', route('admin.roles.index')));
        }
        return response()->json(['success' => true], 200);
    }

    public function update_rol(Request $request)
    {
        $rol = Role::find($request->id);
        $oldName = $rol->name;
        $rol->name = $request->nombre;
        $rol->save();
        $admins = User::role('Admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new GeneralNotificationForUsers('Rol Modificado', 'El Administrador ' . auth()->user()->name . ' ha modificado el rol: ' . $oldName . ' por ' . $rol->name . '.', route('admin.roles.index')));
        }
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
                    $admin->notify(new GeneralNotificationForUsers('Usuario Nuevo Agregado', 'El Administrador ' . auth()->user()->name . ' ha creado un nuevo usuario: ' . $user->name . ' - ' . $user->rut . '- Rol: ' . $roleText . '.', route('admin.usuarios.index')));
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
        $admins = User::role('Admin')->get();


        $mensajeRoles = "";
        for ($i = 0; $i < sizeof($request->roles); $i++) {
            if ($i == sizeof($request->roles) - 1) {
                $mensajeRoles .= $request->roles[$i];
            } else {
                $mensajeRoles .= $request->roles[$i] . ",";
            }
        }
        $mensajeAdmin = 'El Administrador ' . auth()->user()->name . ' ha modificado los roles del usuario ' . $user->name . ', nuevos roles: ' . $mensajeRoles;
        $mensajeUsuario = 'Te han cambiado los roles a los siguientes: ' . $mensajeRoles;
        foreach ($admins as $admin) {
            $admin->notify(new GeneralNotificationForUsers('Modificación de roles a un usuario', $mensajeAdmin, route('admin.usuarios.index')));
        }
        $user->notify(new UsuarioModificacionRoles($user, $mensajeUsuario));
        return redirect()->route('admin.usuarios.index')->with('success', 'Se ha modificados los roles para el usuario ' . $user->name);
    }

    public function get_notifications()
    {
        $userNotifications = auth()->user()->notifications;
        return view('users.index_notification', compact('userNotifications'));
    }
    public function delete_notification(Request $request)
    {
        $notification = db::table('notifications')->where('id', '=', $request->id)->delete();
        return redirect()->route('users.notification.index')->with('success', 'Se ha eliminado la notificación');
    }

    public function user_profile()
    {
        return view('users.perfil_usuario');
    }

    public function modify_user_profile()
    {
        return view('users.modify_perfil_usuario');
    }
    public function update_user_profile(Request $request)
    {

        if (isset($request->new_password_confirmation) || isset($request->new_password) || isset($request->old_password)) {
            $rules = [
                'name' => 'required|string',
                'rut'  => 'required|string|max:10',
                'email'  => 'required|string',
                'telefono' => 'required|digits:9',
                'image' => 'mimes:jpeg,png,jpg',
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ];
            $attributes = [
                'nombre' => 'Nombre',
                'apellido' => 'Apellido',
                'rut' => 'Rut',
                'email' => 'Correo',
                'telefono' => 'Teléfono',
                'image' => 'Imagen',
                'old_password' => 'Contraseña Actual',
                'new_password'=> 'Contraseña Nueva',
            ];
            $message = [
                'required' => ':attribute es obligatorio.',
                'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
                'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
                'max' => ':attribute invalido, debe ser máximo :max',
                'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg',
                'confirmed' => ':attribute no coinciden'
            ];
        } else {
            $rules = [
                'name' => 'required|string',
                'rut'  => 'required|string|max:10',
                'email'  => 'required|string',
                'telefono' => 'required|digits:9',
                'image' => 'mimes:jpeg,png,jpg'

            ];
            $attributes = [
                'nombre' => 'Nombre',
                'apellido' => 'Apellido',
                'rut' => 'Rut',
                'email' => 'Correo',
                'telefono' => 'Teléfono',
                'image' => 'Imagen'
            ];
            $message = [
                'required' => ':attribute es obligatorio.',
                'integer' => ':attribute no es un numero de teléfono, ingrese nuevamente',
                'digits' => ':attribute invalido, :attribute debe ser :digits dígitos',
                'max' => ':attribute invalido, debe ser máximo :max',
                'mimes' => ':attribute debe ser en archivo tipo .jpg, .png o .jpeg'
            ];
        }

        $validator = Validator::make($request->all(), $rules, $message, $attributes);
        if ($validator->passes()) {
            
            try {
                $user = User::find($request->id);
                $user->rut = ($request->rut);
                $user->email = $request->email;
                $user->phone = $request->telefono;
                $user->name = $request->name;
                if ($request->hasFile('image')) {
                    if (isset($user->image)) {
                        Storage::delete('public/' . $user->image);
                    }
                    $user->image = $request->file('image')->store('uploads', 'public');
                }

                if(isset($request->new_password_confirmation) || isset($request->new_password) || isset($request->old_password)){
                    if(!Hash::check($request->old_password, auth()->user()->password)){
                        return back()->with("error", "Contraseña actual no coincide");
                    }
                    $user->password = Hash::make($request->new_password);
                }
                $user->save();
                db::commit();
                return redirect()->route('user.profile.index')->with('success', 'Tus datos fueron modificado exitosamente');
            } catch (QueryException $exception) {
                DB::rollBack();
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return back()->withInput();
            }
        }
        return back()->withErrors($validator)->withInput();
    }

    public function modify_permissions_role($id){
        $role = Role::find($id);
        $permissions = $role->permissions->pluck('name');
        return view('admin.roles.modifiy_role_permissions', compact('role','permissions'));
    }

    public function update_permissions_role(Request $request){
        $role = Role::find($request->id);
        $role->syncPermissions($request->permisos);
        $role->givePermissionTo('acceder panel');
        return redirect()->route('admin.roles.index')->with('success', 'Se ha agregado permisos al rol '.$role->name);
    }
}
