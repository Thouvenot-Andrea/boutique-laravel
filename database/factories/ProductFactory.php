<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Illuminate\Support\Str;

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
            'picture'=> $this->faker->imageUrl,
            'name' => $name = $this-> faker->name(),
            'slug' => Str::of($name)->slug(),
            'description' => $this->faker->text(),
            'weight' => $this->faker->randomNumber(),
            'stock' => $this->faker->randomNumber(),
            'TTC_price' => $this->faker->randomNumber(5,),
            'HT_price' => $this->faker->randomNumber(5,),
            'VAT' => $this->faker->randomNumber(4),
            'category_id' => $this->faker->randomElement(Category::pluck('id')->toArray()),

        ];
    }
}
