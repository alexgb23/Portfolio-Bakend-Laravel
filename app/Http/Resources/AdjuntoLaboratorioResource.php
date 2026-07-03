<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdjuntoLaboratorioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "laboratorio_real_id" => $this->laboratorio_real_id,
            "seccion" => $this->seccion,
            "fase" => $this->fase,
            "tipo_adjunto" => $this->tipo_adjunto,
            "storage_driver" => $this->storage_driver,
            "url" => $this->url,
            "urls_relacionadas" => $this->urls_relacionadas,
            "nombre_archivo" => $this->nombre_archivo,
            "mime_type" => $this->mime_type,
            "descripcion" => $this->descripcion,
            "resumen_ia" => $this->resumen_ia,
            "origen" => $this->origen,
            "metadata" => $this->metadata,
            "orden" => $this->orden,
            "created_at" => optional($this->created_at)?->toISOString(),
            "updated_at" => optional($this->updated_at)?->toISOString(),
        ];
    }
}
