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
        Schema::create('client_color_profiles', function (Blueprint $table) {
            $table->id();

            // 1 ficha por cliente (si luego quieren varias, quitamos unique y agregamos "name" + "is_default")
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete()
                ->unique();

            // Datos técnicos principales
            $table->unsignedTinyInteger('base_level')->nullable(); // 1-10 (si lo usan)
            $table->string('goal_tone')->nullable();              // "amarillo dorado", "ceniza", etc.

            $table->string('brand')->nullable();                  // marca
            $table->string('color_code')->nullable();             // ej "9.3", "7.1"
            $table->text('formula')->nullable();                  // ej "30g 9.3 + 30g 9.0"

            $table->unsignedTinyInteger('developer_volume')->nullable(); // 10/20/30/40
            $table->string('ratio')->nullable();                          // ej "1:1"

            $table->unsignedSmallInteger('processing_time_minutes')->nullable(); // minutos
            $table->string('technique')->nullable(); // raíz/global/balayage/mechas

            $table->text('warnings')->nullable(); // "no usar 30 vol", alergias, etc.
            $table->text('notes')->nullable();    // observaciones extra


            $table->timestamps();


            // (Opcional) para mantener consistencia a nivel BD:
            $table->index(['brand', 'color_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_color_profiles');
    }
};
