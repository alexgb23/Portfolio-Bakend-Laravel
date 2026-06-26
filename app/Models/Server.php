<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Server extends Model
{
    protected $fillable = [
        "hostname",
        "display_name",
        "role",
        "provider",
        "environment",
        "location_name",
        "virtualization_type",
        "os",
        "public_ip",
        "cpu_usage",
        "ram_usage",
        "uptime",
        "status",
        "notes",
        "is_featured",
        "sort_order",
    ];

    protected $casts = [
        "is_featured" => "boolean",
        "sort_order" => "integer",
    ];

    public function clusters(): BelongsToMany
    {
        return $this->belongsToMany(Cluster::class, "cluster_server")
            ->withPivot(["id", "node_role", "sort_order"])
            ->withTimestamps();
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("hostname");
    }
}
