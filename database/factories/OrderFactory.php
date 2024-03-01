<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'delivery_fees_id' => $this->faker->numberBetween(1, 10),
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'status' => $this->faker->randomElement(['pending', 'delivered', 'canceled']),
            'created_at' => $this->faker->dateTimeThisYear(),
            'delivered_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
