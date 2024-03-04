<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->randomElement(Product::pluck('id')->toArray()),
            'content'=> fake()->text(),
            'rating'=>fake()->numberBetween(0,5),
            'users_id'=>fake()->randomElement(Product::pluck('id')->toArray()),
        ];
    }
}
