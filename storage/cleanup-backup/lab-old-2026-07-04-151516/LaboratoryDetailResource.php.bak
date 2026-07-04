<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratoryDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "item_type" => $this->item_type,
            "category" => $this->category,
            "location_name" => $this->location_name,
            "status" => $this->status,
            "description" => $this->description,
            "technical_notes" => $this->technical_notes,
            "is_featured" => (bool) $this->is_featured,
        ];
    }
}
