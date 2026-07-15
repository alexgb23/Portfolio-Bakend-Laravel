<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealHomeResource extends JsonResource
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
            ->filter(fn($item) => !empty($item['label']) && !empty($item['slug']))
            ->take(6)
            ->values();

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
        ];
    }
}
