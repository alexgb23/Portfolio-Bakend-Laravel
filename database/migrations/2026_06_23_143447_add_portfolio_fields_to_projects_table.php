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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->string('short_description', 280)->nullable()->after('description');
            $table->string('stack_summary')->nullable()->after('technologies');

            $table->string('image_url')->nullable()->after('stack_summary');
            $table->string('project_url')->nullable()->after('image_url');
            $table->string('repo_url')->nullable()->after('project_url');

            $table->string('status')->default('published')->after('repo_url');
            $table->boolean('is_featured')->default(false)->after('status');
            $table->boolean('is_published')->default(true)->after('is_featured');
            $table->unsignedInteger('sort_order')->default(0)->after('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'slug',
                'short_description',
                'stack_summary',
                'image_url',
                'project_url',
                'repo_url',
                'status',
                'is_featured',
                'is_published',
                'sort_order',
            ]);
        });
    }
};
