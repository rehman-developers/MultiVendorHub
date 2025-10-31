<?php
// app/Notifications/WelcomeNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public $subscriber;

    public function __construct($subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Welcome to our newsletter, ' . $this->subscriber->name . '!')
            ->action('View Dashboard', url('/dashboard'))
            ->line('Thank you for subscribing!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Welcome ' . $this->subscriber->name,
        ];
    }
}