<?php

namespace App\Mail;

use App\Models\ReservarCitas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelarHora extends Mailable
{
    use Queueable, SerializesModels;

    public $ReservarCita;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ReservarCitas $ReservarCita)
    {
        $this->ReservarCita = $ReservarCita;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Hora Cancelada')->view('emails.cancel_horas');
    }
}
