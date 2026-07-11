<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'laboratorio_real_id' => $this->laboratorio_real_id,

            'title' => $this->title,
            'slug' => $this->slug,
            'tipo_proyecto' => $this->tipo_proyecto,
            'area_principal' => $this->area_principal,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],

            'short_description' => $this->short_description,
            'resumen' => $this->resumen,
            'description' => $this->description,
            'notas_tecnicas' => $this->notas_tecnicas,
            'objetivo' => $this->objetivo,
            'resultado_actual' => $this->resultado_actual,

            'technologies' => $this->technologies,
            'stack_summary' => $this->stack_summary,

            'image_url' => $this->image_url,
            'galeria_urls' => $this->galeria_urls ?? [],
            'documentacion_urls' => $this->documentacion_urls ?? [],

            'project_url' => $this->project_url,
            'frontend_url' => $this->frontend_url,
            'backend_url' => $this->backend_url,
            'api_base_url' => $this->api_base_url,
            'staging_url' => $this->staging_url,
            'repo_url' => $this->repo_url,
            'referencia_externa' => $this->referencia_externa,

            'metadata' => $this->metadata ?? [],

            'status' => $this->status,
            'is_featured' => (bool) $this->is_featured,
            'is_published' => (bool) $this->is_published,
            'sort_order' => (int) $this->sort_order,

            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,

            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),

            'laboratorio_origen' => $this->whenLoaded(
                'laboratorioReal',
                fn() => [
                    'id' => $this->laboratorioReal?->id,
                    'titulo' => $this->laboratorioReal?->titulo,
                    'slug' => $this->laboratorioReal?->slug,
                    'estado' => $this->laboratorioReal?->estado,
                ]
            ),
        ];
    }
}
