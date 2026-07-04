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
        Schema::create('research_metrics', function (Blueprint $table) {
            $table->id();

            // Relación con la fuente investigada
            $table->foreignId('research_source_id')
                ->nullable()
                ->constrained('research_sources')
                ->nullOnDelete();

            // Métrica
            $table->string('metric_name');     // relevance_score, credibility_score, citation_count, etc.
            $table->string('metric_value');    // valor flexible para no complicar tipos ahora
            $table->string('metric_unit')->nullable(); // score, %, count, level

            // Contexto
            $table->date('measured_on')->nullable();
            $table->text('notes')->nullable();

            // Estado y orden
            $table->string('status')->default('active');
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
        Schema::dropIfExists('research_metrics');
    }
};
