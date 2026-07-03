<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealResource extends JsonResource
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
            'es_visible' => $this->es_visible,
            'orden' => $this->orden,
            'resumen' => $this->resumen,
            'descripcion' => $this->descripcion,
            'notas_tecnicas' => $this->notas_tecnicas,
            'objetivo' => $this->objetivo,
            'resultado_actual' => $this->resultado_actual,
            'galeria_urls' => $this->galeria_urls,
            'documentacion_urls' => $this->documentacion_urls,
            'origen' => $this->origen,
            'referencia_externa' => $this->referencia_externa,
            'metadata' => $this->metadata,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'documentacion' => DocumentacionLaboratorioResource::collection(
                $this->whenLoaded('documentacion')
            ),
            'avances' => AvanceLaboratorioResource::collection(
                $this->whenLoaded('avances')
            ),
            'adjuntos' => AdjuntoLaboratorioResource::collection(
                $this->whenLoaded('adjuntos')
            ),
            'ideas' => IdeaLaboratorioResource::collection(
                $this->whenLoaded('ideas')
            ),
        ];
    }
}
