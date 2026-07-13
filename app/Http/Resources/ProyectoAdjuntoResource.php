<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoAdjuntoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'tipo' => $this->tipo,
            'grupo' => $this->grupo,
            'subtitulo' => $this->subtitulo,
            'descripcion' => $this->descripcion,
            'origen' => $this->origen,
            'nombre_archivo' => $this->nombre_archivo,
            'mime_type' => $this->mime_type,
            'url' => $this->url,
            'icono' => $this->icono,
            'orden' => (int) $this->orden,
            'es_visible' => (bool) $this->es_visible,
            'es_destacado' => (bool) $this->es_destacado,
            'metadata' => $this->metadata ?? [],
            'created_at' => optional($this->created_at)?->toISOString(),
            'updated_at' => optional($this->updated_at)?->toISOString(),
        ];
    }
}
