<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LocalAiSetup extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "provider",
        "model_name",
        "model_size",
        "base_url",
        "interface_name",
        "description",
        "hardware_notes",
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

    public function scopeActive(Builder $query): Builder
    {
        return $query->where("status", "active");
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("name");
    }
}
