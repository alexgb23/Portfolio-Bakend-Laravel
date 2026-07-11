<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_documentacion', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('titulo');
            $table->string('slug')->nullable()->index();
            $table->string('seccion')->nullable();
            $table->string('tipo')->default('general');

            $table->text('resumen')->nullable();
            $table->longText('contenido')->nullable();

            $table->string('origen')->nullable(); // local, drive, github, externo
            $table->string('url_referencia', 2048)->nullable();

            $table->unsignedInteger('orden')->default(0);
            $table->boolean('es_visible')->default(true);
            $table->boolean('es_destacado')->default(false);

            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_documentacion');
    }
};
