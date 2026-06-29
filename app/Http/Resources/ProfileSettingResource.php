<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'display_name' => $this->display_name,
            'bio_long' => $this->bio_long,
            'location' => $this->location,
            'email_public' => $this->email_public,
            'website_url' => $this->website_url,
            'resume_url' => $this->resume_url,
            'status_label' => $this->status_label,
        ];
    }
}
