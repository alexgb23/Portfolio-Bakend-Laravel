<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NodeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "node_name" => $this->node_name,
            "location_name" => $this->location_name,
            "type" => $this->type,
            "source_system" => $this->source_system,
            "protocol" => $this->protocol,
            "current_value" => $this->current_value,
            "unit" => $this->unit,
            "ip_address" => $this->ip_address,
            "status" => $this->status,
            "last_seen_at" => $this->last_seen_at,
            "is_active" => (bool) $this->is_active,
            "notes" => $this->notes,
            "is_featured" => (bool) $this->is_featured,
            "sort_order" => (int) $this->sort_order,
        ];
    }
}
