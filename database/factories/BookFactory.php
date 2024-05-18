<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currentDate = new DateTime();
        $currentYear = $currentDate->format('Y');
        $startDate = new DateTime('2000-01-01');
        $endDate = new DateTime("$currentYear-12-31");


        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'pages' => fake()->numberBetween(50, 1000),
            'is_published' => fake()->boolean(),
            'user_id' => function () {
                return \App\Models\User::inRandomOrder()->first()->id;
            },
            'published_at' => fake()->dateTimeBetween($startDate, $endDate),
            'price' => fake()->randomFloat(2, 5, 100),


            ];

    }
}
