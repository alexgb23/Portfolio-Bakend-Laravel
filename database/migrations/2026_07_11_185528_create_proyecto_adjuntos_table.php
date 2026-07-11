<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_adjuntos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('titulo');
            $table->string('tipo')->default('enlace');
            $table->string('grupo')->nullable();

            $table->string('subtitulo')->nullable();
            $table->text('descripcion')->nullable();

            $table->string('origen')->nullable(); // drive, github, externo, local, s3
            $table->string('nombre_archivo')->nullable();
            $table->string('mime_type')->nullable();

            $table->string('url', 2048)->nullable();
            $table->string('icono')->nullable();

            $table->unsignedInteger('orden')->default(0);
            $table->boolean('es_visible')->default(true);
            $table->boolean('es_destacado')->default(false);

            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_adjuntos');
    }
};
