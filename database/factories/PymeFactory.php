<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Pyme;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pyme>
 */
class PymeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'categoria_id' => Categoria::inRandomOrder()->first()->id,

            'nombre_pyme' => fake()->company(),

            'telefono_pyme' => fake()->numerify('7###-####'),

            'email_pyme' => fake()->unique()->companyEmail(),

            'direccion_pyme' => fake()->address(),

            'descripcion_pyme' => fake()->paragraph(3),
        ];
    }
}
