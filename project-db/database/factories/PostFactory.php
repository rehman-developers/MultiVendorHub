<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'email'=> fake()->email(),
            'age'=> fake()->numberBetween(20,25),
            'address'=> fake()->address(),
            'city'=> fake()->city(),
            'phone'=> fake()->phoneNumber(),
            'password'=> fake()->password()
        ];
    }
}
