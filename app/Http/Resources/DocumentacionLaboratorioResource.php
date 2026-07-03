<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentacionLaboratorioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "laboratorio_real_id" => $this->laboratorio_real_id,
            "fase" => $this->fase,
            "seccion" => $this->seccion,
            "tipo_documentacion" => $this->tipo_documentacion,
            "titulo" => $this->titulo,
            "resumen" => $this->resumen,
            "contenido" => $this->contenido,
            "urls_relacionadas" => $this->urls_relacionadas,
            "orden" => $this->orden,
            "estado" => $this->estado,
            "es_visible" => $this->es_visible,
            "origen" => $this->origen,
            "metadata" => $this->metadata,
            "created_at" => optional($this->created_at)?->toISOString(),
            "updated_at" => optional($this->updated_at)?->toISOString(),
        ];
    }
}
