<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class SocialLinkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $url = $this->url;

        if ($this->platform === 'email' && filled($url) && ! Str::startsWith($url, ['mailto:', 'http://', 'https://'])) {
            $url = 'mailto:' . $url;
        }

        return [
            'id' => $this->id,
            'platform' => $this->platform,
            'icon_key' => $this->icon_key,
            'label' => $this->label,
            'title' => $this->title,
            'text' => $this->text,
            'url' => $url,
        ];
    }
}
