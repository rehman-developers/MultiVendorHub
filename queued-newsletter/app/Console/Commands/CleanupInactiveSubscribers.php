<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Subscriber;

class CleanupInactiveSubscribers extends Command
{
    protected $signature = 'subscribers:cleanup';

    protected $description = 'Cleanup inactive subscribers older than 30 days';

    public function handle()
    {
        $deleted = Subscriber::where('status', 'inactive')
            ->where('created_at', '<', now()->subDays(30))
            ->delete();

        $this->info('Cleaned up ' . $deleted . ' inactive subscribers!');
    }
}