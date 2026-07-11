<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoDocumentacion extends Model
{
    protected $table = 'proyecto_documentacion';

    protected $fillable = [
        'project_id',
        'titulo',
        'slug',
        'seccion',
        'tipo',
        'resumen',
        'contenido',
        'origen',
        'url_referencia',
        'orden',
        'es_visible',
        'es_destacado',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
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
