<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioHomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'profile' => $this->resource['profile']
                ? new ProfileSettingResource($this->resource['profile'])
                : null,

            'skills' => SkillResource::collection($this->resource['skills'] ?? collect()),

            'projects' => ProjectCardResource::collection($this->resource['projects'] ?? collect()),
        ];
    }
}
