<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotificationForUsers extends Notification
{
    use Queueable;
    public $type;
    public $title;
    public $message;
    public $route;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $message, $route)
    {
        $this->title = $title;
        $this->message = $message;
        $this->route = $route;
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
            'type' => $this->type,
            'title' => $this->title,
            'message' => $this->message,
            'route' => $this->route,
        ];
    }
}
