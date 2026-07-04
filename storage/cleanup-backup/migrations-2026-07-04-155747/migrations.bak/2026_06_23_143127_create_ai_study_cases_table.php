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
        Schema::create('ai_study_cases', function (Blueprint $table) {
            $table->id();

            // Identidad
            $table->string('title');
            $table->string('slug')->nullable();

            // Clasificación
            $table->string('category')->nullable();
            $table->string('technology_stack')->nullable();

            // Estructura del caso
            $table->text('context')->nullable();
            $table->text('challenge')->nullable();
            $table->text('solution')->nullable();
            $table->text('results')->nullable();

            // Presentación
            $table->string('status')->default('published');
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
        Schema::dropIfExists('ai_study_cases');
    }
};
