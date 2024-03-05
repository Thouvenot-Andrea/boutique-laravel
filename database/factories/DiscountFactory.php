<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'code' => '#'. $this->faker->unique()->word . "2024",
            'amount' => $this->faker->randomFloat(2,0,100),
            'ended_at' => $this->faker->dateTimeThisYear('+3 weeks')
        ];
    }
}
