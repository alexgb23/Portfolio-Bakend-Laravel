<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "short_description" => $this->short_description,
            "stack_summary" => $this->stack_summary,
            "technologies" => $this->technologies,
            "image_url" => $this->image_url,
            "project_url" => $this->project_url,
            "repo_url" => $this->repo_url,
            "is_featured" => (bool) $this->is_featured,
        ];
    }
}
