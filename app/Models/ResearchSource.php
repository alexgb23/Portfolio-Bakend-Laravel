<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResearchSource extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "source_type",
        "author_name",
        "publisher_name",
        "published_on",
        "url",
        "reference_code",
        "summary",
        "notes",
        "topic",
        "status",
        "is_featured",
        "is_visible",
        "sort_order",
    ];

    protected $casts = [
        "published_on" => "date",
        "is_featured" => "boolean",
        "is_visible" => "boolean",
        "sort_order" => "integer",
    ];

    public function metrics(): HasMany
    {
        return $this->hasMany(ResearchMetric::class)
            ->where("status", "active")
            ->orderByDesc("is_featured")
            ->orderBy("sort_order");
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where("is_visible", true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where("status", "active");
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("title");
    }
}
