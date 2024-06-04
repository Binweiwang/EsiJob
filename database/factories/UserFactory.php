<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), // default password
            'avatar_url' => fake()->imageUrl(),
            'name_company' => fake()->company(),
            'phone' => fake()->phoneNumber(),
            'description' => fake()->sentence(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'is_active' => fake()->boolean(),
            'role' => 'user', // default role
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
