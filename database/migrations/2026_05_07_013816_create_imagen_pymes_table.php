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
        Schema::create('imagen_pymes', function (Blueprint $table) {

            $table->id();

            // Relación con pymes
            $table->foreignId('pyme_id')
                ->constrained('pymes')
                ->onDelete('cascade');

            // Ruta o nombre de la imagen
            $table->string('ruta_imagen');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagen_pymes');
    }
};
