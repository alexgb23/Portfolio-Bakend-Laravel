<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected array $columnsToDrop = [
        'tipo_proyecto',
        'areas_relacionadas',
        'image_url',
        'galeria_urls',
        'documentacion_urls',
        'project_url',
        'frontend_url',
        'backend_url',
        'api_base_url',
        'staging_url',
        'repo_url',
        'status',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    public function up(): void
    {
        foreach ($this->columnsToDrop as $column) {
            if (Schema::hasColumn('projects', $column)) {
                Schema::table('projects', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'tipo_proyecto')) {
                $table->string('tipo_proyecto')->nullable()->after('slug');
            }

            if (! Schema::hasColumn('projects', 'areas_relacionadas')) {
                $table->json('areas_relacionadas')->nullable()->after('area_principal');
            }

            if (! Schema::hasColumn('projects', 'image_url')) {
                $table->json('image_url')->nullable()->after('stack_summary');
            }

            if (! Schema::hasColumn('projects', 'galeria_urls')) {
                $table->json('galeria_urls')->nullable()->after('image_url');
            }

            if (! Schema::hasColumn('projects', 'documentacion_urls')) {
                $table->json('documentacion_urls')->nullable()->after('galeria_urls');
            }

            if (! Schema::hasColumn('projects', 'project_url')) {
                $table->string('project_url')->nullable()->after('documentacion_urls');
            }

            if (! Schema::hasColumn('projects', 'frontend_url')) {
                $table->string('frontend_url')->nullable()->after('project_url');
            }

            if (! Schema::hasColumn('projects', 'backend_url')) {
                $table->string('backend_url')->nullable()->after('frontend_url');
            }

            if (! Schema::hasColumn('projects', 'api_base_url')) {
                $table->string('api_base_url')->nullable()->after('backend_url');
            }

            if (! Schema::hasColumn('projects', 'staging_url')) {
                $table->string('staging_url')->nullable()->after('api_base_url');
            }

            if (! Schema::hasColumn('projects', 'repo_url')) {
                $table->string('repo_url')->nullable()->after('staging_url');
            }

            if (! Schema::hasColumn('projects', 'status')) {
                $table->string('status')->default('published')->after('metadata');
            }

            if (! Schema::hasColumn('projects', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('status');
            }

            if (! Schema::hasColumn('projects', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('is_featured');
            }

            if (! Schema::hasColumn('projects', 'sort_order')) {
                $table->unsignedInteger('sort_order')->default(0)->after('is_published');
            }
        });
    }
};
