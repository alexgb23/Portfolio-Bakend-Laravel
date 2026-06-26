<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'display_name' => $this->display_name,
            'headline' => $this->headline,
            'subheadline' => $this->subheadline,

            'hero_kicker' => $this->hero_kicker,
            'hero_title_prefix' => $this->hero_title_prefix,
            'hero_title_highlight' => $this->hero_title_highlight,
            'hero_title_suffix' => $this->hero_title_suffix,
            'hero_stack_badge' => $this->hero_stack_badge,

            'bio_short' => $this->bio_short,
            'bio_long' => $this->bio_long,

            'about_title' => $this->about_title,
            'about_intro' => $this->about_intro,

            'location' => $this->location,
            'email_public' => $this->email_public,
            'website_url' => $this->website_url,
            'resume_url' => $this->resume_url,
            'status_label' => $this->status_label,
        ];
    }
}
