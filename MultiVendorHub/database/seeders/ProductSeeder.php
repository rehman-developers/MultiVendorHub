<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Take ALL sellers who have a store
        $sellers = User::where('role', 2)
            ->whereHas('store')
            ->with('store')
            ->get();

        if ($sellers->isEmpty()) {
            $this->command->warn('No sellers with store found. Register a seller and create store first.');
            return;
        }

        // Get category ID map
        $categories = Category::pluck('id', 'name')->toArray();

        foreach ($sellers as $seller) {
            $store = $seller->store;

            foreach ($categories as $name => $catId) {
                for ($i = 0; $i < 5; $i++) {
                    $imageUrl = "https://loremflickr.com/640/480/" . strtolower($name) . "?random=" . $faker->numberBetween(1, 9999);

                    Product::create([
                        'store_id' => $store->id,
                        'category_id' => $catId,
                        'name' => ucfirst($faker->word) . ' ' . $name,
                        'description' => $faker->sentence(10),
                        'price' => $faker->randomFloat(2, 10, 1000),
                        'stock' => $faker->numberBetween(1, 100),
                        'image' => $imageUrl,
                        'is_active' => true,
                    ]);
                }
            }

            $this->command->info("Added 25 products to {$seller->name}'s store.");
        }
    }
}