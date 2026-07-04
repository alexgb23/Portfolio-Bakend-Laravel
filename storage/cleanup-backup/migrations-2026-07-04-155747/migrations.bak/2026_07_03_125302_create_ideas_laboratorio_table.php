<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ideas_laboratorio', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_real_id')
                ->constrained('laboratorios_reales')
                ->cascadeOnDelete();

            $table->string('titulo')->nullable();
            $table->text('idea');
            $table->longText('detalle')->nullable();

            $table->string('fase')->nullable();      // idea, planificacion, desarrollo, pruebas...
            $table->string('seccion')->nullable();   // general, frontend, backend, ia...
            $table->string('estado')->default('nueva'); // nueva, revisada, aplicada, descartada
            $table->string('prioridad')->default('media'); // baja, media, alta

            $table->string('origen')->default('manual'); // manual, telegram, ia
            $table->boolean('creada_por_ia')->default(false);

            $table->jsonb('urls_relacionadas')->nullable();
            $table->jsonb('metadata')->nullable();

            $table->timestamps();

            $table->index(['laboratorio_real_id', 'estado']);
            $table->index(['fase', 'seccion']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ideas_laboratorio');
    }
};
