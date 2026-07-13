<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealFeaturedResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'categoria' => $this->tipo_proyecto ?? 'Laboratorio',
            'estado' => $this->estado ?? 'activo',
            'resumen' => $this->resumen ?: $this->descripcion,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],
            'cover_image' => $this->cover_image ?? null,
            'documentacion_count' => $this->whenCounted('documentacion'),
            'avances_count' => $this->whenCounted('avances'),
        ];
    }
}
