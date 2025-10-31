<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    public function boot(): void
    {
        parent::boot();
    }

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('subscribers:cleanup')->daily();
        // $schedule->call(function () {
        //     Cache::forget('subscriber_stats');
        // })->hourly();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}