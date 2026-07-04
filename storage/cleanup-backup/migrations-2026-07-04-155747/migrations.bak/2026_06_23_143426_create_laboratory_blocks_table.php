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
        Schema::create('laboratory_blocks', function (Blueprint $table) {
            $table->id();

            // Identidad del bloque
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('block_key')->unique(); // hero, overview, infrastructure, automation...

            // Contenido
            $table->string('kicker')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // Presentación
            $table->string('layout_type')->nullable(); // hero, cards, metrics, list, story, research, tags
            $table->string('status')->default('active');
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_blocks');
    }
};
