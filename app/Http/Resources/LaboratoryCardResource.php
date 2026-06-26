<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LaboratoryCardResource extends JsonResource
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
            "description" => Str::limit((string) $this->description, 180),
            "is_featured" => (bool) $this->is_featured,
        ];
    }
}
