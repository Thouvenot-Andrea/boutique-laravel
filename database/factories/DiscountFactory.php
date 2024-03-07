<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $name = $this->faker->unique()->word,
            'slug' => Str::of($name)->slug('-'),
            'code' => '#'. $this->faker->unique()->word . "2024",
            'amount' => $this->faker->randomNumber(4),
            'ended_at' => $this->faker->dateTimeThisYear('+3 weeks')
        ];
    }
}
