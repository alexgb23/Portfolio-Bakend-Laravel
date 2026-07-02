<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "description",
        "short_description",
        "technologies",
        "stack_summary",
        "image_url",
        "project_url",
        "repo_url",
        "status",
        "is_featured",
        "is_published",
        "sort_order",
    ];

    protected $casts = [
        "image_url" => "array",
        "is_featured" => "boolean",
        "is_published" => "boolean",
        "sort_order" => "integer",
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where("is_published", true);
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
