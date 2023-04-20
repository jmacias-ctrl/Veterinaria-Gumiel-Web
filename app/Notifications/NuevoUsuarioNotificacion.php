<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevoUsuarioNotificacion extends Notification
{
    use Queueable;

    public $newUser;
    public $adminName;
    public $roleText;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newUser, $adminName, $roleText)
    {
        $this->newUser = $newUser;
        $this->adminName = $adminName;
        $this->roleText = $roleText;
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
            'title'=>'Usuario Nuevo',
            'message'=>'El Administrador '.$this->adminName.' ha creado un nuevo usuario: '.$this->newUser->name.' - '.$this->newUser->rut.'- Rol: '.$this->roleText.'.',
            'user_id'=>$this->newUser->id,
            'user_correo'=>$this->newUser->email,
            'user_nombre'=>$this->newUser->name,
            'user_rut'=>$this->newUser->rut,
        ];
    }
}
