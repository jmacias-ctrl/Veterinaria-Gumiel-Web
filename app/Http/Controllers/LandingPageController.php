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
use App\Models\whereyoucanfind;
use App\Models\landingpage_config;
use Exception;

class LandingPageController extends Controller
{
    public function index()
    {
        $landingMaps = \App\Models\whereYouCanFind::first();
        return view('welcome', ['landingMaps' => $landingMaps]);
    }

    public function modify_landingpage_ubication()
    {
        // $landingMaps = \App\Models\whereYouCanFind::first();

        // return view('landingpage.ubication.modify', ['landingMaps' => $landingMaps]);

        $landingMaps = \App\Models\whereYouCanFind::first();
        $landingpageconfig = \App\Models\landingpage_config::first();

        $data = [
            'landingMaps' => $landingMaps,
            'landingpage_config' => $landingpageconfig
        ];

        return view('landingpage.ubication.modify', $data);
    }

    // public function modify_landingpage_aboutUs()
    // {
    //     $landingMaps = \App\Models\whereYouCanFind::first();
    //     return view('landingpage.aboutUs.modify', ['landingMaps' => $landingMaps]);
    // }

    public function update_landingpage_ubication(Request $request)
    {
        
        $rules = (new \App\Models\WhereYouCanFind())->rules;
        // dd($rules);
        $attributes = (new \App\Models\WhereYouCanFind())->attributes;
        $message = (new \App\Models\WhereYouCanFind())->message;

        $validator = Validator::make($request->all(), $rules, $message, $attributes);

        if ($validator->passes()) {
            
            try {
                $landingMaps = whereyoucanfind::find(1);
                $landingMaps->direccion = $request->direccion;
                $landingMaps->telefono = $request->telefono;
                $landingMaps->horarios = $request->horarios;
                $landingMaps->whatsapp = $request->whatsapp;
                $landingMaps->facebook = $request->facebook;
                $landingMaps->instagram = $request->instagram;
                $landingMaps->save();
                db::commit();
                return redirect()->route('landing.ubication.edit')->with('success', 'Tus datos fueron modificado exitosamente');
            } catch (QueryException $exception) {
                DB::rollBack();
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return back()->withInput();
            }

        }
        return back()->withErrors($validator)->withInput();
    }

    public function update_landingpage(Request $request)
    {
        
        $rules = (new \App\Models\landingpage_config())->rules;
        $attributes = (new \App\Models\landingpage_config())->attributes;
        $message = (new \App\Models\landingpage_config())->message;

        $validator = Validator::make($request->all(), $rules, $message, $attributes);

        if ($validator->passes()) {
            
            try {
                $landingMaps = landingpage_config::find(1);
                $landingMaps->aboutUs = $request->aboutUs;
                $landingMaps->save();
                db::commit();
                return redirect()->route('landing.ubication.edit')->with('success', 'Tus datos fueron modificado exitosamente');
            } catch (QueryException $exception) {
                DB::rollBack();
                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return back()->withInput();
            }

        }
        return back()->withErrors($validator)->withInput();
    }

    // public function store(Request $request) // procesar el formulario y enviar el correo electronico
    // {
    //     // $to = "kcampos@ing.ucsc.cl";
    //     // $subject = "Correo de prueba";
    //     // $message = "Este es un mensaje de prueba enviado con PHP";
    //     // $headers = "From: remitente@example.com";

    //     $to = "kcampos@ing.ucsc.cl";
    //     $subject = "Correo de contacto - " . $request->name . " - " . $request->phone;
    //     $message = $request->message;
    //     $headers = "From: " . $request->email;

    //     try{
    //         if (mail($to, $subject, $message, $headers)) {
    //             return "Mensaje enviado";
    //         } else {
    //             return "Error al enviar el mensaje";
    //         }
    //     }catch(Exception $e){
    //         return $subject . "Error al enviar el mensaje \n" . $e->getMessage();
    //     }
        
    // }
}
