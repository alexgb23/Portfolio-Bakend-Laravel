<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'tipo_proyecto' => $this->tipo_proyecto,
            'area_principal' => $this->area_principal,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],
            'estado' => $this->estado,
            'es_destacado' => (bool) $this->es_destacado,
            'es_visible' => (bool) $this->es_visible,
            'orden' => $this->orden,
            'resumen' => $this->resumen ?: $this->descripcion,
            'objetivo' => $this->objetivo,
            'resultado_actual' => $this->resultado_actual,
            'notas_tecnicas' => $this->notas_tecnicas,
            'galeria_urls' => $this->galeria_urls ?? [],
            'documentacion_urls' => $this->documentacion_urls ?? [],
            'origen' => $this->origen,
            'referencia_externa' => $this->referencia_externa,
            'metadata' => $this->metadata ?? [],
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),
            'documentacion_count' => $this->whenCounted('documentacion'),
            'avances_count' => $this->whenCounted('avances'),
            'adjuntos_count' => $this->whenCounted('adjuntos'),
            'ideas_count' => $this->whenCounted('ideas'),
        ];
    }
}
