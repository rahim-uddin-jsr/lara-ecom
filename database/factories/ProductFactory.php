<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
        $name = fake()->sentence();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(20),
            'price' => fake()->randomFloat(2, 10, 1000), // Random price between 10 and 1000 with 2 decimal places
            'sku' => fake()->unique()->regexify('[A-Z0-9]{10}'), // Generates a unique SKU with 10 uppercase letters and digits
            'brand' => fake()->word,
            'quantity' => fake()->randomDigitNotZero(),
            'availability' => fake()->boolean(90), // 90% chance of availability being true
            'category_id' => function () {
                return \App\Models\Category::inRandomOrder()->first()->id;
            }
        ];
    }
}
