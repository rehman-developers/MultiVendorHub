<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call all seeders in correct order
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

    }
}