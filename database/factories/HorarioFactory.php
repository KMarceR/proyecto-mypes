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
            // Relación con pymes
            'pyme_id' => Pyme::factory(),

            'dia_semana_horarios' => fake()->randomElement($dias),

            'hora_apertura_horarios' => fake()->randomElement([
                '07:00:00',
                '08:00:00',
                '09:00:00'
            ]),

            'hora_cierre_horarios' => fake()->randomElement([
                '17:00:00',
                '18:00:00',
                '20:00:00',
                '22:00:00'
            ]),
        ];
    }
}
