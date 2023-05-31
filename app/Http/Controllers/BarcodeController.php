<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zxing\QrReader;

class BarcodeController extends Controller
{
    public function scan(Request $request)
    {
        // Verificar si se ha enviado una imagen
        if ($request->hasFile('barcode')) {
            // Obtener la ruta temporal del archivo
            $path = $request->file('barcode')->getRealPath();

            // Leer el código de barras utilizando la biblioteca ZXing
            $qrcode = new QrReader($path);
            $text = $qrcode->text();

            // Retornar la información del código de barras
            return response()->json([
                'text' => $text
            ]);
        }

        // Retornar una respuesta de error si no se ha enviado una imagen
        return response()->json([
            'error' => 'No se ha proporcionado ninguna imagen'
        ], 400);
    }
}
