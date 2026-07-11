<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoSeccion extends Model
{
    protected $table = 'proyecto_secciones';

    protected $fillable = [
        'project_id',
        'clave',
        'titulo',
        'tipo_contenido',
        'layout',
        'resumen',
        'contenido',
        'items',
        'media_url',
        'codigo_lenguaje',
        'origen',
        'orden',
        'es_visible',
        'es_destacado',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'orden' => 'integer',
            'es_visible' => 'boolean',
            'es_destacado' => 'boolean',
            'metadata' => 'array',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
