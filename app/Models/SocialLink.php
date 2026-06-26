<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        "platform",
        "icon_key",
        "label",
        "title",
        "text",
        "url",
        "sort_order",
        "is_visible",
    ];

    protected $casts = [
        "sort_order" => "integer",
        "is_visible" => "boolean",
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where("is_visible", true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("platform");
    }
}
