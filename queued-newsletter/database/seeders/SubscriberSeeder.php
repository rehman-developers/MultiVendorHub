<?php
// database/seeders/SubscriberSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscriber;

class SubscriberSeeder extends Seeder
{
    public function run(): void
    {
        Subscriber::factory(10)->create();
    }
}