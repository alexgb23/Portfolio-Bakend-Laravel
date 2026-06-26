<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "short_description" => $this->short_description,
            "description" => $this->description,
            "technologies" => $this->technologies,
            "stack_summary" => $this->stack_summary,
            "image_url" => $this->image_url,
            "project_url" => $this->project_url,
            "repo_url" => $this->repo_url,
            "status" => $this->status,
            "is_featured" => (bool) $this->is_featured,
            "is_published" => (bool) $this->is_published,
            "sort_order" => (int) $this->sort_order,
        ];
    }
}
