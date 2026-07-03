<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdeaLaboratorioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "laboratorio_real_id" => $this->laboratorio_real_id,
            "titulo" => $this->titulo,
            "idea" => $this->idea,
            "detalle" => $this->detalle,
            "fase" => $this->fase,
            "seccion" => $this->seccion,
            "estado" => $this->estado,
            "prioridad" => $this->prioridad,
            "origen" => $this->origen,
            "creada_por_ia" => $this->creada_por_ia,
            "urls_relacionadas" => $this->urls_relacionadas,
            "metadata" => $this->metadata,
            "created_at" => optional($this->created_at)?->toISOString(),
            "updated_at" => optional($this->updated_at)?->toISOString(),
        ];
    }
}
