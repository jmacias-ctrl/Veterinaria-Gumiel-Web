<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $checkUser = User::where('email', '=', $data['email'])->first();
        if (isset($checkUser) && $checkUser->hasRole('Invitado')) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'rut' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        } else {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'rut' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $checkUser = User::where('email', '=', $data['email'])->first();
        if (isset($checkUser) && $checkUser->hasRole('Invitado')) {
            $checkUser->name = $data['name'];
            $checkUser->rut = $data['rut'];
            $checkUser->password = Hash::make($data['password']);
            $checkUser->save();
            $checkUser->syncRoles(['Cliente']);
            return $checkUser;
        } else {
            dd("test");
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'rut' => $data['rut'],
                'password' => Hash::make($data['password']),
            ])->assignRole('Cliente');
        }
    }
}
