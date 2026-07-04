<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AiStudyCase extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "category",
        "technology_stack",
        "context",
        "challenge",
        "solution",
        "results",
        "status",
        "is_featured",
        "is_visible",
        "sort_order",
    ];

    protected $casts = [
        "is_featured" => "boolean",
        "is_visible" => "boolean",
        "sort_order" => "integer",
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where("is_visible", true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("title");
    }
}
