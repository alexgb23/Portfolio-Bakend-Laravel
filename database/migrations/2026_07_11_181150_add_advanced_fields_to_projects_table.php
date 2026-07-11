<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('laboratorio_real_id')
                ->nullable()
                ->constrained('laboratorios_reales')
                ->nullOnDelete()
                ->after('id');

            $table->string('tipo_proyecto')->nullable()->after('slug');
            $table->string('area_principal')->nullable()->after('tipo_proyecto');
            $table->json('areas_relacionadas')->nullable()->after('area_principal');

            $table->text('resumen')->nullable()->after('short_description');
            $table->text('notas_tecnicas')->nullable()->after('description');
            $table->text('objetivo')->nullable()->after('notas_tecnicas');
            $table->text('resultado_actual')->nullable()->after('objetivo');

            $table->json('galeria_urls')->nullable()->after('image_url');
            $table->json('documentacion_urls')->nullable()->after('galeria_urls');

            $table->string('frontend_url')->nullable()->after('project_url');
            $table->string('backend_url')->nullable()->after('frontend_url');
            $table->string('api_base_url')->nullable()->after('backend_url');
            $table->string('staging_url')->nullable()->after('api_base_url');

            $table->string('referencia_externa')->nullable()->after('repo_url');
            $table->json('metadata')->nullable()->after('referencia_externa');

            $table->date('fecha_inicio')->nullable()->after('metadata');
            $table->date('fecha_fin')->nullable()->after('fecha_inicio');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['laboratorio_real_id']);

            $table->dropColumn([
                'laboratorio_real_id',
                'tipo_proyecto',
                'area_principal',
                'areas_relacionadas',
                'resumen',
                'notas_tecnicas',
                'objetivo',
                'resultado_actual',
                'galeria_urls',
                'documentacion_urls',
                'frontend_url',
                'backend_url',
                'api_base_url',
                'staging_url',
                'referencia_externa',
                'metadata',
                'fecha_inicio',
                'fecha_fin',
            ]);
        });
    }
};
