<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResearchSourceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "source_type" => $this->source_type,
            "author_name" => $this->author_name,
            "publisher_name" => $this->publisher_name,
            "published_on" => $this->published_on,
            "url" => $this->url,
            "reference_code" => $this->reference_code,
            "summary" => $this->summary,
            "notes" => $this->notes,
            "topic" => $this->topic,
            "status" => $this->status,
            "is_featured" => (bool) $this->is_featured,
            "is_visible" => (bool) $this->is_visible,
            "sort_order" => (int) $this->sort_order,
            "metrics" => ResearchMetricResource::collection(
                $this->whenLoaded("metrics")
            ),
        ];
    }
}
