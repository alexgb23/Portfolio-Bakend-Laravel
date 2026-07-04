<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avances_laboratorio', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_real_id')
                ->constrained('laboratorios_reales')
                ->cascadeOnDelete();

            $table->string('titulo');
            $table->text('resumen')->nullable();
            $table->longText('descripcion')->nullable();

            $table->string('fase')->nullable();        // planificacion, desarrollo, pruebas...
            $table->string('seccion')->nullable();     // backend, frontend, ia...
            $table->string('tipo_avance')->nullable(); // tecnico, visual, contenido, infraestructura
            $table->string('estado')->default('registrado');

            $table->dateTime('fecha_avance')->nullable();
            $table->jsonb('urls_relacionadas')->nullable();
            $table->jsonb('metadata')->nullable();

            $table->timestamps();

            $table->index(['laboratorio_real_id', 'fecha_avance']);
            $table->index(['fase', 'seccion']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avances_laboratorio');
    }
};
