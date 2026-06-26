<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "slug" => $this->slug,
            "category" => $this->category,
            "proficiency_level" => $this->proficiency_level,
            "proficiency_score" => $this->proficiency_score,
            "icon_name" => $this->icon_name,
            "description" => $this->description,
            "is_featured" => (bool) $this->is_featured,
        ];
    }
}
