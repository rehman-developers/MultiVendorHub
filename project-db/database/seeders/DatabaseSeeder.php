<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // post::factory(10)->create();
        $this->call([
            StudentSeeder::class,
        ]);
    }
}
// User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);