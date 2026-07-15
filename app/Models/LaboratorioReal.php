<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LaboratorioReal extends Model
{
    protected $table = 'laboratorios_reales';

    protected $fillable = [
        'titulo',
        'slug',
        'tipo_proyecto',
        'area_principal',
        'areas_relacionadas',
        'estado',
        'es_destacado',
        'es_visible',
        'orden',
        'resumen',
        'descripcion',
        'notas_tecnicas',
        'objetivo',
        'resultado_actual',
        'galeria_urls',
        'documentacion_urls',
        'origen',
        'referencia_externa',
        'metadata',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected function casts(): array
    {
        return [
            'areas_relacionadas' => 'array',
            'es_destacado' => 'boolean',
            'es_visible' => 'boolean',
            'orden' => 'integer',
            'galeria_urls' => 'array',
            'documentacion_urls' => 'array',
            'metadata' => 'array',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function ideas(): HasMany
    {
        return $this->hasMany(IdeaLaboratorio::class, 'laboratorio_real_id')
            ->orderByRaw("
                CASE prioridad
                    WHEN 'alta' THEN 1
                    WHEN 'media' THEN 2
                    WHEN 'baja' THEN 3
                    ELSE 4
                END
            ")
            ->orderByDesc('created_at')
            ->orderByDesc('id');
    }

    public function avances(): HasMany
    {
        return $this->hasMany(AvanceLaboratorio::class, 'laboratorio_real_id')
            ->orderByDesc('fecha_avance')
            ->orderByDesc('id');
    }

    public function adjuntos(): HasMany
    {
        return $this->hasMany(AdjuntoLaboratorio::class, 'laboratorio_real_id')
            ->orderBy('orden');
    }

    public function documentacion(): HasMany
    {
        return $this->hasMany(DocumentacionLaboratorio::class, 'laboratorio_real_id')
            ->orderBy('orden');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'laboratorio_real_id')
            ->orderBy('title');
    }
}
