<?php

namespace App\Http\Resources;

use App\Http\Resources\ProyectoAdjuntoResource;
use App\Http\Resources\ProyectoDocumentacionResource;
use App\Http\Resources\ProyectoSeccionResource;
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
            'area_principal' => $this->area_principal,

            'short_description' => $this->short_description,
            'resumen' => $this->resumen,
            'description' => $this->description,
            'notas_tecnicas' => $this->notas_tecnicas,
            'objetivo' => $this->objetivo,
            'resultado_actual' => $this->resultado_actual,

            'technologies' => $this->technologies ?? [],
            'stack_summary' => $this->stack_summary,
            'metadata' => $this->metadata ?? [],

            'fecha_inicio' => optional($this->fecha_inicio)?->toISOString(),
            'fecha_fin' => optional($this->fecha_fin)?->toISOString(),

            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),

            // Relación opcional con laboratorio origen.
            'laboratorio_origen' => $this->when(
                $this->relationLoaded('laboratorioReal') && $this->laboratorioReal,
                fn() => [
                    'id' => $this->laboratorioReal->id,
                    'titulo' => $this->laboratorioReal->titulo,
                    'slug' => $this->laboratorioReal->slug,
                    'estado' => $this->laboratorioReal->estado,
                ]
            ),

            // Recursos externos del proyecto.
            'adjuntos' => ProyectoAdjuntoResource::collection(
                $this->whenLoaded('adjuntos')
            ),

            'documentacion' => ProyectoDocumentacionResource::collection(
                $this->whenLoaded('documentacion')
            ),

            'secciones' => ProyectoSeccionResource::collection(
                $this->whenLoaded('secciones')
            ),
        ];
    }
}
