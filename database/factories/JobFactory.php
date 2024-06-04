<?php

namespace Database\Factories;

use App\Models\Employer;
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
            'user_id' => fake()->numberBetween(1,10),
            'title' => fake()->sentence(),
            'requirements' => fake()->sentence(),
            'description' => fake()->sentence(),
            'salary' => fake()->randomDigit(),
            'publication_date' => now(),
            'state' => fake()->randomElement(['active', 'inactive']),
            'location' => fake()->randomElement([
                'Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas',
                'Bilbao', 'Alicante', 'Córdoba', 'Valladolid', 'Vigo', 'Gijón', 'Hospitalet', 'Vitoria', 'A Coruña',
                'Granada', 'Elche', 'Oviedo', 'Badalona', 'Cartagena', 'Terrassa', 'Jerez', 'Sabadell', 'Móstoles',
                'Santa Cruz de Tenerife', 'Pamplona', 'Almería', 'San Sebastián', 'Burgos', 'Santander', 'Castellón',
                'Alcorcón', 'Albacete', 'Getafe', 'Salamanca', 'Logroño', 'San Cristóbal de La Laguna', 'Huelva',
                'Marbella', 'Badajoz', 'Lleida', 'Tarragona', 'León', 'Cádiz', 'Jaén'
            ]),
            'workday' => fake()->randomElement(['full-time', 'part-time', 'remote']),
        ];
    }
}
