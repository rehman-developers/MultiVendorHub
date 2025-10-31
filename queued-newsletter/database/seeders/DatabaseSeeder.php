<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 10 FAKE USERS
        User::factory(10)->create();

        // 10 FAKE SUBSCRIBERS
        Subscriber::factory(10)->create();
    }
}