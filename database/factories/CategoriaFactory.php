<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categorias = [
            'Comida',
            'Tecnología',
            'Salud',
            'Ropa',
            'Servicios',
            'Belleza',
            'Automotriz',
            'Educación'
        ];

        return [
            'nombre_categoria' => fake()->randomElement($categorias),
        ];
    }
}
