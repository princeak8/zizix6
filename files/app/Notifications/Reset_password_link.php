<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Reset_password_link extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {

        return [
            'title' => 'Password Reset',
            'Message' => 'Link to reset your password has been sent to you',
            'User' => $this->user
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*return (new MailMessage)
                    ->subject('PASSWORD RESET LINK')
                    ->greeting('Hello!')
                    ->line('You are receiving this message because you want to reset/chnge your password.')
                    ->line('Click on the Link Below to change your password')
                    ->action('CHANGE PASSWORD', url('/admin/change_password/'.$this->token->token))
                    ->line('THIS LINK CAN ONLY BE USED ONCE')
                    ->line('Thank you!');
        */
        return (new MailMessage)
                    ->subject('PASSWORD RESET LINK')
                    ->markdown('emails.password_reset',['token'=>$this->token]);

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
