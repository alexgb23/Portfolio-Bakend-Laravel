<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cluster extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "type",
        "description",
        "status",
        "is_featured",
        "sort_order",
    ];

    protected $casts = [
        "is_featured" => "boolean",
        "sort_order" => "integer",
    ];

    public function servers(): BelongsToMany
    {
        return $this->belongsToMany(Server::class, "cluster_server")
            ->withPivot(["id", "node_role", "sort_order"])
            ->withTimestamps()
            ->orderBy("cluster_server.sort_order");
    }

    public function clusterServers(): HasMany
    {
        return $this->hasMany(ClusterServer::class)->orderBy("sort_order");
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn("status", ["active", "online"]);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("name");
    }
}
