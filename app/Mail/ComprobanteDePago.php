<?php

namespace App\Mail;

// use App\Models\ReservarCitas;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComprobanteDePago extends Mailable
{
    use Queueable, SerializesModels;

    public $response;
    public $cartCollection;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->response = $data['response'];
        $this->cartCollection = $data['cartCollection'];
        $this->user = $data['user'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Comprobante de pago')->view('emails.comprobante_pago')->with('response', $this->response)->with('cartCollection', $this->cartCollection)->with('user', $this->user);
    }
}
