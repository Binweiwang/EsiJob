<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'employer_id'=>fake()->randomDigit(),
            'title'=>fake()->sentence(),
            'requirements'=>fake()->sentence(),
            'description'=>fake()->sentence(),
            'salary'=>fake()->randomDigit(),
            'publication_date'=>now(),
            'state'=>fake()->randomElement(['active','inactive']),
        ];
    }
}
