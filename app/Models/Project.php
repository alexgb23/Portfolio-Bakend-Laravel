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
     * Importante:
     * añadimos card_background_dark y card_background_light
     * para que puedan guardarse desde store/update.
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
        'card_background_dark',
        'card_background_light',
        'fecha_inicio',
        'fecha_fin',
    ];

    /**
     * Valores por defecto para atributos JSON/array.
     *
     * Así evitamos null innecesarios y garantizamos que
     * el frontend reciba arrays vacíos cuando no haya datos.
     */
    protected $attributes = [
        'technologies' => '[]',
        'metadata' => '[]',
        'card_background_dark' => '[]',
        'card_background_light' => '[]',
    ];

    /**
     * Casts automáticos de Eloquent.
     *
     * Laravel convertirá estos campos JSON a arrays PHP
     * al leerlos, y de arrays a JSON al guardarlos.
     */
    protected function casts(): array
    {
        return [
            'laboratorio_real_id' => 'integer',
            'technologies' => 'array',
            'metadata' => 'array',
            'card_background_dark' => 'array',
            'card_background_light' => 'array',
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