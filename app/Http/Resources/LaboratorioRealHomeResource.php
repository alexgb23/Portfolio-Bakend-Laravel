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
            'categoria' => $this->tipo_proyecto ?? 'Laboratorio',
            'estado' => $this->estado ?? 'Activo',
            'resumen' => $this->resumen ?: $this->descripcion,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],
            'cover_image' => data_get($this->galeria_urls, '0'),
            'documentacion_count' => $this->whenCounted('documentacion'),
            'avances_count' => $this->whenCounted('avances'),
            'is_featured' => (bool) $this->es_destacado,
        ];
    }
}
