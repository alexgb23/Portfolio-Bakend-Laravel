<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealHomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'categoria' => $this->tipo_proyecto ?? 'Laboratorio',
            'area_principal' => $this->area_principal,
            'estado' => $this->estado ?? 'activo',
            'resumen' => $this->resumen ?: $this->descripcion,
            'descripcion' => $this->descripcion,
            'objetivo' => $this->objetivo,
            'resultado_actual' => $this->resultado_actual,
            'notas_tecnicas' => $this->notas_tecnicas,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],
            'metadata' => $this->metadata ?? [],
            'updated_at' => $this->updated_at,
            'documentacion_count' => $this->whenCounted('documentacion'),
            'avances_count' => $this->whenCounted('avances'),
            'ideas_count' => $this->whenCounted('ideas'),
            'adjuntos_count' => $this->whenCounted('adjuntos'),
            'adjuntos' => AdjuntoLaboratorioResource::collection($this->whenLoaded('adjuntos')),
            'is_featured' => (bool) $this->es_destacado,
        ];
    }
}
