<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hostname' => $this->hostname,
            'display_name' => $this->display_name,
            'role' => $this->role,
            'provider' => $this->provider,
            'environment' => $this->environment,
            'location_name' => $this->location_name,
            'virtualization_type' => $this->virtualization_type,
            'os' => $this->os,
            'public_ip' => $this->public_ip,
            'cpu_usage' => $this->cpu_usage,
            'ram_usage' => $this->ram_usage,
            'uptime' => $this->uptime,
            'status' => $this->status,
            'notes' => $this->notes,
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
