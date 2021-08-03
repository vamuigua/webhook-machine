<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewFeedbackSent extends Notification implements ShouldQueue
{
    use Queueable;

    public $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject('New Feedback Form from ZALEGO')
            ->greeting('Hello! ' . $notifiable->name)
            ->line('You have a New Feedback Form!')
            ->action('Fill Feedback Form', url($this->link))
            ->line('Thank you for using choosing ZALEGO!');
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
            'subject' => 'You have a New Feedback Form!',
            'link' => $this->link,
            'type' => 'feedback-sent',
            'user' => $notifiable
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'subject' => 'You have a New Feedback Form!',
            'link' => $this->link,
            'type' => 'feedback-sent',
            'user' => $notifiable
        ]);
    }
}
