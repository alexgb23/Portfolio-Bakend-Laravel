<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabCapabilityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'category' => $this->category,
            'capability_level' => $this->capability_level,
            'description' => $this->description,
            'technical_notes' => $this->technical_notes,
            'status' => $this->status,
            'is_featured' => (bool) $this->is_featured,
            'is_visible' => (bool) $this->is_visible,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
