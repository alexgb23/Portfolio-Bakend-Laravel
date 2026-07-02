<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('profile_settings');
    }

    public function down(): void
    {
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('display_name')->nullable();
            $table->string('headline')->nullable();
            $table->string('subheadline')->nullable();
            $table->text('bio_short')->nullable();
            $table->longText('bio_long')->nullable();
            $table->string('location')->nullable();
            $table->string('email_public')->nullable();
            $table->string('website_url')->nullable();
            $table->string('resume_url')->nullable();
            $table->string('status_label')->nullable();
            $table->string('hero_kicker')->nullable();
            $table->string('hero_title_prefix')->nullable();
            $table->string('hero_title_highlight')->nullable();
            $table->string('hero_title_suffix')->nullable();
            $table->string('hero_stack_badge')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_intro')->nullable();
            $table->timestamps();
        });
    }
};
