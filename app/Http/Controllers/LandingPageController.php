<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $landingMaps = \App\Models\whereYouCanFind::first();
        return view('landingpage.ubication.modify', ['landingMaps' => $landingMaps]);
    }

    public function modify_landingpage_aboutUs()
    {
        $landingMaps = \App\Models\whereYouCanFind::first();
        return view('landingpage.aboutUs.modify', ['landingMaps' => $landingMaps]);
    }

    public function update_landingpage_ubication(Request $request)
    {
        $validator = Validator::make($request->all(), whereyoucanfind::$rules, $message, $attributes);
        if ($validator->passes()) {
            
            try {
                $user = User::find($request->id);
                $user->rut = ($request->rut);
                $user->email = $request->email;
                $user->phone = $request->telefono;
                $user->name = $request->name;
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

    public function store(Request $request) // procesar el formulario y enviar el correo electronico
    {
        // $to = "kcampos@ing.ucsc.cl";
        // $subject = "Correo de prueba";
        // $message = "Este es un mensaje de prueba enviado con PHP";
        // $headers = "From: remitente@example.com";

        $to = "kcampos@ing.ucsc.cl";
        $subject = "Correo de contacto - " . $request->name . " - " . $request->phone;
        $message = $request->message;
        $headers = "From: " . $request->email;

        try{
            if (mail($to, $subject, $message, $headers)) {
                return "Mensaje enviado";
            } else {
                return "Error al enviar el mensaje";
            }
        }catch(Exception $e){
            return $subject . "Error al enviar el mensaje \n" . $e->getMessage();
        }
        
    }
}
