<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function index2()
    {
        // $configuracion = Configuracion::all();
        // return view('pagina', ['configuracion' => $configuracion]);
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
