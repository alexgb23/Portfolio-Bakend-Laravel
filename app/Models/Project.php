<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'laboratorio_real_id',
        'title',
        'slug',
        'tipo_proyecto',
        'area_principal',
        'areas_relacionadas',
        'description',
        'short_description',
        'resumen',
        'notas_tecnicas',
        'objetivo',
        'resultado_actual',
        'technologies',
        'stack_summary',
        'image_url',
        'galeria_urls',
        'documentacion_urls',
        'project_url',
        'frontend_url',
        'backend_url',
        'api_base_url',
        'staging_url',
        'repo_url',
        'referencia_externa',
        'metadata',
        'status',
        'is_featured',
        'is_published',
        'sort_order',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected function casts(): array
    {
        return [
            'laboratorio_real_id' => 'integer',
            'areas_relacionadas' => 'array',
            'image_url' => 'array',
            'galeria_urls' => 'array',
            'documentacion_urls' => 'array',
            'metadata' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'sort_order' => 'integer',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, 'laboratorio_real_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}
