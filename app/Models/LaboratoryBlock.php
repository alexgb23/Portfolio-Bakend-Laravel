<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LaboratoryBlock extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "block_key",
        "kicker",
        "title",
        "description",
        "layout_type",
        "status",
        "is_visible",
        "is_featured",
        "sort_order",
    ];

    protected $casts = [
        "is_visible" => "boolean",
        "is_featured" => "boolean",
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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where("status", "active");
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("name");
    }
}
