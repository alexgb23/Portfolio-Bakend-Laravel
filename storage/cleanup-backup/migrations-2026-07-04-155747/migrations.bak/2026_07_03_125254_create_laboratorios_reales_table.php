<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laboratorios_reales', function (Blueprint $table) {
            $table->id();

            // Identidad
            $table->string('titulo');
            $table->string('slug')->unique();

            // Clasificación
            $table->string('tipo_proyecto')->nullable();      // portfolio, backend, web, automatizacion, ia
            $table->string('area_principal')->nullable();     // ia, diseno_front, backend, homeassistant, etc
            $table->jsonb('areas_relacionadas')->nullable();  // array de áreas adicionales

            // Estado y visibilidad
            $table->string('estado')->default('borrador'); // borrador, activo, pausado, finalizado, archivado
            $table->boolean('es_destacado')->default(false);
            $table->boolean('es_visible')->default(true);
            $table->unsignedInteger('orden')->default(0);

            // Contenido principal
            $table->text('resumen')->nullable();
            $table->longText('descripcion')->nullable();
            $table->longText('notas_tecnicas')->nullable();
            $table->text('objetivo')->nullable();
            $table->text('resultado_actual')->nullable();

            // Arrays rápidos
            $table->jsonb('galeria_urls')->nullable();         // array de urls generales
            $table->jsonb('documentacion_urls')->nullable();   // array de urls generales de documentación

            // Automatización / IA
            $table->string('origen')->default('manual'); // manual, telegram, ia
            $table->string('referencia_externa')->nullable();  // id externo, mensaje telegram, etc
            $table->jsonb('metadata')->nullable();

            // Fechas
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->timestamps();

            $table->index(['estado', 'es_visible']);
            $table->index(['area_principal', 'estado']);
            $table->index(['es_destacado', 'orden']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laboratorios_reales');
    }
};
