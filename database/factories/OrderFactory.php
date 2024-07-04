<?php

namespace Database\Factories;

use App\Models\DeliveryFee;
use App\Models\Order;
use App\Models\User;
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
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'delivery_fee_id' => $this->faker->randomElement(DeliveryFee::pluck('id')->toArray()),
            'total' => $this->faker->randomNumber(5),
            'status' => $this->faker->randomElement(['pending', 'delivered', 'canceled']),
            'created_at' => $this->faker->dateTimeThisYear(),
            'delivered_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
