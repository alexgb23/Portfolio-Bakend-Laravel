<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioHomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'social_links' => SocialLinkResource::collection($this->resource['social_links'] ?? collect()),
            'projects' => ProjectCardResource::collection($this->resource['projects'] ?? collect()),
            'laboratory_summary' => $this->resource['laboratory_summary'] ?? [
                'servers_count' => 0,
                'nodes_count' => 0,
                'metrics_count' => 0,
            ],
        ];
    }
}
