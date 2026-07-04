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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();

            // Identidad
            $table->string('name');
            $table->string('slug')->nullable();

            // Clasificación
            $table->string('category')->nullable();          // backend, frontend, devops, networking, ai...
            $table->string('proficiency_level')->nullable(); // beginner, intermediate, advanced, expert
            $table->unsignedTinyInteger('proficiency_score')->nullable(); // 1-5

            // Presentación
            $table->string('icon_name')->nullable();
            $table->text('description')->nullable();

            // Visibilidad
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
        Schema::dropIfExists('skills');
    }
};
