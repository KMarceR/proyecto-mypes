<?php

namespace Database\Factories;

use App\Models\ImagenPyme;
use App\Models\Pyme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ImagenPyme>
 */
class ImagenPymeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pyme_id' => Pyme::inRandomOrder()->first()->id,

            'ruta_imagen' => 'https://picsum.photos/800',
        ];
    }
}
