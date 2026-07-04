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
            'slug' => $this->slug,
            'tipo_proyecto' => $this->tipo_proyecto,
            'area_principal' => $this->area_principal,
            'areas_relacionadas' => $this->areas_relacionadas,
            'estado' => $this->estado,
            'es_destacado' => $this->es_destacado,
            'orden' => $this->orden,
            'resumen' => $this->resumen,
            'objetivo' => $this->objetivo,
            'resultado_actual' => $this->resultado_actual,
            'galeria_urls' => $this->galeria_urls,
            'origen' => $this->origen,
            'referencia_externa' => $this->referencia_externa,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'documentacion_count' => $this->whenCounted('documentacion'),
            'avances_count' => $this->whenCounted('avances'),
            'adjuntos_count' => $this->whenCounted('adjuntos'),
            'ideas_count' => $this->whenCounted('ideas'),
        ];
    }
}
