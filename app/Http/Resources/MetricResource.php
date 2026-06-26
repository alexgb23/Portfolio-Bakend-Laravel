<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetricResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "room" => $this->room,
            "parameter" => $this->parameter,
            "display_name" => $this->display_name,
            "category" => $this->category,
            "source_system" => $this->source_system,
            "value" => $this->value,
            "unit" => $this->unit,
            "status" => $this->status,
            "recorded_at" => $this->recorded_at,
            "notes" => $this->notes,
            "is_featured" => (bool) $this->is_featured,
            "sort_order" => (int) $this->sort_order,
        ];
    }
}
