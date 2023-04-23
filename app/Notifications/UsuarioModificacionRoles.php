<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsuarioModificacionRoles extends Notification
{
    use Queueable;
    public $user;
    public $mensaje;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $mensaje)
    {
        $this->user = $user;
        $this->mensaje = $mensaje;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title'=>'Modificación de Roles a un Usuario',
            'message'=>$this->mensaje,
            'user_id'=>$this->user->id,
            'user_correo'=>$this->user->email,
            'user_nombre'=>$this->user->name,
            'user_rut'=>$this->user->rut,
        ];
    }
}
