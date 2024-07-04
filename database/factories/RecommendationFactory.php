<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recommendation>
 */
class RecommendationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomElement(\App\Models\Product::pluck('id')->toArray()),
            'recommended_product_id' => $this->faker->randomElement(\App\Models\Product::pluck('id')->toArray()),
        ];
    }
}
