<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        "node_name",
        "location_name",
        "type",
        "source_system",
        "protocol",
        "current_value",
        "unit",
        "ip_address",
        "status",
        "last_seen_at",
        "is_active",
        "notes",
        "is_featured",
        "sort_order",
    ];

    protected $casts = [
        "last_seen_at" => "datetime",
        "is_active" => "boolean",
        "is_featured" => "boolean",
        "sort_order" => "integer",
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where("is_active", true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("node_name");
    }
}
