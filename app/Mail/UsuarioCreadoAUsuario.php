<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioCreadoAUsuario extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $roles;
    public $nombre;
    public $correo;
    public $telefono;
    public $rut;
    public function __construct($roles, $nombre, $rut, $telefono, $correo)
    {
        $this->roles = $roles;
        $this->telefono = $telefono;
        $this->rut = $rut;
        $this->correo = $correo;
        $this->nombre = $nombre;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Se ha creado un nuevo usuario para ti')->view('emails.usuario_creado')->with([
            'correo'=>$this->correo,
            'telefono'=>$this->telefono,
            'rut'=>$this->rut,
            'nombre'=>$this->nombre,
            'roles'=>$this->roles,
    ]);
    }
}
