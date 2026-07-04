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
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();

            // Identidad principal
            $table->string('full_name');
            $table->string('display_name')->nullable();
            $table->string('headline');
            $table->string('subheadline')->nullable();

            // Textos del perfil
            $table->text('bio_short')->nullable();
            $table->longText('bio_long')->nullable();

            // Datos públicos
            $table->string('location')->nullable();
            $table->string('email_public')->nullable();
            $table->string('website_url')->nullable();
            $table->string('resume_url')->nullable();

            // Estado del perfil
            $table->string('status_label')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
    }
};
