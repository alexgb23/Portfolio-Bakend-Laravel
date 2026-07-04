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
            'laboratories' => LaboratorioRealHomeResource::collection($this->resource['laboratories'] ?? collect()),
        ];
    }
}
