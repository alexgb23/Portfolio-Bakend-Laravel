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
        Schema::create('laboratory_items', function (Blueprint $table) {
            $table->id();

            // Identidad
            $table->string('name');
            $table->string('slug')->nullable();

            // Clasificación
            $table->string('item_type')->nullable();   // hardware, service, network, ai, automation, storage
            $table->string('category')->nullable();

            // Ubicación y estado
            $table->string('location_name')->nullable();
            $table->string('status')->default('active');

            // Descripción
            $table->text('description')->nullable();
            $table->text('technical_notes')->nullable();

            // Presentación
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
        Schema::dropIfExists('laboratory_items');
    }
};
