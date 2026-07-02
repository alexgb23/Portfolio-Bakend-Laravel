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

            'projects' => ProjectResource::collection($this->resource['projects'] ?? collect()),

            'servers' => ServerResource::collection($this->resource['servers'] ?? collect()),

            'nodes' => NodeResource::collection($this->resource['nodes'] ?? collect()),

            'metrics' => MetricResource::collection($this->resource['metrics'] ?? collect()),

        ];
    }
}
