<?php

namespace App\Listeners;

use App\Events\SubscriberSubscribed;
use App\Notifications\WelcomeNotification;

class SendWelcomeNotification
{
    public function handle(SubscriberSubscribed $event)
    {
        $event->subscriber->notify(new WelcomeNotification($event->subscriber));
    }
}