<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->randomNumber(4),
            'street' => fake()->streetName(),
            'postal_code' => fake()->postcode(),
            'town' => fake()->city(),
            'country' => fake()->country(),
            'user_id' => fake()->randomElement(User::pluck('id')->toArray())
        ];
    }
}
