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
        Schema::create('home_assistant_instances', function (Blueprint $table) {
            $table->id();

            // Identidad principal
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('version')->nullable();

            // Ubicación y acceso
            $table->string('location_name')->nullable();
            $table->string('access_url')->nullable();

            // Descripción
            $table->text('description')->nullable();

            // Estado y control
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
        Schema::dropIfExists('home_assistant_instances');
    }
};
