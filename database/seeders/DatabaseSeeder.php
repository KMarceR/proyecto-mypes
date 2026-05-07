<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Pyme;
use App\Models\Horario;
use App\Models\ImagenPyme;
use App\Models\Resena;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // =========================
        // CATEGORIAS
        // =========================
        Categoria::factory()->count(8)->create();

        // =========================
        // PYMES
        // =========================
        Pyme::factory()->count(50)->create();

        // =========================
        // HORARIOS
        // =========================
        Horario::factory()->count(100)->create();

        // =========================
        // IMAGENES
        // =========================
        ImagenPyme::factory()->count(50)->create();

        // =========================
        // RESEÑAS
        // =========================
        Resena::factory()->count(200)->create();
    }
}
