<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvanceLaboratorioResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "laboratorio_real_id" => $this->laboratorio_real_id,
            "titulo" => $this->titulo,
            "resumen" => $this->resumen,
            "descripcion" => $this->descripcion,
            "fase" => $this->fase,
            "seccion" => $this->seccion,
            "tipo_avance" => $this->tipo_avance,
            "estado" => $this->estado,
            "fecha_avance" => $this->fecha_avance,
            "urls_relacionadas" => $this->urls_relacionadas,
            "metadata" => $this->metadata,
            "created_at" => optional($this->created_at)?->toISOString(),
            "updated_at" => optional($this->updated_at)?->toISOString(),
        ];
    }
}
