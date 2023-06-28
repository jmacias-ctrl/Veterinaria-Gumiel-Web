<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

class ComprobanteController extends Controller
{
    public function generarComprobante($id)
    {
        $data = [];
        // $html = view('pdf.comprobante-pago', compact('data'))->render();

        $html = "<p>Comprobante N{$id}</p>";
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);
        $dompdf->render();

        $dompdf->stream('comprobante-pago.pdf');

        return response()->make($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="comprobante-pago.pdf"',
        ]);
    }
}
