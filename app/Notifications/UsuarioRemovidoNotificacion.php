<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsuarioRemovidoNotificacion extends Notification
{
    use Queueable;
    public $deletedUser;
    public $adminName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deletedUser, $adminName)
    {
        $this->deletedUser = $deletedUser;
        $this->adminName = $adminName;
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
            'title'=>'Usuario Eliminado',
            'message'=>'El Administrador '.$this->adminName.' ha eliminado el usuario '.$this->deletedUser->name.' - '.$this->deletedUser->rut.' del sistema.',
            'user_id'=>$this->deletedUser->id,
            'user_correo'=>$this->deletedUser->email,
            'user_nombre'=>$this->deletedUser->name,
            'user_rut'=>$this->deletedUser->rut,
        ];
    }
}
