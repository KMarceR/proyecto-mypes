<?php

namespace Database\Factories;

use App\Models\Horario;
use App\Models\Pyme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Horario>
 */
class HorarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dias = [
            'Lunes',
            'Martes',
            'Miércoles',
            'Jueves',
            'Viernes',
            'Sábado',
            'Domingo'
        ];

        return [
            'pyme_id' => Pyme::inRandomOrder()->first()->id,

            'dia_semana_horarios' => fake()->randomElement($dias),

            'hora_apertura_horarios' => '08:00:00',

            'hora_cierre_horarios' => '18:00:00',
        ];
    }
}
