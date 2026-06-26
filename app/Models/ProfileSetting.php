<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    protected $fillable = [
        "full_name",
        "display_name",
        "headline",
        "subheadline",
        "bio_short",
        "bio_long",
        "location",
        "email_public",
        "website_url",
        "resume_url",
        "status_label",
        "is_active",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where("is_active", true);
    }
}
