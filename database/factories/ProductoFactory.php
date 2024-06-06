<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 1, 1000), // precio entre 1 y 1000
            'imagen' => $this->faker->imageUrl(640, 480, 'product', true), // URL de imagen aleatoria
            'creditos' => $this->faker->numberBetween(1, 100), // entre 1 y 100
        ];
    }
}
