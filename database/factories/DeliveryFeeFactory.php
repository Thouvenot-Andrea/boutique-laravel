<?php

namespace Database\Factories;

use App\Models\DeliveryFee;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->unique()->name,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'min_weight' => $this->faker->randomFloat(2, 1, 10),
        ];
    }
}
