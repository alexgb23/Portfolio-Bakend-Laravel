<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    protected $fillable = [
        "room",
        "parameter",
        "display_name",
        "category",
        "source_system",
        "value",
        "unit",
        "status",
        "recorded_at",
        "notes",
        "is_featured",
        "sort_order",
    ];

    protected $casts = [
        "value" => "float",
        "recorded_at" => "datetime",
        "is_featured" => "boolean",
        "sort_order" => "integer",
    ];

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("id");
    }
}
