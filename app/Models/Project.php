<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'laboratorio_real_id',
        'title',
        'slug',
        'area_principal',
        'description',
        'short_description',
        'resumen',
        'notas_tecnicas',
        'objetivo',
        'resultado_actual',
        'technologies',
        'stack_summary',
        'metadata',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $attributes = [
        'technologies' => '[]',
        'metadata' => '[]',
    ];

    protected function casts(): array
    {
        return [
            'laboratorio_real_id' => 'integer',
            'technologies' => 'array',
            'metadata' => 'array',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, 'laboratorio_real_id');
    }

    public function adjuntos(): HasMany
    {
        return $this->hasMany(ProyectoAdjunto::class)->orderBy('orden');
    }

    public function documentacion(): HasMany
    {
        return $this->hasMany(ProyectoDocumentacion::class)->orderBy('orden');
    }

    public function secciones(): HasMany
    {
        return $this->hasMany(ProyectoSeccion::class)->orderBy('orden');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('title');
    }
}
