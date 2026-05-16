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
        Schema::create('resenas', function (Blueprint $table) {
        $table->id();

        // Relación con la pyme
        $table->foreignId('pyme_id')
            ->constrained('pymes')
            ->onDelete('cascade');

        // Nombre de quien comenta
        $table->string('nombre_resena');

        // Calificación 1-5
        $table->tinyInteger('calificacion_resenas');

        // Comentario
        $table->text('comentario_resenas');

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
