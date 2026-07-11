<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialLinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "platform" => $this->platform,
            "icon_key" => $this->icon_key,
            "label" => $this->label,
            "title" => $this->title,
            "text" => $this->text,
            "url" => $this->url,
            "sort_order" => (int) $this->sort_order,
            "is_visible" => (bool) $this->is_visible,
        ];
    }
}
