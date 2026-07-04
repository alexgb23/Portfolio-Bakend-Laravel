<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClusterServerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "hostname" => $this->hostname,
            "display_name" => $this->display_name,
            "role" => $this->role,
            "provider" => $this->provider,
            "environment" => $this->environment,
            "location_name" => $this->location_name,
            "virtualization_type" => $this->virtualization_type,
            "os" => $this->os,
            "public_ip" => $this->public_ip,
            "cpu_usage" => $this->cpu_usage,
            "ram_usage" => $this->ram_usage,
            "uptime" => $this->uptime,
            "status" => $this->status,
            "is_featured" => (bool) $this->is_featured,
            "sort_order" => (int) $this->sort_order,
            "pivot" => [
                "cluster_server_id" => $this->pivot?->id,
                "node_role" => $this->pivot?->node_role,
                "sort_order" => $this->pivot?->sort_order,
            ],
        ];
    }
}
