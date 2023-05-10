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

        // return view('welcome');
    }

    public function edit()
    {
        
    }

    public function modify_landingpage_ubication()
    {
        return view('landingpage.ubication.modify');
    }

    public function modify_landingpage_aboutUs()
    {
        return view('landingpage.aboutUs.modify');
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
