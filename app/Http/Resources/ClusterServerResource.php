<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClusterServerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hostname' => $this->hostname,
            'name' => $this->name ?? null,
            'slug' => $this->slug ?? null,
            'status' => $this->status ?? null,
            'pivot' => [
                'cluster_server_id' => $this->pivot?->id,
                'node_role' => $this->pivot?->node_role,
                'sort_order' => $this->pivot?->sort_order,
            ],
        ];
    }
}
