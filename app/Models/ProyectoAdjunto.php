<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProyectoAdjunto extends Model
{
    protected $table = 'proyecto_adjuntos';

    protected $fillable = [
        'project_id',
        'titulo',
        'tipo',
        'grupo',
        'subtitulo',
        'descripcion',
        'origen',
        'nombre_archivo',
        'mime_type',
        'url',
        'icono',
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
