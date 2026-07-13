<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoDocumentacionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'seccion' => $this->seccion,
            'tipo' => $this->tipo,
            'resumen' => $this->resumen,
            'contenido' => $this->contenido,
            'origen' => $this->origen,
            'url_referencia' => $this->url_referencia,
            'orden' => (int) $this->orden,
            'es_visible' => (bool) $this->es_visible,
            'es_destacado' => (bool) $this->es_destacado,
            'metadata' => $this->metadata ?? [],
            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),
        ];
    }
}
