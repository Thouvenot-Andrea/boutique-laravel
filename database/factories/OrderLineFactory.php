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
            'productref' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2,0,1000),
            'quantity' => $this->faker->randomNumber(),
            'delivered_at' => $this->faker->dateTimeThisYear(),
            'order_id' => $this->faker->randomElement(Order::pluck('id')->toArray()),

        ];
    }
}
