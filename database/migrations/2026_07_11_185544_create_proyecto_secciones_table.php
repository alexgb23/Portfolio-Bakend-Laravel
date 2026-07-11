<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_secciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('clave')->index();
            $table->string('titulo');
            $table->string('tipo_contenido')->default('texto');
            $table->string('layout')->nullable();

            $table->text('resumen')->nullable();
            $table->longText('contenido')->nullable();

            $table->json('items')->nullable();
            $table->string('media_url', 2048)->nullable();
            $table->string('codigo_lenguaje')->nullable();

            $table->string('origen')->nullable(); // local, drive, github, externo

            $table->unsignedInteger('orden')->default(0);
            $table->boolean('es_visible')->default(true);
            $table->boolean('es_destacado')->default(false);

            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_secciones');
    }
};
