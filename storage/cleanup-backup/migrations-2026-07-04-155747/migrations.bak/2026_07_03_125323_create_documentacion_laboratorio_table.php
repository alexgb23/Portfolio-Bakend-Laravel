<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentacion_laboratorio', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_real_id')
                ->constrained('laboratorios_reales')
                ->cascadeOnDelete();

            $table->string('fase')->nullable();        // idea, planificacion, desarrollo, pruebas, final
            $table->string('seccion')->nullable();     // general, frontend, backend, ia...
            $table->string('tipo_documentacion')->nullable(); // nota, guia, decision, referencia, cierre_fase

            $table->string('titulo');
            $table->text('resumen')->nullable();
            $table->longText('contenido')->nullable();

            $table->jsonb('urls_relacionadas')->nullable();
            $table->unsignedInteger('orden')->default(0);

            $table->string('estado')->default('borrador');
            $table->boolean('es_visible')->default(true);
            $table->string('origen')->default('manual');
            $table->jsonb('metadata')->nullable();

            $table->timestamps();

            $table->index(['laboratorio_real_id', 'fase', 'seccion']);
            $table->index(['estado', 'es_visible', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentacion_laboratorio');
    }
};
