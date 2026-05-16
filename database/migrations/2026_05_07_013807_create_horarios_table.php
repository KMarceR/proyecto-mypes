<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {

            $table->id();

            // Relación con pymes
            $table->foreignId('pyme_id')
                ->constrained('pymes')
                ->onDelete('cascade');

            // Día de la semana
            $table->string('dia_semana_horarios');

            // Horario de apertura
            $table->time('hora_apertura_horarios');

            // Horario de cierre
            $table->time('hora_cierre_horarios');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
