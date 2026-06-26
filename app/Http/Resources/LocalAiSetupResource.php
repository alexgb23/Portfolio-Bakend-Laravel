<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocalAiSetupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "provider" => $this->provider,
            "model_name" => $this->model_name,
            "model_size" => $this->model_size,
            "base_url" => $this->base_url,
            "interface_name" => $this->interface_name,
            "description" => $this->description,
            "hardware_notes" => $this->hardware_notes,
            "status" => $this->status,
            "is_featured" => (bool) $this->is_featured,
            "is_visible" => (bool) $this->is_visible,
            "sort_order" => (int) $this->sort_order,
        ];
    }
}
