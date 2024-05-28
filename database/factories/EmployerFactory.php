<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    private static string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail,
            'password' => static::$password ??= Hash::make('password'),
            'name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'name_company' => fake()->company,
            'phone' => fake()->phoneNumber,
            'description' => fake()->sentence,
            'address' => fake()->address,
            'city' => fake()->city,
            'state' => fake()->address,
            'is_active' => true, // or $this->faker->boolean
        ];
    }
}
