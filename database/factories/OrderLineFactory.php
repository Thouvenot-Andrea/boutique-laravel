<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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

            'name' => $name = $this->faker->name(),
            'slug' => Str::of($name)->slug('-'),
            'price' => $this->faker->randomNumber(5),
            'quantity' => $this->faker->randomNumber(),
            'delivered_at' => $this->faker->dateTimeThisYear(),
            'order_id' => $this->faker->randomElement(Order::pluck('id')->toArray()),

        ];
    }
}
