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
        Schema::create('research_sources', function (Blueprint $table) {
            $table->id();

            // Identidad de la fuente
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('source_type')->nullable(); // article, documentation, book, video, report, website

            // Autoría y publicación
            $table->string('author_name')->nullable();
            $table->string('publisher_name')->nullable();
            $table->date('published_on')->nullable();

            // Localización
            $table->string('url')->nullable();
            $table->string('reference_code')->nullable();

            // Contenido resumido
            $table->text('summary')->nullable();
            $table->text('notes')->nullable();

            // Organización
            $table->string('topic')->nullable();
            $table->string('status')->default('active');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_sources');
    }
};
