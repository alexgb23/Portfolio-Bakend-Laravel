<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // 'skills' => SkillResource::collection($this->resource['skills'] ?? collect()),

            'highlights' => collect($this->resource['highlights'] ?? [])
                ->map(fn($item) => [
                    'id' => $item->id,
                    'number' => $item->number,
                    'title' => $item->title,
                    'text' => $item->text,
                    'side' => $item->side,
                ])
                ->values(),
        ];
    }
}
