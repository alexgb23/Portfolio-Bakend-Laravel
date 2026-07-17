<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealHomeLabResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $stack = collect(data_get($this, 'metadata.stack', []))
            ->map(function ($item) {
                if (!is_array($item)) {
                    return null;
                }

                return [
                    'label' => $item['label'] ?? null,
                    'slug' => $item['slug'] ?? null,
                ];
            })
            ->filter(fn ($item) => !empty($item['label']) && !empty($item['slug']))
            ->take(6)
            ->values();

        $darkPaths = [];
        $lightPaths = [];
        $targetColorPaths = [];

        if ($this->relationLoaded('adjuntos')) {
            $darkAdjunto = $this->adjuntos
                ->firstWhere('nombre_archivo', 'fondo_tarjeta_dark');

            $lightAdjunto = $this->adjuntos
                ->firstWhere('nombre_archivo', 'fondo_tarjeta_light');

            $targetColorAdjunto = $this->adjuntos
                ->firstWhere('nombre_archivo', 'target_color');

            $darkPaths = $darkAdjunto?->url
                ? collect(explode(',', $darkAdjunto->url))
                    ->map(fn ($item) => trim($item))
                    ->filter()
                    ->values()
                    ->all()
                : [];

            $lightPaths = $lightAdjunto?->url
                ? collect(explode(',', $lightAdjunto->url))
                    ->map(fn ($item) => trim($item))
                    ->filter()
                    ->values()
                    ->all()
                : [];

            $targetColorPaths = $targetColorAdjunto?->url
                ? collect(explode(',', $targetColorAdjunto->url))
                    ->map(fn ($item) => trim($item))
                    ->filter()
                    ->values()
                    ->all()
                : [];
        }

        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'categoria' => $this->tipo_proyecto ?? 'laboratorio',
            'estado' => $this->estado ?? 'activo',
            'activo' => ($this->estado ?? null) === 'activo',
            'resumen' => $this->resumen ?: $this->descripcion,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],
            'stack' => $stack,
            'projects_count' => $this->whenCounted('projects'),
            'documentacion_count' => $this->whenCounted('documentacion'),
            'fondo_tarjeta_dark' => $darkPaths,
            'fondo_tarjeta_light' => $lightPaths,
            'target_color' => $targetColorPaths,
        ];
    }
}