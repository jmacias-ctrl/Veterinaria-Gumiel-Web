<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin');
        } else if ($user->hasRole('Veterinario')) {
            
            return redirect()->route('veterinaria');
        }else if ($user->hasRole('Peluquero')) {
            
            return redirect()->route('peluquero');
        }else if ($user->hasRole('Inventario')) {
            
            return redirect()->route('inventario');
        }

        return redirect()->route('inicio');
        //return property_exists($this, 'redirectTo') ? $this->redirectTo : 'admin/';

    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
