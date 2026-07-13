<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoSeccionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'clave' => $this->clave,
            'titulo' => $this->titulo,
            'tipo_contenido' => $this->tipo_contenido,
            'layout' => $this->layout,
            'resumen' => $this->resumen,
            'contenido' => $this->contenido,
            'items' => $this->items ?? [],
            'media_url' => $this->media_url,
            'codigo_lenguaje' => $this->codigo_lenguaje,
            'origen' => $this->origen,
            'orden' => (int) $this->orden,
            'es_visible' => (bool) $this->es_visible,
            'es_destacado' => (bool) $this->es_destacado,
            'metadata' => $this->metadata ?? [],
            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),
        ];
    }
}
