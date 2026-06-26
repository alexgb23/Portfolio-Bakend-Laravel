<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profile_settings', function (Blueprint $table) {
            $table->string('hero_kicker')->nullable()->after('subheadline');
            $table->string('hero_title_prefix')->nullable()->after('hero_kicker');
            $table->string('hero_title_highlight')->nullable()->after('hero_title_prefix');
            $table->string('hero_title_suffix')->nullable()->after('hero_title_highlight');
            $table->string('hero_stack_badge')->nullable()->after('hero_title_suffix');
            $table->string('about_title')->nullable()->after('hero_stack_badge');
            $table->text('about_intro')->nullable()->after('about_title');
        });
    }

    public function down(): void
    {
        Schema::table('profile_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_kicker',
                'hero_title_prefix',
                'hero_title_highlight',
                'hero_title_suffix',
                'hero_stack_badge',
                'about_title',
                'about_intro',
            ]);
        });
    }
};
