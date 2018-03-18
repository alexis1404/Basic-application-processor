<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendApplication extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $application;

    /**
     * Create a new notification instance.
     * @param object Application
     * @param object User
     * @return void
     */
    public function __construct($application, $user)
    {
        $this->user = $user;
        $this->application = $application;
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
            ->greeting('For manager')
            ->from('manager@mail.com', 'Manager')
            ->line('User <b>' . $this->user->name . '</b> created new application')
            ->line('Theme: ' . $this->application->theme)
            ->line('Text: ' . $this->application->message)
            ->action('Attachment', env('APP_URL') . '/storage/' . $this->application->attachment);
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
