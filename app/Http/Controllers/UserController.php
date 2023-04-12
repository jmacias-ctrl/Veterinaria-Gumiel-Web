<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
            ->orderBy('id', 'asc')
            ->select('id', 'name', 'email', 'rut', 'id_rol')
            ->get();

        return view('admin.usuarios.usuarios', compact('users'));
    }

    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json(['success' => true], 200);
    }
}
