<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adjuntos_laboratorio', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratorio_real_id')
                ->constrained('laboratorios_reales')
                ->cascadeOnDelete();

            $table->string('seccion')->nullable();         // general, frontend, backend, diagramas...
            $table->string('fase')->nullable();            // idea, desarrollo, pruebas, final...
            $table->string('tipo_adjunto')->nullable();    // imagen, pdf, video, link, captura
            $table->string('storage_driver')->nullable();  // google_drive, local, externa

            $table->text('url')->nullable();
            $table->jsonb('urls_relacionadas')->nullable(); // array extra de urls asociadas
            $table->string('nombre_archivo')->nullable();
            $table->string('mime_type')->nullable();

            $table->text('descripcion')->nullable();
            $table->text('resumen_ia')->nullable();
            $table->string('origen')->default('manual');
            $table->jsonb('metadata')->nullable();

            $table->unsignedInteger('orden')->default(0);

            $table->timestamps();

            $table->index(['laboratorio_real_id', 'seccion']);
            $table->index(['fase', 'tipo_adjunto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adjuntos_laboratorio');
    }
};
