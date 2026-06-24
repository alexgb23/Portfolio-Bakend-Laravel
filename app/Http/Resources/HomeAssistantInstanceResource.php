<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeAssistantInstanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'version' => $this->version,
            'location_name' => $this->location_name,
            'access_url' => $this->access_url,
            'description' => $this->description,
            'status' => $this->status,
            'is_featured' => (bool) $this->is_featured,
            'is_visible' => (bool) $this->is_visible,
            'sort_order' => $this->sort_order,
            'use_cases' => HomeAssistantUseCaseResource::collection(
                $this->whenLoaded('useCases')
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
