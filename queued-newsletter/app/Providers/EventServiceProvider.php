<?php
// app/Providers/EventServiceProvider.php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // \App\Events\SubscriberSubscribed::class => [
        //     \App\Listeners\SendWelcomeNotification::class,
        // ],
    ];

    public function boot(): void
    {
        //
    }
}