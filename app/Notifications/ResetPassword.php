<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    use Queueable;

    public $token;
    public $fullName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $fullName)
    {
        $this->token = $token;
        $this->fullName = $fullName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Ayuda para recuperar tu contraseña')
            ->greeting('Hola ' . $this->fullName . ',')
            ->line('Hemos recibido una solicitud para cambio de contraseña.')
            ->action('Cambiar Contraseña', url('password/reset', $this->token))
            ->line('Si no realizaste esta solicitud, ignora este correo.')
            ->line('Si tienes dudas, por favor, contacta al Archivo Diocesano de Alajuela: 2433-6005 o al whatsapp: 6106-0262');
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
            //
        ];
    }
}
