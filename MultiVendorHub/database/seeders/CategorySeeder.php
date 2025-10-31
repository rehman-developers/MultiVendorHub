<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $names = ['Electronics', 'Clothing', 'Books', 'Furniture', 'Food'];

        foreach ($names as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['description' => $faker->sentence(5)]
            );
        }
    }
}