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
        Schema::create('home_assistant_use_cases', function (Blueprint $table) {
            $table->id();

            // Relación lógica con la instancia
            $table->unsignedBigInteger('home_assistant_instance_id')->nullable();

            // Caso de uso
            $table->string('title');
            $table->string('category')->nullable();
            $table->text('description')->nullable();

            // Estado y control visual
            $table->string('status')->default('active');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->foreign('home_assistant_instance_id')
                ->references('id')
                ->on('home_assistant_instances')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_assistant_use_cases');
    }
};
