<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLine>
 */
class OrderLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(5),
            'quantity' => $this->faker->randomNumber(),
            'delivered_at' => $this->faker->dateTimeThisYear(),
            'order_id' => $this->faker->randomElement(Order::pluck('id')->toArray()),

        ];
    }
}
