<?php

namespace Database\Factories;

use App\Models\DeliveryFee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<DeliveryFee>
 */
class DeliveryFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->unique()->name,
            'slug' => Str::of($name)->slug('-'),
            'price' => $this->faker->randomNumber(4),
            'min_weight' => $this->faker->randomFloat(2, 1, 10),
        ];
    }
}
