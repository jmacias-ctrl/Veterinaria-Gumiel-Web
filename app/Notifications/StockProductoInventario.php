<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockProductoInventario extends Notification
{
    use Queueable;
    private $producto;
    private $zeroStock;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($producto, $zeroStock)
    {
        $this->producto = $producto;
        $this->zeroStock = $zeroStock;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if($this->zeroStock==true){
            return [
                'title'=>'Alerta: Producto '.$this->producto->nombre.' sin stock',
                'message'=>'El producto "'.$this->producto->nombre.'" se encuentra sin stock.',
            ];
        }else{
            return [
                'title'=>'Alerta: Producto '.$this->producto->nombre.' en stock bajo',
                'message'=>'El producto "'.$this->producto->nombre.'" se encuentra con un bajo stock.',
            ];
        }
        
    }
}
