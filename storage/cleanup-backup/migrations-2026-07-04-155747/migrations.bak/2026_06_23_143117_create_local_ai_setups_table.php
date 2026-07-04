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
        Schema::create('local_ai_setups', function (Blueprint $table) {
            $table->id();

            // Identidad
            $table->string('name');
            $table->string('slug')->nullable();

            // Stack principal
            $table->string('provider')->nullable();          // ollama, localai, open-webui, etc.
            $table->string('model_name')->nullable();        // llama3, mistral, qwen, etc.
            $table->string('model_size')->nullable();        // 7B, 8B, 14B...
            $table->string('base_url')->nullable();          // endpoint local
            $table->string('interface_name')->nullable();    // Open WebUI, CLI, API...

            // Descripción técnica
            $table->text('description')->nullable();
            $table->text('hardware_notes')->nullable();

            // Estado
            $table->string('status')->default('active');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_ai_setups');
    }
};
