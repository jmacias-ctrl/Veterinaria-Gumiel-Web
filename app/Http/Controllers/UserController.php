<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->nombre_rol = $user->getRoleNames();
            if(!isset($user->phone)){
                $user->phone = "No Definido";
            }
        }
        return view('admin.usuarios.usuarios', compact('users'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
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
    public function index_roles(){
        $roles = Role::all();

        return view('admin.roles.roles', compact('roles'));
    }

    public function add_rol(){
        return view('admin.roles.create_role');
    }

    public function store_rol(Request $request){
        $role = Role::create(['name'=>$request->nombre]);

        return redirect()->route('admin.roles.index');
    }

    public function delete_rol(Request $request){
        $rol = Role::find($request->id);
        $rol->delete();
        return response()->json(['success' => true], 200);
    }

    public function update_rol(){
        
    }

    public function modify_rol(){

    }

    public function store_user(Request $request)
    {
        try {
            db::beginTransaction();
            $user = new User;
            $name = $request->nombre . " " . $request->apellido;
            $rut = $request->rut;
            $rut_password = substr($request->rut, 0, 8);

            $user->name = $name;
            $user->rut = $rut;
            $user->email = $request->email;
            $user->password = $rut_password;
            $user->phone = $request->telefono;
            $user->save();
            db::commit();

            $user->assignRole($request->roles);

            return redirect()->route('admin.usuarios.index')->with('success', 'El Usuario'.$user->name.'ha sido almacenado de manera satisfactoria');
        } catch (QueryException $exception) {
            DB::rollBack();
            return back()->withInput();
        }

        
    }
    public function update_roles(Request $request)
    {
        $user = User::find($request->id);
        $user->syncRoles($request->roles);
        return redirect()->route('admin.usuarios.index');
    }
}
