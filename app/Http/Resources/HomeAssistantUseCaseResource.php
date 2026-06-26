<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeAssistantUseCaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "home_assistant_instance_id" => $this->home_assistant_instance_id,
            "title" => $this->title,
            "category" => $this->category,
            "description" => $this->description,
            "status" => $this->status,
            "is_featured" => (bool) $this->is_featured,
            "is_visible" => (bool) $this->is_visible,
            "sort_order" => (int) $this->sort_order,
        ];
    }
}
