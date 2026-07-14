<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /**
     * Campos permitidos para asignación masiva.
     *
     * Solo deben ir atributos que existan realmente
     * en la tabla projects.
     */
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

    /**
     * Valores por defecto para atributos JSON/array.
     */
    protected $attributes = [
        'technologies' => '[]',
        'metadata' => '[]',
    ];

    /**
     * Casts automáticos de Eloquent.
     */
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

    /**
     * Proyecto -> laboratorio origen.
     */
    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, 'laboratorio_real_id');
    }

    /**
     * Archivos adjuntos del proyecto.
     */
    public function adjuntos(): HasMany
    {
        return $this->hasMany(ProyectoAdjunto::class)->orderBy('orden');
    }

    /**
     * Documentación asociada al proyecto.
     */
    public function documentacion(): HasMany
    {
        return $this->hasMany(ProyectoDocumentacion::class)->orderBy('orden');
    }

    /**
     * Secciones enriquecidas del proyecto.
     */
    public function secciones(): HasMany
    {
        return $this->hasMany(ProyectoSeccion::class)->orderBy('orden');
    }

    /**
     * Scope para ordenar el listado alfabéticamente.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('title');
    }
}
