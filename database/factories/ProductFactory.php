<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this-> faker->name(),
            'description' => $this->faker->text(),
            'weight' => $this->faker->randomNumber(),
            'stock' => $this->faker->randomNumber(),
            'TTC_price' => $this->faker->randomFloat(2,0,1000),
            'HT_price' => $this->faker->randomFloat(2,0,1000),
            'VAT' => $this->faker->randomFloat(2,0,100),
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),

        ];
    }
}
